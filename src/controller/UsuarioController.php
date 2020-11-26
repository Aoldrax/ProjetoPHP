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
    private const REF_INDEX = "../view/";
    private const REF_AUTH = "../view/home";

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
            self::$utils->onRawIndexErr("Action <strong>não</strong> definida!", self::REF_INDEX);
            return;
        }

        switch (($action = $args["action"])) {
            default:
                self::$utils->onRawIndexErr("Action '<strong>" . $action . "</strong>' não implementada!", self::REF_INDEX);
                break;
            case "login":
                $this->autenticarUsuario($args);
                break;
            case "logout":
                $this->logoutUsuario();
                break;
        }
    }

    public function autenticarUsuario(array $args): void
    {
        if (self::$utils->isNullOrEmpty(($nome = self::$utils->tryGetValue($args, "nome")))
            || self::$utils->isNullOrEmpty(($senha = self::$utils->tryGetValue($args, "senha")))
            || !UsuarioDAO::getSingleton()->verificarCadastro($nome, $senha)) {
            self::$utils->onRawIndexErr("<strong>Nome</strong> ou <strong>Senha</strong> inválidos!", self::REF_INDEX);
            return;
        } else {
            session_start();

            $_SESSION["usuario"] = $nome;
            $_SESSION["senha"] = $senha;

            self::$utils->onRawIndexEmpty(self::REF_AUTH);
        }
    }

    public function logoutUsuario(): void
    {
        session_start();
        session_destroy();

        self::$utils->onRawIndexOk("Logout efetuado com sucesso!", self::REF_INDEX);
    }
}