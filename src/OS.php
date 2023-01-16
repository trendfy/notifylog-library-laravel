<?php

namespace NotifyLog\Laravel;

class OS
{
    public static function isWin()
    {
        return 'WIN' === static::getOsPrefix(); // Should return "Windows"
    }

    public static function getOsPrefix()
    {
        return strtoupper(substr(PHP_OS_FAMILY, 0, 3));
    }
}
