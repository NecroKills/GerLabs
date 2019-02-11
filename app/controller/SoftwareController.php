<?php

require_once("../model/Software.php");

class SoftwareController {

  private $software;

  public function __construct()
  {
    $this->software = new Software();
  }

  public function getAll($laboratorio)
  {
      return $this->software->getAll($laboratorio);
  }

  public function cadastrarSoftware()
  {
    $dados = $_POST['softwares'];    

    if($this->software->addSoftware($dados)) {
      return ["success" => true, "text" => "Software cadastrado com sucesso no banco de dados"];
    }else{
      return ["success" => false, "text" => "Erro ao cadastrar software no banco de dados"];
    }
  }
}
