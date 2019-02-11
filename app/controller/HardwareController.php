<?php

require_once('../model/Hardware.php');

class HardwareController {

  public function cadastrarProcessador()
  {
    $dados = $_POST['processador'];
    $laboratorio = new Hardware();

    if($laboratorio->addProcessador($dados)) {
      return ["success" => true, "text" => "Processador cadastrado com sucesso no banco de dados"];
    }else{
      return ["success" => false, "text" => "Erro ao cadastrar processador no banco de dados"];
    }
  }

  public function cadastrarMemoria()
  {
    $dados = $_POST['memoria'];
    $laboratorio = new Hardware();

    if($laboratorio->addMemoria($dados)) {
      return ["success" => true, "text" => "Memoria cadastrado com sucesso no banco de dados"];
    }else{
      return ["success" => false, "text" => "Erro ao cadastrar memoria no banco de dados"];
    }
  }

  public function cadastrarPlacaDeVideo()
  {
    $dados = $_POST['placa_de_video'];
    $laboratorio = new Hardware();

    if($laboratorio->addPlacaDeVideo($dados)) {
      return ["success" => true, "text" => "Placa de Video cadastrado com sucesso no banco de dados"];
    }else{
      return ["success" => false, "text" => "Erro ao cadastrar Placa de Video no banco de dados"];
    }
  }

  // public function cadastrarProcessador($valor) {
  //   $dados = $valor;
  //   $laboratorio = new Hardware();
  //   $laboratorio->cadastrarProcessador($dados);
  // }
  //
  // public function cadastrarMemoria($valor) {
  //   $dados = $valor;
  //   $laboratorio = new Hardware();
  //   $laboratorio->cadastrarMemoria($dados);
  // }
  //
  // public function cadastrarPlaca_de_video($valor) {
  //   $dados = $valor;
  //   $laboratorio = new Hardware();
  //   $laboratorio->cadastrarPlaca_de_video($dados);
  // }

}
