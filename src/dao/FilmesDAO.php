<?php


namespace dao;

use dao\db\MySQLDatabase;
use dao\db\SQLQuery;
final class FilmesDAO
{
    private static $singleton;

    private function __construct()
    {
    }

    public static function getSingleton(): FilmesDAO
    {
        if (self::$singleton === null)
            self::$singleton = new FilmesDAO();
        return self::$singleton;
    }

    public function cadastrarFilme(int $id, string $nome, string $duracao, string $nome_diretor, string $data_lançamento, int $usuario_id): bool
    {
        $mysql = MySQLDatabase::getSingleton();
        $result = $mysql->insert(
            new SQLQuery(
                "INSERT INTO `filmes` (id, nome=':nome', duracao=':duracao', nome_diretor=':nome_diretor', data_lançamento=':data_lançamento', usuario_id=':usuario-id') values(null,'{$nome}', '{$duracao}', '{$nome_diretor}', '{$data_lançamento}', '{$usuario_id}')",
                [
                    ":nome" => $nome,
                    ":duracao" => $duracao,
                    ":nome-diretor" => $nome_diretor,
                    ":data_lançamento" => $data_lançamento,
                    ":usuario_id" => $usuario_id
                ]
            )
        );
    }
}