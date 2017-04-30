<?php

namespace AppBundle\Enum;

abstract class Pages
{
    const ID_PAGE_INDEX = 1;
    const ID_PAGE_DEMO = 2;

    const KEY_ROUTE = 'route';
    const KEY_ICON = 'icon';
    const KEY_TITLE = 'title';

    const PAGES = [
        self::ID_PAGE_INDEX => [
            self::KEY_ROUTE => 'index',
            self::KEY_ICON => 'home',
            self::KEY_TITLE => 'title_index',
        ],
        self::ID_PAGE_DEMO => [
            self::KEY_ROUTE => 'demo',
            self::KEY_ICON => 'important_devices',
            self::KEY_TITLE => 'title_demo',
        ],
    ];
}
