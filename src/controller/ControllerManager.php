<?php
/**
 * Created by PhpStorm.
 * User: devwarlt
 * Date: 26/11/2020
 * Time: 17:20
 */

namespace controller;

include "UsuarioController.php";

final class ControllerManager
{
    private static $singleton, $controllers;

    private function __construct()
    {
        self::$controllers = array();
        self::$controllers['usuario'] = UsuarioController::getSingleton();
    }

    public static function getSingleton(): ControllerManager
    {
        if (self::$singleton === null)
            self::$singleton = new ControllerManager();
        return self::$singleton;
    }

    public function controllerExists(string $controller): bool
    {
        return array_key_exists($controller, self::$controllers);
    }

    public function handler(string $controller, array $args): void
    {
        try {
            self::$controllers[$controller]->handler($args);
        } catch (\Error $err) {
            echo "
            <head><link rel='stylesheet' href='../assets/css/bootstrap.css' /></head>
            <div class='card text-white bg-danger' style='padding: 4px; width: 100%'>
            <div class='text-warning card-header'><strong>&tridot;&nbsp;&nbsp;<u>Error detected!</u></strong></div>
            <div class='card-body'>
                <h5>Error:</h5>&nbsp;
                <code class='text-warning bg-dark border-warning rounded'>&nbsp;" . $err->getMessage() . "&nbsp;</code>
            </div>
            <div class='card-footer'>
                <h5>Error::errorInfo():</h5>
                <p><small><strong>&blacktriangleright;&nbsp;Error Code:</strong> " . $err->getCode() . "</small></p>
                <p><small><strong>&blacktriangleright;&nbsp;File:</strong> " . $err->getFile() . "</small></p>
                <p><small><strong>&blacktriangleright;&nbsp;Line:</strong> " . $err->getLine() . "</small></p>
                <p><small><strong>&blacktriangleright;&nbsp;Stack Trace:</strong> " . implode("<br/>&nbsp;&nbsp;&nbsp;&nbsp;&diamond;&nbsp;<strong>Error</strong> #", explode("#", $err->getTraceAsString())) . "</small></p>
            </div>
        </div>
            ";
        }
    }
}
