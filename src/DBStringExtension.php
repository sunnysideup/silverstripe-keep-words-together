<?php

namespace Sunnysideup\KeepWordsTogether;

use SilverStripe\Control\Director;

use SilverStripe\Core\Extension;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;

class DBStringExtension extends Extension
{

    private const SPAN_START = '<span class="keep-together">';

    private const SPAN_END = '</span>';

    public function KeepWordsTogether(?string $words = '')
    {
        $text = $this->owner->getValue();
        $replacers = WordsToKeepTogether::get();
        if($words) {
            $text = $this->replaceKeepWordsTogether($text, $words);
        }
        foreach($replacers as $replacer) {
            $text = $this->replaceKeepWordsTogether($text, $replacer->Title);
        }
        $field = DBField::create_field(DBHTMLText::class, $text);
        if($field instanceof DBHTMLText) {
            $field->setProcessShortcodes(true);
        }

        return $field;
    }

    protected function replaceKeepWordsTogether(string $text, string $words)
    {
        if (stripos($text, $words) !== false) {
            $newString = self::SPAN_START . $words . self::SPAN_END;
            $text = str_ireplace($words, $newString, $text);
        }

        return $text;

    }

}
