<?php session_start()?>
<?php include_once('C:\xampp\htdocs\untitled1\Controll\login.php')?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php 
    if(isset($_SESSION["nao_autenticado"])):
    ?>
<div class="alert alert-danger">
            <p>ERRO: Usuário ou senha inválidos.</p>
        </div>
        <?php endif ?>
    <center>
        
        <div class="login">

            <h1 aling="center" style="background-color: #e63535;width:380px; color:whitesmoke;" class="rounded-bottom">
                Login</h1>
            <form action=" ../View/home.php" method="POST"  style="background-color: #fff; height: 300px; width:380px;" class="rounded">
                <div class="form-group">
                    <p>Usuário</p>
                    <input type="text" name="usuario" placeholder="insira seu nome de usuário">
                </div>
                <div class="form-group">
                    <p>Senha</p>
                    <input type="text" name="senha" placeholder="Insira sua senha">
                </div>
                <input type="submit" name="logar" value="Login"><br>
                <a href="cadastroUsuarios.php">Ainda não se cadastrou?</a>
            </form>

        </div>
    </center>
</body>
</html>