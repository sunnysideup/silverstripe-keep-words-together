<?php

namespace Sunnysideup\Glossary\Model\FieldType;

use SilverStripe\Control\Director;

use SilverStripe\Core\Extension;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use Sunnysideup\Glossary\Model\Term;

class FieldExtensionForHTML extends Extension
{

    private const SPAN_START = '<span class="keep-together">';

    private const SPAN_END = '</span>';

    public function KeepWordsTogether(?string $words = '')
    {
        $text = $this->owner->getValue();
        $replacers = Replacers::get();
        if($words) {
            $text = $this->replaceKeepWordsTogether($words);
        }
        foreach($replacers as $replacer) {
            $text = $this->replaceKeepWordsTogether($text = $replacer->Title);
        }
        $field = DBField::create_field($this->owner->class, $text);
        if($fields instanceof DBHTMLText) {
            $field->setProcessShortcodes(true);
        }

        return $field;
    }

    protected function replaceKeepWordsTogether(string $text, string $words)
    {
        if (stripos($words, $text) !== false) {
            $newString = self::SPAN_START . $words . self::SPAN_END;
            $text = str_replace($words, $newSting, $text);
        }

        return $text;

    }

}
