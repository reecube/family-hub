<?php

namespace AppBundle\Enum;

abstract class Pages
{
    const ID_PAGE_INDEX = 1;
    const ID_PAGE_DINNER = 2;
    const ID_PAGE_PERSONS = 3;
    const ID_PAGE_DIET = 4;
    const ID_PAGE_SETTINGS = 5;

    const KEY_NAME = 'name';
    const KEY_ROUTE = 'route';
    const KEY_ICON = 'icon';
    const KEY_TITLE = 'title';

    const PAGES = [
        self::ID_PAGE_INDEX => [
            self::KEY_NAME => 'index',
            self::KEY_ICON => 'home',
        ],
        self::ID_PAGE_DINNER => [
            self::KEY_NAME => 'dinner',
            self::KEY_ICON => 'restaurant',
        ],
        self::ID_PAGE_PERSONS => [
            self::KEY_NAME => 'persons',
            self::KEY_ICON => 'face',
        ],
        self::ID_PAGE_DIET => [
            self::KEY_NAME => 'diet',
            self::KEY_ICON => 'favorite',
        ],
        self::ID_PAGE_SETTINGS => [
            self::KEY_NAME => 'settings',
            self::KEY_ICON => 'settings',
        ],
    ];
}
