<?php
/**
 * Created by PhpStorm.
 * User: devwarlt
 * Date: 26/11/2020
 * Time: 16:52
 */

namespace controller;

use dao\UsuarioDAO;
use php\PhpUtils;

include "../dao/db/SQLQuery.php";
include "../dao/db/MySQLDatabase.php";
include "../dao/UsuarioDAO.php";

final class UsuarioController implements IController
{
    private const REF_ERR = "../view/";

    private static $singleton, $utils;

    private function __construct(PhpUtils $utils)
    {
        self::$utils = $utils;
    }

    public static function getSingleton(): UsuarioController
    {
        if (self::$singleton === null)
            self::$singleton = new UsuarioController(PhpUtils::getSingleton());
        return self::$singleton;
    }

    public function handler(array $args): void
    {
        if (!array_key_exists("action", $args)) {
            self::$utils->onRawIndexErr("Action <strong>não</strong> definida!", self::REF_ERR);
            return;
        }

        switch (($action = $args["action"])) {
            default:
                self::$utils->onRawIndexErr("Action '<strong>" . $action . "</strong>' não implementada!", self::REF_ERR);
                break;
            case "login":
                $nome = self::$utils->tryGetValue($args, "nome");
                $senha = self::$utils->tryGetValue($args, "senha");
                $this->autenticarUsuario($nome, $senha);
                break;
        }
    }

    public function autenticarUsuario(string $nome, string $senha): void
    {
        if (self::$utils->isNullOrEmpty($nome) || self::$utils->isNullOrEmpty($senha)) {
            self::$utils->onRawIndexErr("<strong>Nome</strong> ou <strong>Senha</strong> inválidos!", self::REF_ERR);
            return;
        }

        $dao = UsuarioDAO::getSingleton();
        $dao->verificarCadastro($nome, $senha);
    }
}