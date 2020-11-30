<?php


namespace dao;

use dao\db\MySQLDatabase;
use dao\db\SQLQuery;
use model\FilmeModel;
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

    public function cadastrarFilme(FilmeModel $model): bool
    {
        $mysql = MySQLDatabase::getSingleton();
        return $mysql->insert(
            new SQLQuery(
                "INSERT INTO `filmes` (nome, duracao, nome_diretor, data_lancamento, usuario_id) values(':nome', ':duracao', ':nome-diretor', ':data_lancamento', ':usuario_id'",
                [
                    ":nome" => $model->getNome(),
                    ":duracao" => $model->getDuracao(),
                    ":nome-diretor" => $model->getNomeDiretor(),
                    ":data_lancamento" => $model->getDataLancamento(),
                    ":usuario_id" => $model->getUsuarioId(),
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
                $data->data_lancamento,
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
                "UPDATE `filmes` SET `nome` = ':nome', `duracao` = ':duracao', `nome_diretor` = ':nome_diretor', `data_lancamento` = ':data_lancamento', `usuario_id` = ':usuario_id' WHERE `id` = :id",
                [
                    ":id" => $model1->getId(),
                    ":nome" => $model1->getNome(),
                    ":duracao" => $model1->getDuracao(),
                    ":nome_diretor" => $model1->getNomeDiretor(),
                    ":data_lancamento" => $model1->getDataLancamento(),
                    ":usuario_id" => $model1->getUsuarioId()
                ]

            )
        );
    }
}