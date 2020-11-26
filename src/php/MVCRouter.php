<?php
/**
 * Created by PhpStorm.
 * User: devwarlt
 * Date: 26/11/2020
 * Time: 17:07
 */

include "PhpUtils.php";

use controller\ControllerManager;
use php\PhpUtils;

$utils = PhpUtils::getSingleton();
$errRef = "../view/";

if (count($_POST) === 0 || !isset($_POST["controller"])) {
    $utils->onRawIndexErr("Requisição inválida!", $errRef);
    return;
}

include "../controller/ControllerManager.php";

$controller = $_POST["controller"];
$manager = ControllerManager::getSingleton();
if ($manager->controllerExists($controller))
    $manager->handler($controller, $_POST);
else
    $utils->onRawIndexErr("Controlador '" . $controller . "' indefinido!", $errRef);