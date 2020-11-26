<?php
/**
 * Created by PhpStorm.
 * User: devwarlt
 * Date: 26/11/2020
 * Time: 17:09
 */

namespace php;

final class PhpUtils
{
    private static $php_injection_regex_pattern = '/^(?=.*<\?)|(?=.*\?>).*$/';

    private static $singleton;

    private function __construct()
    {
    }

    public static function getSingleton(): PhpUtils
    {
        if (self::$singleton === null)
            self::$singleton = new PhpUtils();
        return self::$singleton;
    }

    public function onRawIndexErr(string $msg, string $ref): void
    {
        self::onRawRedirect($msg, $ref, "err");
    }

    private function onRawRedirect(string $msg, string $ref, string $var): void
    {
        $val = urlencode($msg);
        header("Location:$ref?$var=$val");
    }

    public function onRawIndexEmpty(string $ref): void
    {
        header("Location:$ref");
    }

    public function onRawIndexOk(string $msg, string $ref): void
    {
        self::onRawRedirect($msg, $ref, "success");
    }

    public function checkPhpInjection(string $str): bool
    {
        return preg_match(self::$php_injection_regex_pattern, $str);
    }

    public function tryGetValue(array $collection, string $key)
    {
        return array_key_exists($key, $collection) ? $collection[$key] : null;
    }

    public function isNullOrEmpty(?string $value): bool
    {
        return $value === null || $value === "";
    }
}