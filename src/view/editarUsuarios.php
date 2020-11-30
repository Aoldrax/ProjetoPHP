<?php

include "../php/PhpUtils.php";

use php\PhpUtils;
session_start();

$utils = PhpUtils::getSingleton();
$refHome = "/home";

if (!isset($_SESSION["usuario"])) {
    $utils->onRawIndexErr("É necessário realizar login para acessar esta página!", "/view/");
    return;
}

if ($utils->isNullOrEmpty(($id = $utils->tryGetValue($_POST, "id")))
    || $utils->isNullOrEmpty(($nome = $utils->tryGetValue($_POST, "nomecomp")))
    || $utils->isNullOrEmpty(($usuario = $utils->tryGetValue($_POST, "usuario")))
    || $utils->isNullOrEmpty(($cpf = $utils->tryGetValue($_POST, "cpf")))
    || $utils->isNullOrEmpty(($celular = $utils->tryGetValue($_POST, "celular")))
    || $utils->isNullOrEmpty(($senha = $utils->tryGetValue($_POST, "senha")))
    || $utils->isNullOrEmpty(($confir_senha = $utils->tryGetValue($_POST, "confsenha")))
    || $utils->isNullOrEmpty(($email = $utils->tryGetValue($_POST, "email")))
    || $utils->isNullOrEmpty(($data_nascimento = $utils->tryGetValue($_POST, "datanasc")))
    || $utils->isNullOrEmpty(($estado = $utils->tryGetValue($_POST, "estado")))
    || $utils->isNullOrEmpty(($cidade = $utils->tryGetValue($_POST, "cidade")))
    || $utils->isNullOrEmpty(($numerodocartao = $utils->tryGetValue($_POST, "numerocartao")))
    || $utils->isNullOrEmpty(($codigocartao = $utils->tryGetValue($_POST, "codigocartao")))
    || $utils->isNullOrEmpty(($validadecartao = $utils->tryGetValue($_POST, "validadecartao")))) {
    $utils->onRawIndexErr("Não é possível alterar os cadastros deste usuário devido a pendência de campos.", $refHome);
    return;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include "../assets/header.html"; ?>
    <title>Editar Usuários</title>
</head>
<body style="height: 100%;" class="alert-light">
<table class="table" border="0" width="100%">
    <tr>
        <td width="75%">
            <p class="card-header text-light">
                Seja bem-vindo(a), <strong><?php echo $_SESSION["usuario"]; ?></strong>!
            </p>
        </td>
        <td align="right">
            <form action="../php/MVCRouter.php" method="post">
                <input type="hidden" name="controller" value="usuario"/>
                <input type="hidden" name="action" value="logout"/>
                <input class="font-weight-bold btn btn-lg btn-outline-danger" type="submit" value="Sair"/>
            </form>
        </td>
    </tr>
</table>
<center>
    <h1 align="center" style="background-color: #e63535;width:380px; color:whitesmoke;" class="rounded-bottom">Editar Usuários</h1>
    <div style="background-color: #fff; height: 1333px; width:380px;" class="rounded">
        <form action="../php/MVCRouter.php" method="post">
            <input type="hidden" name="controller" value="usuario"/>
            <input type="hidden" name="action" value="editar"/>
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nomecomp" value="<?php echo $nome; ?>"/>
            </div>
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>"/>
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" value="<?php echo $cpf; ?>"/>
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" id="celular" name="celular" value="<?php echo $celular; ?>"/>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="text" id="senha" name="senha" value="<?php echo $senha; ?>"/>
            </div>
            <div class="form-group">
                <label for="confsenha">Confirmar Senha</label>
                <input type="text" id="confsenha" name="confsenha" value="<?php echo $confir_senha; ?>"/>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>"/>
            </div>
            <div class="form-group">
                <label for="datanasc">Data de Nascimento</label>
                <input type="date" id="datanasc" name="datanasc" value="<?php echo $data_nascimento; ?>"/>
            </div>
            <div class="form-group">
                <p>Estado</p>
                <div class="input-field col s12">
                    <?php
                    $estados = array(
                        "AC" => "Acre",
                        "AL" => "Alagoas",
                        "AP" => "Amapá",
                        "AM" => "Amazonas",
                        "BA" => "Bahia",
                        "CE" => "Ceará",
                        "DF" => "Distrito Federal",
                        "ES" => "Espírito Santo",
                        "GO" => "Goiás",
                        "MA" => "Maranhão",
                        "MT" => "Mato Grosso",
                        "MS" => "Mato Grosso do Sul",
                        "MG" => "Minas Gerais",
                        "PA" => "Pará",
                        "PB" => "Paraíba",
                        "PR" => "Paraná",
                        "PE" => "Pernambuco",
                        "PI" => "Piauí",
                        "RJ" => "Rio de Janeiro",
                        "RN" => "Rio Grande do Norte",
                        "RS" => "Rio Grande do Sul",
                        "RO" => "Rondônia",
                        "RR" => "Roraima",
                        "SC" => "Santa Catarina",
                        "SP" => "São Paulo",
                        "SE" => "Sergipe",
                        "TO" => "Tocantins",
                    );
                    $estadoSelect = '
                        <label for="estado">Estados</label>
                        <select id="estado" name="estado">
                            <option value="" disabled>Escolha seu estado</option>
                    ';
                    foreach ($estados as $sigla => $estado_)
                        $estadoSelect .= '<option value="' . $sigla . '"' . ($estado === $sigla ? " selected" : "") . '>' . $estado_ . '</option>';
                    $estadoSelect .= '</select>';
                    echo $estadoSelect;
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" value="<?php echo $cidade; ?>"/>
            </div>
            <div class="form-group">
                <label for="numerocartao">Número do cartão</label>
                <input type="text" id="numerocartao" name="numerocartao" value="<?php echo $numerodocartao; ?>"/>
            </div>
            <div class="form-group">
                <label for="codigocartao">Codigo do cartão</label>
                <input type="text" id="codigocartao" name="codigocartao" value="<?php echo $codigocartao; ?>"/>
            </div>
            <div class="form-group">
                <label for="validadecartao">Validade do cartão</label>
                <input type="text" id="validadecartao" name="validadecartao" value="<?php echo $validadecartao; ?>"/>
            </div>
            <br/>
            <br/>
            <input type="submit" class="btn btn-lg btn-success" value="Salvar"/>
            <a href="listarUsuarios.php">
                <input type="button" class="btn btn-lg btn-danger" value="Voltar"/>
            </a>
        </form>
    </div>
</center>
</body>
</html>
