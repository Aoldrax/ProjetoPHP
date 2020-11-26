<?php
/**
 * Created by PhpStorm.
 * User: devwarlt
 * Date: 26/11/2020
 * Time: 17:20
 */

namespace controller;

include "IController.php";
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
        self::$controllers[$controller]->handler($args);
    }
}