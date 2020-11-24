<?php
include_once("../Cabeçalho/cabecalho.html");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Filmes</title>
</head>

<body>
    <table class="table" style="background-color: #fff; width:1920px; margin: 1px;">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Código</th>
            <th scope="col">Nome do Filme</th>
            <th scope="col">Duração</th>
            <th scope="col">Nome do Diretor</th>
            <th scope="col">Data de Lançamento</th>
            <th></th>
            <th></th>
        </tr>
        <?php ?>
        <tr>
            <th scope="row">1</th>
            <td>01</td>
            <td>Monstros S.A.</td>
            <td>1h 36m</td>
            <td>Pete Docter</td>
            <td>14/11/2001</td>
            <td><input class="btn btn-danger" type="button" value="Deletar" ></td>
            <td><input class="btn btn-warning" type="button" value="Editar"></td>
        </tr>
        <?php ?>
        <table>
      
<h2><a href="../Controll/logooff.php">Sair</a></h2>
</body>

</html>