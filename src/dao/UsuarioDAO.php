<?php
/**
 * Created by PhpStorm.
 * User: devwarlt
 * Date: 26/11/2020
 * Time: 16:41
 */

namespace dao;

use model\UsuarioModel;
use dao\db\MySQLDatabase;
use dao\db\SQLQuery;
use PDO;

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

    public function verificarCadastro(string $usuario, string $senha): bool
    {
        $mysql = MySQLDatabase::getSingleton();
        $result = $mysql->select(
            new SQLQuery(
                "SELECT COUNT(`id`) AS `count` FROM `usuario` WHERE `usuario` = ':usuario' AND `senha` = ':senha'",
                [
                    ":usuario" => $usuario,
                    ":senha" => $senha
                ]
            )
        );
        if ($result === null)
            return false;

        $data = $result->fetch(PDO::FETCH_OBJ);
        return $data->count > 0;
    }

    public function cadastrarUsuario(UsuarioModel $model): bool
    {
        $mysql = MySQLDatabase::getSingleton();
        return $mysql->insert(
            new SQLQuery(
                "INSERT INTO `usuario` (`nome`, `usuario`, `cpf`, `celular`, `senha`, `confir_senha`, `email`, `data_nascimento`, `estado`, `cidade`, `numerodocartao`, `codigocartao`, `validadecartao`) VALUES (':nome', ':usuario', ':cpf', ':celular', ':senha', ':confir_senha', ':email', ':data_nascimento', ':estado', ':cidade', ':numerodocartao', ':codigocartao', ':validadecartao')",
                [
                    ":nome" => $model->getNome(),
                    ":usuario" => $model->getUsuario(),
                    ":cpf" => $model->getCpf(),
                    ":celular" => $model->getCelular(),
                    ":senha" => $model->getSenha(),
                    ":confir_senha" => $model->getConfirSenha(),
                    ":email" => $model->getEmail(),
                    ":data_nascimento" => $model->getDataNascimento(),
                    ":estado" => $model->getEstado(),
                    ":cidade" => $model->getCidade(),
                    ":numerodocartao" => $model->getNumerodocartao(),
                    ":codigocartao" => $model->getCodigocartao(),
                    ":validadecartao" => $model->getValidadecartao()
                ]
            )
        );
    }
}
