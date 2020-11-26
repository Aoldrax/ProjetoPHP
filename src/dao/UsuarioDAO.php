<?php
/**
 * Created by PhpStorm.
 * User: devwarlt
 * Date: 26/11/2020
 * Time: 16:41
 */

namespace dao;

use dao\db\MySQLDatabase;
use dao\db\SQLQuery;

final class UsuarioDAO
{
    private static $singleton;

    private function __construct()
    {
    }

    public static function getSingleton(): UsuarioDAO
    {
        if (self::$singleton === null)
            self::$singleton = new UsuarioDAO();
        return self::$singleton;
    }

    public function verificarCadastro(string $nome, string $senha): bool
    {
        $mysql = MySQLDatabase::getSingleton();
        $result = $mysql->select(
            new SQLQuery(
                "SELECT COUNT(`id`) AS `count` FROM `usuario` WHERE `usuario` = ':usuario' AND `senha` = ':senha'",
                [
                    ":usuario" => $nome,
                    ":senha" => $senha
                ]
            )
        );
        if ($result === null)
            return false;

        $data = $result->fetch(\PDO::FETCH_OBJ);
        return $data->count > 0;
    }
}