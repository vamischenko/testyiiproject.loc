<?php

namespace common\helpers;

/**
 * Class Dictionary
 * @package common\helpers
 */
class Dictionary
{
    const STATUS_HIDDEN = 2;
    const STATUS_ACTIVE = 1;

    public static function status()
    {
        return [
            self::STATUS_ACTIVE => 'Опубликован',
            self::STATUS_HIDDEN => 'Скрыт',
        ];
    }
}
