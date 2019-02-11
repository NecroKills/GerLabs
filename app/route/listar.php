<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../controller/UsuarioController.php");
require_once("../controller/LaboratorioController.php");
require_once("../controller/ReservaController.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

switch($acao) {
  case 'logarUsuario': {
    $usuario = new UsuarioController();
    $resultado = $usuario->verificaAtivo();
    // echo $resultado;
    break;
  }
  case 'todosUsuarios': {
    $usuario = new UsuarioController();
    $resultado = $usuario->getAll();
    echo json_encode($resultado);
    break;
  }
  case 'buscarUsuario': {
    $usuario = new UsuarioController();
    $resultado = $usuario->buscar();
    echo json_encode($resultado);
    break;
  }
  case 'buscarLaboratorios': {
    $laboratorio = new LaboratorioController();
    $resultado = $laboratorio->listarLaboratorios();
    echo json_encode($resultado);
    break;
  }
  case 'buscarProcessador': {
    $laboratorio = new LaboratorioController();
    $resultado = $laboratorio->buscarProcessador();
    echo json_encode($resultado);
    break;
  }
  case 'buscarMemoria': {
    $laboratorio = new LaboratorioController();
    $resultado = $laboratorio->buscarMemoria();
    echo json_encode($resultado);
    break;
  }
  case 'buscarPlaca_de_video': {
    $laboratorio = new LaboratorioController();
    $resultado = $laboratorio->buscarPlaca_de_video();
    echo json_encode($resultado);
    break;
  }
  case 'buscarDatasLaboratorio': {
    $reserva = new ReservaController();
    $resultado = $reserva->getDatas();
    echo json_encode($resultado);
    break;
  }
  case 'buscarDatasSolicitacoesLaboratorio': {
    $reserva = new ReservaController();
    $resultado = $reserva->getSolicitacoesDatas();
    echo json_encode($resultado);
    break;
  }
  case 'buscarReservasUsuario': {
    $reserva = new ReservaController();
    $resultado = $reserva->getReservasUsuario();
    echo json_encode($resultado);
    break;
  }

  default:
    echo 'Ação não encontrada.';
    break;
}
?>
