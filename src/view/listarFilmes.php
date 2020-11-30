<?php

include "../php/PhpUtils.php";

use controller\ControllerManager;
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
    <title>Listar Filmes</title>
</head>

<body style="height: 100%;" class="alert-light">
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
<table class="table" border="0" width="100%">
    <tr>
        <td width="75%">
            <p class="card-header text-light">
                Seja bem-vindo(a), <strong><?php echo $_SESSION["usuario"]; ?></strong>!
            </p>
        </td>

        </form>
    </tr>
</table>
<?php

include "../controller/IController.php";
include "../controller/ControllerManager.php";

$args = array(
    "controller" => "filme",
    "action" => "listar"
);
$controller = $args['controller'];
$manager = ControllerManager::getSingleton();
if ($manager->controllerExists($controller))
    $manager->handler($controller, $args);
else
    $utils->onRawIndexErr("Controlador '<strong>" . $controller . "</strong>' indefinido!", $errRef);
?>
</body>

</html>