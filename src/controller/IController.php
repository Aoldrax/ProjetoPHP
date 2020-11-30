<?php
/**
 * Created by PhpStorm.
 * User: devwarlt
 * Date: 26/11/2020
 * Time: 17:18
 */

namespace controller;

interface IController
{
    function handler(array $array): void;
}