<?
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: home");
    return;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include "../assets/header.html"; ?>
    <title>Login</title>
</head>

<body>

<center>
    <?php
    if (isset($_GET['err']))
        echo '
        <div class="alert alert-danger">
            <p>' . urldecode($_GET['err']) . '</p>
        </div>
        <hr/>
        ';
    if (isset($_GET['success']))
        echo '
        <div class="alert alert-success">
            <p>' . urldecode($_GET['success']) . '</p>
        </div>
        <hr/>
        ';
    ?>
    <div class="login">
        <h1 align="center" style="background-color: #e63535;width:380px; color:whitesmoke;" class="rounded-bottom">
            Login</h1>
        <form action="../php/MVCRouter.php" method="post" style="background-color: #fff; height: 300px; width:380px;"
              class="rounded">
            <input type="hidden" name="controller" value="usuario"/>
            <input type="hidden" name="action" value="login"/>
            <div class="form-group">
                <label for="nome">Usuário</label>
                <input type="text" name="usuario" placeholder="insira seu nome de usuário">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" placeholder="Insira sua senha">
            </div>
            <input type="submit" class="btn btn-lg btn-success" value="Login"/>
            <br/>
            <a href="cadastroUsuarios">Ainda não se cadastrou?</a>
        </form>
    </div>
</center>
</body>
</html>