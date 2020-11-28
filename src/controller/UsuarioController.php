<?php
/**
 * Created by PhpStorm.
 * User: devwarlt
 * Date: 26/11/2020
 * Time: 16:52
 */

namespace controller;

use dao\UsuarioDAO;
use model\UsuarioModel;
use php\PhpUtils;

include "../model/UsuarioModel.php";
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
            case "cadastrar":
                $this->verificarCadastroUsuario($args);
                break;
        }
    }

    public function autenticarUsuario(array $args): void
    {
        if (self::$utils->isNullOrEmpty(($usuario = self::$utils->tryGetValue($args, "usuario")))
            || self::$utils->isNullOrEmpty(($senha = self::$utils->tryGetValue($args, "senha")))
            || !UsuarioDAO::getSingleton()->verificarCadastro($usuario, $senha)) {
            self::$utils->onRawIndexErr("<strong>Nome</strong> ou <strong>Senha</strong> inválidos!", self::REF_INDEX);
            return;
        } else {
            session_start();

            $_SESSION["usuario"] = $usuario;
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

    public function verificarCadastroUsuario(array $args): void
    {
        if (self::$utils->isNullOrEmpty(($nome = self::$utils->tryGetValue($args, "nomecomp")))
            || self::$utils->isNullOrEmpty(($usuario = self::$utils->tryGetValue($args, "usuario")))
            || self::$utils->isNullOrEmpty(($cpf = self::$utils->tryGetValue($args, "cpf")))
            || self::$utils->isNullOrEmpty(($celular = self::$utils->tryGetValue($args, "celular")))
            || self::$utils->isNullOrEmpty(($senha = self::$utils->tryGetValue($args, "senha")))
            || self::$utils->isNullOrEmpty(($confir_senha = self::$utils->tryGetValue($args, "confsenha")))
            || self::$utils->isNullOrEmpty(($email = self::$utils->tryGetValue($args, "email")))
            || self::$utils->isNullOrEmpty(($data_nascimento = self::$utils->tryGetValue($args, "datanasc")))
            || self::$utils->isNullOrEmpty(($estado = self::$utils->tryGetValue($args, "estado")))
            || self::$utils->isNullOrEmpty(($cidade = self::$utils->tryGetValue($args, "cidade")))
            || self::$utils->isNullOrEmpty(($numerodocartao = self::$utils->tryGetValue($args, "numerocartao")))
            || self::$utils->isNullOrEmpty(($codigocartao = self::$utils->tryGetValue($args, "codigocartao")))
            || self::$utils->isNullOrEmpty(($validadecartao = self::$utils->tryGetValue($args, "validadecartao")))) {
            self::$utils->onRawIndexErr("<strong>Campos</strong> preenchidos de forma inválida!", self::REF_INDEX);
            return;
        }
        
        $model = new UsuarioModel(-1, $nome, $usuario, $cpf, $celular, $senha, $confir_senha, $email, $data_nascimento, $estado, $cidade, $numerodocartao, $codigocartao, $validadecartao);
        if (!UsuarioDAO::getSingleton()->cadastrarUsuario($model)) {
            self::$utils->onRawIndexErr("Não foi possível cadastrar o usuário!", self::REF_INDEX);
            return;
        }
        
        self::$utils->onRawIndexOk("Usuário cadastrado com sucesso!", self::REF_INDEX);
    }
}
