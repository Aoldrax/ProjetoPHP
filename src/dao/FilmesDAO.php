<?php


namespace dao;

use dao\db\MySQLDatabase;
use dao\db\SQLQuery;
use model\FilmeModel;
use model\UsuarioModel;
use PDO;

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
                "INSERT INTO `filmes` (id, nome, duracao, nome_diretor, data_lançamento, usuario_id) values(null,':nome', ':duracao', ':nome-diretor', ':data_lançamento', ':usuario_id'",
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

    public function listarFilmes(): ?array
    {
        $mysql = MySQLDatabase::getSingleton();
        $result = $mysql->select(new SQLQuery("SELECT * FROM `filmes`"));
        if ($result === null)
            return null;

        $filmes = array();
        while ($data = $result->fetch(PDO::FETCH_OBJ))
            array_push($filmes, new FilmeModel(
                $data->id,
                $data->nome,
                $data->duracao,
                $data->nome_diretor,
                $data->data_lançamento,
                $data->usuario_id));

        return $filmes;
    }

    public function removerFilme(int $id): bool
    {
        $mysql = MySQLDatabase::getSingleton();
        return $mysql->delete(
            new SQLQuery(
                "DELETE FROM `filmes` WHERE `id` = :id",
                [":id" => $id]
            )
        );
    }

    public function alterarFilme(FilmeModel $model1): bool
    {
        $mysql = MySQLDatabase::getSingleton();
        return $mysql->update(
            new SQLQuery(
                "UPDATE `filmes` SET `nome` = ':nome', `duracao` = ':duracao', `nome_diretor` = ':nome_diretor', `data_lançamento` = ':data_lançamento', `usuario_id` = ':usuario_id' WHERE `id` = :id",
                [
                    ":id" => $model1->getId(),
                    ":nome" => $model1->getNome(),
                    ":duracao" => $model1->getDuracao(),
                    ":nome_diretor" => $model1->getNomeDiretor(),
                    ":data_lançamento" => $model1->getDataLançamento(),
                    ":usuario_id" => $model1->getUsuarioId()
                ]

            )
        );
    }
}