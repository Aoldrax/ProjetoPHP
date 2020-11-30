<?php


namespace controller;

use dao\FilmesDAO;
use model\FilmeModel;
use php\PhpUtils;

include "../model/FilmeModel.php";
include "../dao/db/SQLQuery.php";
include "../dao/db/MySQLDatabase.php";
include "../dao/FilmesDAO.php";

final class FilmesController implements IController
{
    private const REF_INDEX = "../view/";
    private const REF_HOME = "../view/home";
    private const REF_LISTAR_USR = "../view/listarUsuarios";

    private static $singleton, $utils;

    private function __construct(PhpUtils $utils)
    {
        self::$utils = $utils;
    }

    public static function getSingleton(): FilmesController
    {
        if (self::$singleton === null)
            self::$singleton = new FilmesController(PhpUtils::getSingleton());
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
            case "cadastrar":
                $this->cadastrarNovoFilme($args);
                break;
            case "listar":
                $this->listarTodosFilmes();
                break;
            case "remover":
                $this->removerFilme($args);
                break;
            case "editar":
                $this->editarFilme($args);
                break;
        }
    }

    private function cadastrarNovoFilme(array $args): void
    {
        if (self::$utils->isNullOrEmpty(($nome = self::$utils->tryGetValue($args, "nomefilme")))
            || self::$utils->isNullOrEmpty(($duracao = self::$utils->tryGetValue($args, "duracao")))
            || self::$utils->isNullOrEmpty(($nome_diretor = self::$utils->tryGetValue($args, "nomediretor")))
            || self::$utils->isNullOrEmpty(($data_lancamento = self::$utils->tryGetValue($args, "datalanca")))
            || self::$utils->isNullOrEmpty(($usuario_id = self::$utils->tryGetValue($args, "usuarioId")))) {
            self::$utils->onRawIndexErr("<strong>Campos</strong> preenchidos de forma inválida!", self::REF_INDEX);
            return;
        }

        $model = new FilmeModel(-1, $nome, $duracao, $nome_diretor, $data_lancamento, -1);
        if (!FilmesDAO::getSingleton()->cadastrarFilme($model)) {
            self::$utils->onRawIndexErr("Não foi possível cadastrar o filme!", self::REF_INDEX);
            return;
        }

        self::$utils->onRawIndexOk("Filme cadastrado com sucesso!", self::REF_INDEX);
    }

    private function listarTodosFilmes(): void
    {
        if (($filmes = FilmesDAO::getSingleton()->listarFilmes()) === null) {
            echo '
            <div class="jumbotron alert-danger alert border-danger">
                <p class="text-danger" align="justify">
                    Não existem usuários cadastrados no momento!
                </p>
            </div>
            ';
            return;
        }
        $context = '
            <table class="table" style="background-color: #fff; width:1920px; margin: 1px;">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Código</th>
                    <th scope="col">Nome do Filme</th>
                    <th scope="col">Duração</th>
                    <th scope="col">Nome do diretor</th>
                    <th scope="col">id</th>
                    <th scope="col">Email</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Cidade</th>
                    <th></th>
                    <th></th>
                </tr>
        ';

        $i = 0;
        foreach ($filmes as $filme)
            $context .= '
                <tr>
                    <th scope="row">' . ++$i . '</th>
                    <td>' . $filme->getId() . '</td>
                    <td>' . $filme->getNome() . '</td>
                    <td>' . $filme->getDuracao() . '</td>
                    <td>' . $filme->getNomeDiretor() . '</td>
                    <td>' . $filme->getDataLancamento() . '</td>
                    <td>' . $filme->getUsuarioId() . '</td>
                    <td>
                        <form action="../php/MVCRouter.php" method="post">
                            <input type="hidden" name="controller" value="filme"/>
                            <input type="hidden" name="action" value="remover"/>
                            <input type="hidden" name="id" value="' . $filme->getId() . '"/>
                            <input class="btn btn-danger" type="submit" value="Deletar"/>
                        </form>
                    </td>
                    <td>
                        <form action="editarFilmes.php" method="post">
                            <input type="hidden" name="id" value="' . $filme->getId() . '"/>
                            <input type="hidden" name="nomefilme" value="' . $filme->getNome() . '"/>
                            <input type="hidden" name="duracao" value="' . $filme->getDuracao() . '"/>
                            <input type="hidden" name="nomediretor" value="' . $filme->getNomeDiretor() . '"/>
                            <input type="hidden" name="datalanca" value="' . $filme->getDataLancamento() . '"/>
                            <input type="hidden" name="usuarioId" value="' . $filme->getUsuarioId() . '"/>
                            <input class="btn btn-warning" type="submit" value="Editar"/>
                        </form>
                    </td>
                </tr>
            ';

        $context .= '</table>';
        echo $context;
    }

    private function removerFilme(array $args): void
    {
        if (self::$utils->isNullOrEmpty(($id = self::$utils->tryGetValue($args, "id")))) {
            self::$utils->onRawIndexErr("Elemento de identificação do filme não encontrada!", self::REF_INDEX);
            return;
        }

        if (!FilmesDAO::getSingleton()->removerFilme($id)) {
            self::$utils->onRawIndexErr("Não foi possível remover o usuário do sistema!<br/><strong>ID:</strong>" . $id, self::REF_INDEX);
            return;
        }

        self::$utils->onRawIndexEmpty(self::REF_HOME);
    }


    private function editarFilme(array $args): void
    {
        if (self::$utils->isNullOrEmpty(($id = self::$utils->tryGetValue($args, "id")))
            || self::$utils->isNullOrEmpty(($nome = self::$utils->tryGetValue($args, "nomefilme")))
            || self::$utils->isNullOrEmpty(($duracao = self::$utils->tryGetValue($args, "duracao")))
            || self::$utils->isNullOrEmpty(($nome_diretor = self::$utils->tryGetValue($args, "nomediretor")))
            || self::$utils->isNullOrEmpty(($data_lancamento = self::$utils->tryGetValue($args, "datalanca")))
            || self::$utils->isNullOrEmpty(($usuario_id = self::$utils->tryGetValue($args, "usuarioId")))) {
            self::$utils->onRawIndexErr("<strong>Campos</strong> preenchidos de forma inválida!", self::REF_LISTAR_USR);
            return;
        }

        $model = new FilmeModel($id, $nome, $duracao, $nome_diretor, $data_lancamento, $usuario_id);
        if (!FilmesDAO::getSingleton()->alterarFilme($model)) {
            self::$utils->onRawIndexErr("Não foi possível alterar os dados do usuário!", self::REF_LISTAR_USR);
            return;
        }

        self::$utils->onRawIndexOk("Usuário alterado com sucesso!", self::REF_LISTAR_USR);
    }
}