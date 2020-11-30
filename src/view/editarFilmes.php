<?php include_once("../assets/header.html");


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
    || $utils->isNullOrEmpty(($nome = $utils->tryGetValue($_POST, "nomefilme")))
    || $utils->isNullOrEmpty(($duracao = $utils->tryGetValue($_POST, "duracao")))
    || $utils->isNullOrEmpty(($nome_diretor = $utils->tryGetValue($_POST, "nomediretor")))
    || $utils->isNullOrEmpty(($data_lançamento = $utils->tryGetValue($_POST, "datalanca")))
    || $utils->isNullOrEmpty(($usuario_id = $utils->tryGetValue($_POST, "usuarioId")))) {
    $utils->onRawIndexErr("Não é possível alterar os cadastros deste filme devido a pendência de campos.", $refHome);
    return;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filmes</title>

</head>

<body>

<!--jquery-->
<center>
    <h1 aling="center" style="background-color: #e63535;width:380px; color:whitesmoke;" class="rounded-bottom">Editar
        Filmes</h1>

    <form action="../php/MVCRouter.php" method="post">
        <input type="hidden" name="controller" value="filme"/>
        <input type="hidden" name="action" value="editar"/>
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <div class="form-group">
            <p>Nome do Filme</p>
            <input type="text" name="nomefilme" value="<?php echo $nome; ?>">
        </div>
        <div class="form-group">
            <p>Duração</p>
            <input type="text" name="duracao" value="<?php echo $duracao; ?>">
        </div>
        <div class="form-group">
            <p>Nome do Diretor</p>
            <input type="text" name="nomediretor" value="<?php echo $nome_diretor; ?>">
        </div>
        <div class="form-group">
            <p>Data de Lançamento</p>
            <input type="text" style="width: 88px;" name="datalanca" value="<?php echo $data_lançamento; ?>">
        </div>
        <div class="form-group">
            <p>Id do usuario</p>
            <input type="text" style="width: 88px;" name="usuarioId" value="<?php echo $usuario_id; ?>">
        </div>
        </br>
        </br><input type="submit" value="Editar" class="btn btn-danger">
    </form>
</center>
<h2><a href="../controller/logout.php">Sair</a></h2>
</body>

</html>