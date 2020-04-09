<?php

namespace Sunnysideup\KeepWordsTogether;

use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\Filters\PartialMatchFilter;

class WordsToKeepTogether extends DataObject
{
    #######################
    ### Names Section
    #######################

    private static $table_name = 'WordsToKeepTogether';

    private static $singular_name = 'Words to keep together';

    private static $plural_name = 'Entries of words to keep together';

    private static $db = [
        'Title' => 'Varchar',
    ];

    private static $indexes = [
        'Title' => [
            'type' => 'unique',
        ],
    ];

    private static $default_sort = [
        'Title' => 'ASC',
    ];

    private static $required_fields = [
        'Title',
    ];

    private static $searchable_fields = [
        'Title' => PartialMatchFilter::class,
    ];

    private static $field_labels = [
        'Title' => 'Words',
    ];

    private static $field_labels_right = [
        'Title' => 'e.g. New Zealand',
    ];

    private static $summary_fields = [
        'Title' => 'Words',
    ];

    public function i18n_singular_name()
    {
        return _t(self::class . '.SINGULAR_NAME', 'Words to keep together');
    }

    public function i18n_plural_name()
    {
        return _t(self::class . '.PLURAL_NAME', 'Entries of words to keep together');
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        //do first??
        $rightFieldDescriptions = $this->Config()->get('field_labels_right');
        if (is_array($rightFieldDescriptions) && count($rightFieldDescriptions)) {
            foreach ($rightFieldDescriptions as $field => $desc) {
                $formField = $fields->DataFieldByName($field);
                if (! $formField) {
                    $formField = $fields->DataFieldByName($field . 'ID');
                }
                if ($formField) {
                    $formField->setDescription($desc);
                }
            }
        }
        //...
        return $fields;
    }
}
