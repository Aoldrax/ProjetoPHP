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

    public function cadastrarUsuario( string $nome, string $usuario, string $cpf, string $celular, string $senha, string $confir_senha, string $email, string $data_nascimento, string $estado, string $cidade, string $numerodocartao, int $codigocartao, string $validadecartao): ?int
    {
        $mysql = MySQLDatabase::getSingleton();
        $result = $mysql->insert(
            new SQLQuery(
                "INSERT INTO usuarios (nome, usuario, cpf, celular, senha, confir_senha, email, data_nascimento, estado, cidade, numerodocartao, codigocartao, validadecartao) values (':nome', ':usuario', ':cpf', ':celular', ':senha', ':confir_senha', ':email', ':data_nascimento', ':estado', ':cidade', ':numerodocartao', ':codigocartao', ':validadecartao')",
                [
                    ":nome" => $nome,
                    ":usuario" => $usuario,
                    ":cpf" => $cpf,
                    ":celular" => $celular,
                    ":senha" => $senha,
                    ":confir_senha" => $confir_senha,
                    ":email" => $email,
                    ":data_nascimento" => $data_nascimento,
                    ":estado" => $estado,
                    ":cidade" => $cidade,
                    ":numerodocartao" => $numerodocartao,
                    ":codigocartao" => $codigocartao,
                    ":validadecartao" => $validadecartao
                ]
            )
        );
        if ($result === null)
            return false;

        $data = $result->fetch(PDO::FETCH_OBJ);
        return $data->count > 0;
    }
}