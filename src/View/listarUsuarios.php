<?php include_once("../Assets/header.html") ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuarios</title>
</head>

<body>
    <table class="table" style="background-color: #fff; width:1920px; margin: 1px;">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Código</th>
            <th scope="col">Nome Completo</th>
            <th scope="col">Usuário</th>
            <th scope="col">CPF</th>
            <th scope="col">Celular</th>
            <th scope="col">Senha</th>
            <th scope="col">Email</th>
            <th scope="col">Data de Nascimento</th>
            <th scope="col">Estado</th>
            <th scope="col">Cidade</th>
            <th></th>
            <th></th>
        </tr>
        <?php ?>
        <tr>
            <th scope="row">1</th>
            <td>01</td>
            <td>Vinicius Melise de Menezes</td>
            <td>vinimelise</td>
            <td>074.55123-45</td>
            <td>(61)982481579</td>
            <td>vini1510</td>
            <td>viniciusm@gmail.com</td>
            <td>09/04/2000</td>
            <td>Distrito Federal</td>
            <td>Taguatinga</td>
            <td><input class="btn btn-danger" type="button" value="Deletar" ></td>
            <td><input class="btn btn-warning" type="button" value="Editar"></td>
        </tr>
        <?php ?>
        <table>
        <h2><a href="../Controller/logout.php">Sair</a></h2>
</body>

</html>