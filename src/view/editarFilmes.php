<?php include_once("../assets/header.html") ?>
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
        <h1 aling="center" style="background-color: #e63535;width:380px; color:whitesmoke;" class="rounded-bottom">Editar Filmes</h1>

        <form method="" style="background-color: #fff; height: 910px; width:380px;" class="rounded">
            <div class="form-group">
                <p>Nome do Filme</p>
                <input type="text" name="" value="Monstros S.A.">
            </div>
            <div class="form-group">
                <p>Duração</p>
                <input type="text" name="" value="1h 36m">
            </div>
            <div class="form-group">
                <p>Nome do Diretor</p>
                <input type="text" name="" value="Pete Docter">
            </div>
            <div class="form-group">
                <p>Data de Lançamento</p>
                <input type="text" style="width: 88px;" name="" value="14/11/2001">
            </div>
            </br>
            </br><input type="submit" name="" value="Editar" class="btn btn-danger">
        </form>
    </center>
    <h2><a href="../controller/logout.php">Sair</a></h2>
</body>

</html>