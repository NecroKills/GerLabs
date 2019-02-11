<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../controller/UsuarioController.php");
require_once("../controller/ReservaController.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

switch($acao) {
  case 'atualizarUsuario': {
    $usuario = new UsuarioController();
    $resultado = $usuario->atualizar();
    echo json_encode($resultado);
    break;
  }
  case 'editarReserva': {
      $controller = new ReservaController();
      echo json_encode($controller->editarReserva());
      break;
  }
  case 'editarReservaUsuario': {
      $controller = new ReservaController();
      echo json_encode($controller->editarReservaUsuario());
      break;
  }
  case 'editarData': {
      $controller = new ReservaController();
      echo json_encode($controller->editarDataReserva());
      break;
  }
  case 'editarStatusReserva': {
      $controller = new ReservaController();
      echo json_encode($controller->editarStatusReserva());
      break;
  }
  default:
    echo 'Ação não encontrada.';
    break;
}
?>
