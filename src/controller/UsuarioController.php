<?php
/**
 * Created by PhpStorm.
 * User: devwarlt
 * Date: 26/11/2020
 * Time: 16:52
 */

namespace controller;

use dao\UsuarioDAO;

include "../dao/db/SQLQuery.php";
include "../dao/db/MySQLDatabase.php";
include "../dao/UsuarioDAO.php";

final class UsuarioController implements IController
{
    private static $singleton;

    private function __construct()
    {
    }

    public static function getSingleton(): UsuarioController
    {
        if (self::$singleton === null)
            self::$singleton = new UsuarioController();
        return self::$singleton;
    }

    public function handler(array $args): void
    {
        echo "Falta implementar esse handler!";
    }

    public function autenticarUsuario(string $nome, string $senha): bool
    {
        $dao = UsuarioDAO::getSingleton();
        return $dao->verificarCadastro($nome, $senha);
    }
}