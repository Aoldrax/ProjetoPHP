<?php include_once("../assets/header.html") ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuarios</title>
</head>

<body>
<?php
include "../controller/ControllerManager.php";

use controller\ControllerManager;

$args = array(
    "controller" => "usuario",
    "action" => "listar"
);
$controller = $args['controller'];
$manager = ControllerManager::getSingleton();
if ($manager->controllerExists($controller))
    $manager->handler($controller, $args);
else
    $utils->onRawIndexErr("Controlador '<strong>" . $controller . "</strong>' indefinido!", $errRef);
?>
<h2><a href="../controller/logout.php">Sair</a></h2>
</body>

</html>