<?php
require_once('../model/Laboratorio.php');
require_once('../model/Hardware.php');
require_once('../model/Software.php');
require_once('SoftwareController.php');

class LaboratorioController {

  public function cadastrar() {
    $hardwares = $_POST['hardwares'];
    $hardware = new Hardware();
      //cadastrar o hardware
    if ($hardware_id = $hardware->cadastrar($hardwares)) {
      /* Nessa variável $hardware_id eu tenho o ID do hardware que acabei de cadastrar */
      $laboratorio_dados = $_POST['laboratorio'];
      $laboratorio_dados["situacao"] = 1;
      $laboratorio_dados["hardwares_id"] = $hardware_id;
      //cadastrar laboratorio
      $laboratorio = new Laboratorio();
      if ($laboratorio_id = $laboratorio->cadastrar($laboratorio_dados)) {
        //Cadastrar softwares
        $software = new Software();
        $software->cadastrar($laboratorio_id, $_POST['softwares']);
        return ["success" => true, "text" => "Laboratório cadastrado com sucesso!"];
      }
      return ["success" => false, "text" => "Erro ao cadastrar Laboratório!"];
    }
    return ["success" => false, "text" => "Erro ao cadastrar Laboratório!"];
 }

  public function buscarNomeLaboratorios() {
      $laboratorio = new Laboratorio();
      return $laboratorio->listarNomeLaboratorios();
  }

  public function listarLaboratorios() {
      $laboratorio = new Laboratorio();
      $id = $_POST['laboratorio_id'];
      $dadosLaboratorio = $laboratorio->buscarLaboratorios($id);
      $software = new SoftwareController();
      $dadosLaboratorio->softwares = $software->getAll($id);
      return $dadosLaboratorio;
  }

  public function buscarProcessador() {
      $laboratorio = new Laboratorio();
      return $laboratorio->listarProcessador();
  }

  public function buscarMemoria() {
      $laboratorio = new Laboratorio();
      return $laboratorio->listarMemoria();
  }

  public function buscarPlaca_de_video() {
      $laboratorio = new Laboratorio();
      return $laboratorio->listarPlaca_de_video();
  }

  public function buscarSoftwares() {
      $laboratorio = new Laboratorio();
      return $laboratorio->listarSoftwares();
  }

}
