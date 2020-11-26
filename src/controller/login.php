<?php
if (($usr = $_POST['usuario']) === null || ($pass = $_POST['senha']) === null) {
    header("Location: ../view/");
    return;
}

include '../db/DbUtils.php';

use db\DbUtils;

$db = DbUtils::getSingleton();
if ($db->containsUsr($usr, $pass)) {
    session_start();

    $_SESSION['usuario'] = $usr;
    $_SESSION['senha'] = $pass;

    header("Location: ../view/home");
} else
    header("Location: ../view/?err=" . urlencode("<b>Usuário</b> ou <b>Senha</b> inválida!"));
?>