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
use model\UsuarioModel;
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

    public function listarUsuarios(): ?array
    {
        $mysql = MySQLDatabase::getSingleton();
        $result = $mysql->select(new SQLQuery("SELECT * FROM `usuario`"));
        if ($result === null)
            return null;

        $usuarios = array();
        while ($data = $result->fetch(PDO::FETCH_OBJ))
            array_push($usuarios, new UsuarioModel(
                $data->id,
                $data->nome,
                $data->usuario,
                $data->cpf,
                $data->celular,
                $data->senha,
                $data->confir_senha,
                $data->email,
                $data->data_nascimento,
                $data->estado,
                $data->cidade,
                $data->numerodocartao,
                $data->codigocartao,
                $data->validadecartao
            ));

        return $usuarios;
    }

    public function removerUsuario(int $id): bool
    {
        $mysql = MySQLDatabase::getSingleton();
        return $mysql->delete(
            new SQLQuery(
                "DELETE FROM `usuario` WHERE `id` = :id",
                [":id" => $id]
            )
        );
    }

    public function alterarUsuario(UsuarioModel $model1): bool
    {
        $mysql = MySQLDatabase::getSingleton();
        return $mysql->update(
            new SQLQuery(
                "UPDATE `usuario` SET `nome` = ':nome', `usuario` = ':usuario', `cpf` = ':cpf', `celular` = ':celular', `senha` = ':senha', `confir_senha` = ':confir_senha', `email` = ':email', `data_nascimento` = ':data_nascimento', `estado` = ':estado', `cidade` = ':cidade', `numerodocartao` = ':numerodocartao', `codigocartao` = ':codigocartao', `validadecartao` = ':validadecartao' WHERE `id` = :id",
                [
                    ":id" => $model1->getId(),
                    ":nome" => $model1->getNome(),
                    ":usuario" => $model1->getUsuario(),
                    ":cpf" => $model1->getCpf(),
                    ":celular" => $model1->getCelular(),
                    ":senha" => $model1->getSenha(),
                    ":confir_senha" => $model1->getConfirSenha(),
                    ":email" => $model1->getEmail(),
                    ":data_nascimento" => $model1->getDataNascimento(),
                    ":estado" => $model1->getEstado(),
                    ":cidade" => $model1->getCidade(),
                    ":numerodocartao" => $model1->getNumerodocartao(),
                    ":codigocartao" => $model1->getCodigocartao(),
                    ":validadecartao" => $model1->getValidadecartao()
                ]
            )
        );
    }
}
