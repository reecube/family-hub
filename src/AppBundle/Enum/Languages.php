<?php

namespace AppBundle\Enum;

abstract class Languages
{
    const ID_LANG_EN = 'en';
    const ID_LANG_DE = 'de';
    const ID_LANG_FR = 'fr';

    const KEY_LOCALE = 'locale';
    const KEY_TITLE = 'title';
    const KEY_URL = 'url';

    const LANGUAGES = [
        self::ID_LANG_EN => [
            self::KEY_LOCALE => self::ID_LANG_EN,
            self::KEY_TITLE => 'English',
            self::KEY_URL => null,
        ],
        self::ID_LANG_DE => [
            self::KEY_LOCALE => self::ID_LANG_DE,
            self::KEY_TITLE => 'Deutsch',
            self::KEY_URL => null,
        ],
        self::ID_LANG_FR => [
            self::KEY_LOCALE => self::ID_LANG_FR,
            self::KEY_TITLE => 'Français',
            self::KEY_URL => null,
        ],
    ];
}
