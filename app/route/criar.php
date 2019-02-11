<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../controller/UsuarioController.php");
require_once("../controller/LaboratorioController.php");
require_once("../controller/HardwareController.php");
require_once("../controller/ReservaController.php");
require_once("../controller/SoftwareController.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

switch($acao) {
  case 'criarUsuario': {
     $controller = new UsuarioController();
     echo json_encode($controller->cadastrarUsuario());
     break;
  }
  case 'criarLaboratorios': {
      $controller = new LaboratorioController();
      echo json_encode($controller->cadastrar());
      break;
  }
  case 'cadastrarEvento': {
      $controller = new ReservaController();
      echo json_encode($controller->cadastrar());
      break;
  }
  case 'addProcessador': {
      $controller = new HardwareController();
      echo json_encode($controller->cadastrarProcessador());
      break;
  }
  case 'addMemoria': {
      $controller = new HardwareController();
      echo json_encode($controller->cadastrarMemoria());
      break;
  }
  case 'addPlacaDeVideo': {
      $controller = new HardwareController();
      echo json_encode($controller->cadastrarPlacaDeVideo());
      break;
  }
  case 'addProfessor': {
      $controller = new ReservaController();
      echo json_encode($controller->cadastrarProfessor());
      break;
  }
  case 'addSoftware': {
      $controller = new SoftwareController();
      echo json_encode($controller->cadastrarSoftware());
      break;
  }
  default:
    echo 'Ação não encontrada.';
    break;
}

?>
