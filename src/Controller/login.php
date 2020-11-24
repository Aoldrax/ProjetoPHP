<?php
if (($usr = $_POST['usuario']) === null || ($pass = $_POST['senha']) === null) {
    header("Location: ../View/");
    return;
}

include '../Db/DbUtils.php';

use Db\DbUtils;

$db = DbUtils::getSingleton();
if ($db->containsUsr($usr, $pass)) {
    session_start();

    $_SESSION['usuario'] = $usr;
    $_SESSION['senha'] = $pass;

    header("Location: ../View/home");
} else
    header("Location: ../View/?err=" . urlencode("<b>Usuário</b> ou <b>Senha</b> inválida!"));
?>