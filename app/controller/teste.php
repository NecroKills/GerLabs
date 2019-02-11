<?php
require_once("UsuarioController.php");

$controller = new UsuarioController();

$dados = $controller->buscarTodosUsuarios();

echo $dados;

 ?>
