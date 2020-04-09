<?php

namespace Sunnysideup\KeepWordsTogether;

use SilverStripe\Admin\ModelAdmin;

class WordsToKeepTogetherModelAdmin extends ModelAdmin
{
    private static $menu_title = 'Words Together';

    private static $url_segment = 'words-to-keep-together';

    private static $menu_icon_class = 'font-icon-block-content';

    private static $managed_models = [
        WordsToKeepTogether::class,
    ];
}
