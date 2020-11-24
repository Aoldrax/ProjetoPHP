<?php
/**
 * Created by PhpStorm.
 * User: devwarlt
 * Date: 24/11/2020
 * Time: 16:42
 */

namespace Db;

include "SQLQuery.php";
include "MySQLDatabase.php";

final class DbUtils
{
    private static $singleton;

    private function __construct()
    {
    }

    public static function getSingleton(): DbUtils
    {
        if (self::$singleton === null)
            self::$singleton = new DbUtils();
        return self::$singleton;
    }

    public function containsUsr(string $usr, string $pass): bool
    {
        $mysql = MySQLDatabase::getSingleton();
        $result = $mysql->select(
            new SQLQuery(
                "SELECT COUNT(`id`) as `count` FROM `usuario` WHERE `usuario` = ':usuario' AND `senha` = ':senha'",
                [
                    ":usuario" => $usr,
                    ":senha" => $pass
                ]
            )
        );
        if ($result === null)
            return false;

        $data = $result->fetch(\PDO::FETCH_OBJ);
        return $data->count > 0;
    }
}