<?php


namespace controller;

interface IController
{
    function handler(array $array): void;
}