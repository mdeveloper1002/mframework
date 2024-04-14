<?php

namespace Mdeveloper1002\Mframework;

class Environment
{
    public static function get($key)
    {
        return $_ENV[$key];
    }

    public static function getAppName()
    {
        echo $_ENV["APP_NAME"];
    }
}
