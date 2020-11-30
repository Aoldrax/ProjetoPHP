<?php include_once("../assets/header.html") ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Filmes</title>

</head>

<body>

<!--jquery-->
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
    <h1 aling="center" style="background-color: #e63535;width:380px; color:whitesmoke;" class="rounded-bottom">Cadastrar
        Filmes</h1>

    <form action="../php/MVCRouter.php" method="post" style="background-color: #fff; height: 910px; width:380px;"
          class="rounded">
        <div class="form-group">
            <p>Nome do Filme</p>
            <input type="text" name="nomefilme" placeholder="Insira o nome do filmes">
        </div>
        <div class="form-group">
            <p>Duração</p>
            <input type="text" name="duracao" placeholder="Insira a duração do filme">
        </div>
        <div class="form-group">
            <p>Nome do Diretor</p>
            <input type="text" name="nomediretor" placeholder="Insira o nome do diretor">
        </div>
        <div class="form-group">
            <p>Data de Lançamento</p>
            <input type="date" name="datalanca" placeholder="Insira o data de lançamento">
        </div>
        </br>
        </br><input type="submit" value="cadastrar" class="btn btn-danger">
    </form>
</center>
</body>

</html>