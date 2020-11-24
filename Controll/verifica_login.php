<?php
include_once("login.php");
session_start();
var_dump($_SESSION);


if(isset($_SESSION["usuario"])) {
	header('Location: ..\View\index.php');
	exit();
}
?>