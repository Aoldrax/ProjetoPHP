<?php include_once("../assets/header.html") ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuários</title>

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
    <h1 aling="center" style="background-color: #e63535;width:380px; color:whitesmoke;" class="rounded-bottom">
        Cadastrar Usuários</h1>

    <form action="../php/MVCRouter.php" method="post" style="background-color: #fff; height: 1333px; width:380px;"
          class="rounded">
        <div class="form-group">
            <p>Nome Completo</p>
            <input type="text" name="nomecomp" placeholder="Insira seu nome completo">
        </div>
        <input type="hidden" name="controller" value="usuario"/>
        <input type="hidden" name="action" value="cadastrar"/>
        <div class="form-group">
            <p>Usuário</p>
            <input type="text" name="usuario" placeholder="Insira seu nome de usuário">
        </div>
        <div class="form-group">
            <p>CPF</p>
            <input type="text" name="cpf" placeholder="Insira seu CPF">
        </div>
        <div class="form-group">
            <p>Celular</p>
            <input type="text" name="celular" placeholder="Insira seu Celular">
        </div>
        <div class="form-group">
            <p>Senha</p>
            <input type="password" name="senha" placeholder="Insira sua senha">
        </div>
        <div class="form-group">
            <p>Confirma Senha</p>
            <input type="password" name="confsenha" placeholder="Confirme sua senha">
        </div>
        <div class="form-group">
            <p>Email</p>
            <input type="text" name="email" placeholder="Insira seu email">
        </div>
        <div class="form-group">
            <p>Data de Nascimento</p>
            <input type="date" name="datanasc" placeholder="Insira sua data de nascimento">
        </div>
        <div class="form-group">
            <p>Estado</p>
            <div class="input-field col s12">
                <select name="estado">
                    <option value="" disabled selected>Escolha seu estado</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <p>Cidade</p>
            <input type="text" name="cidade" placeholder="Insira nome da sua cidade">
        </div>
        <div class="form-group">
            <p>Numero do cartão</p>
            <input type="text" name="numerocartao" placeholder="Insira numero do seu cartão">
        </div>
        <div class="form-group">
            <p>Codigo do cartão</p>
            <input type="text" name="codigocartao" placeholder="Insira codigo de seguraça de do seu cartão">
        </div>
        <div class="form-group">
            <p>Validade do cartão</p>
            <input type="text" name="validadecartao" placeholder="Insira validade do seu cartão">
        </div>
        </br>
        </br><input type="submit" name="salvar" value="cadastro" class="btn btn-danger">
    </form>
</center>
</body>

</html>