<?php

include "../php/PhpUtils.php";

use php\PhpUtils;

session_start();

if (!isset($_SESSION["usuario"])) {
    PhpUtils::getSingleton()->onRawIndexErr("É necessário realizar login para acessar esta página!", "/view/");
    return;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include "../assets/header.html"; ?>
    <title>Home</title>
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
                <input class="font-weight-bold btn btn-lg btn-danger" type="submit" value="Sair"/>
            </form>
        </td>
        <td align="right">
            <form action="listarUsuarios.php" method="post">
                <input class="font-weight-bold btn btn-lg btn-primary" type="submit" value="Listar Usuario"/>
            </form>
        </td>
        <td align="right">
            <form action="cadastroUsuarios.php" method="post">
                <input class="font-weight-bold btn btn-lg btn-primary" type="submit"
                       value="Cadastrar novo usuario"/>
            </form>
        </td>
    </tr>
</table>
</body>
</html>