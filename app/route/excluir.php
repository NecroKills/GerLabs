<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../controller/UsuarioController.php");
require_once("../controller/ReservaController.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

switch($acao) {
  case 'logout': {
    $user = new UsuarioController();
    $user->logout();
    break;
  }
  case 'excluirUsuario': {
    $user = new UsuarioController();
    echo json_encode($user->excluir());
    break;
  }
  case 'excluirEvento': {
    $event = new ReservaController();
    echo json_encode($event->excluir());
    break;
  }
  default:
    echo 'Ação não encontrada.';
    break;
}
