<?php


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
    private const REF_HOME = "../view/home";
    private const REF_LISTAR_USR = "../view/listarUsuarios";

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
                $this->cadastrarNovoUsuario($args);
                break;
            case "listar":
                $this->listarTodosUsuarios();
                break;
            case "remover":
                $this->removerUsuario($args);
                break;
            case "editar":
                $this->editarUsuario($args);
                break;
        }
    }

    private function autenticarUsuario(array $args): void
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

            self::$utils->onRawIndexEmpty(self::REF_HOME);
        }
    }

    private function logoutUsuario(): void
    {
        session_start();
        session_destroy();

        self::$utils->onRawIndexOk("Logout efetuado com sucesso!", self::REF_INDEX);
    }

    private function cadastrarNovoUsuario(array $args): void
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

    private function listarTodosUsuarios(): void
    {
        if (($usuarios = UsuarioDAO::getSingleton()->listarUsuarios()) === null) {
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
                    <th scope="col">Nome Completo</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Email</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Cidade</th>
                    <th></th>
                    <th></th>
                </tr>
        ';

        $i = 0;
        foreach ($usuarios as $usuario)
            $context .= '
                <tr>
                    <th scope="row">' . ++$i . '</th>
                    <td>' . $usuario->getId() . '</td>
                    <td>' . $usuario->getNome() . '</td>
                    <td>' . $usuario->getUsuario() . '</td>
                    <td>' . $usuario->getCpf() . '</td>
                    <td>' . $usuario->getCelular() . '</td>
                    <td>' . $usuario->getEmail() . '</td>
                    <td>' . $usuario->getDataNascimento() . '</td>
                    <td>' . $usuario->getEstado() . '</td>
                    <td>' . $usuario->getCidade() . '</td>
                    <td>
                        <form action="../php/MVCRouter.php" method="post">
                            <input type="hidden" name="controller" value="usuario"/>
                            <input type="hidden" name="action" value="remover"/>
                            <input type="hidden" name="id" value="' . $usuario->getId() . '"/>
                            <input class="btn btn-danger" type="submit" value="Deletar"/>
                        </form>
                    </td>
                    <td>
                        <form action="editarUsuario.php" method="post">
                            <input type="hidden" name="id" value="' . $usuario->getId() . '"/>
                            <input type="hidden" name="nomecomp" value="' . $usuario->getNome() . '"/>
                            <input type="hidden" name="usuario" value="' . $usuario->getUsuario() . '"/>
                            <input type="hidden" name="cpf" value="' . $usuario->getCpf() . '"/>
                            <input type="hidden" name="celular" value="' . $usuario->getCelular() . '"/>
                            <input type="hidden" name="senha" value="' . $usuario->getSenha() . '"/>
                            <input type="hidden" name="confsenha" value="' . $usuario->getConfirSenha() . '"/>
                            <input type="hidden" name="email" value="' . $usuario->getEmail() . '"/>
                            <input type="hidden" name="datanasc" value="' . $usuario->getDataNascimento() . '"/>
                            <input type="hidden" name="estado" value="' . $usuario->getEstado() . '"/>
                            <input type="hidden" name="cidade" value="' . $usuario->getCidade() . '"/>
                            <input type="hidden" name="numerocartao" value="' . $usuario->getNumerodocartao() . '"/>
                            <input type="hidden" name="codigocartao" value="' . $usuario->getCodigocartao() . '"/>
                            <input type="hidden" name="validadecartao" value="' . $usuario->getValidadecartao() . '"/>
                            <input class="btn btn-warning" type="submit" value="Editar"/>
                        </form>
                    </td>
                </tr>
            ';

        $context .= '</table>';
        echo $context;
    }

    private function removerUsuario(array $args): void
    {
        if (self::$utils->isNullOrEmpty(($id = self::$utils->tryGetValue($args, "id")))) {
            self::$utils->onRawIndexErr("Elemento de identificação do usuário não encontrada!", self::REF_INDEX);
            return;
        }

        if (!UsuarioDAO::getSingleton()->removerUsuario($id)) {
            self::$utils->onRawIndexErr("Não foi possível remover o usuário do sistema!<br/><strong>ID:</strong>" . $id, self::REF_INDEX);
            return;
        }

        self::$utils->onRawIndexEmpty(self::REF_HOME);
    }


    private function editarUsuario(array $args): void
    {
        if (self::$utils->isNullOrEmpty(($id = self::$utils->tryGetValue($args, "id")))
            || self::$utils->isNullOrEmpty(($nome = self::$utils->tryGetValue($args, "nomecomp")))
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
            self::$utils->onRawIndexErr("<strong>Campos</strong> preenchidos de forma inválida!", self::REF_LISTAR_USR);
            return;
        }

        $model1 = new UsuarioModel($id, $nome, $usuario, $cpf, $celular, $senha, $confir_senha, $email, $data_nascimento, $estado, $cidade, $numerodocartao, $codigocartao, $validadecartao);
        if (!UsuarioDAO::getSingleton()->alterarUsuario($model1)) {
            self::$utils->onRawIndexErr("Não foi possível alterar os dados do usuário!", self::REF_LISTAR_USR);
            return;
        }

        self::$utils->onRawIndexOk("Usuário alterado com sucesso!", self::REF_LISTAR_USR);
    }
}
