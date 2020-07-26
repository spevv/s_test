<?php


namespace App;

use Illuminate\Support\Facades\Config;

/**
 * Class Blacklist
 * @package App
 */
class Blacklist
{
    /**
     * Is user ip in blacklist
     *
     * @param string $ip
     *
     * @return bool
     */
    public static function isBanned(string $ip) : bool
    {
        return in_array($ip, Config::get('blacklist.list'));
    }
}
