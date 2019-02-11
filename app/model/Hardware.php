<?php
require_once("Database.php");

class Hardware
{
  private $pdo;

  public function __construct()
  {
      $this->pdo = new Database();
      $this->pdo = $this->pdo->getConexao();
  }

  public function cadastrar($dados)
  {
      $db = $this->pdo->prepare("insert into hardwares (placa_de_video_id, memoria_id, processador_id) values (:placa_de_video, :memoria, :processador)");
      $db->bindParam(":placa_de_video", $dados['placa_de_video_id']);
      $db->bindParam(":memoria", $dados['memoria_id']);
      $db->bindParam(":processador", $dados['processador_id']);
      $db->execute();
      /* Se executou mais de 0 linhas... */
      if($db->rowCount() > 0){
        return $this->pdo->lastInsertId();
      }
        return false;
  }

  public function addProcessador($dados) {
    $db = $this->pdo->prepare("insert into processador (nome) values (:nome)");
    $db->bindParam(":nome", $dados['nome']);
    $db->execute();
    if($db->rowCount() > 0){
      return true;
    }
      return false;
  }

  public function addMemoria($dados) {
    $db = $this->pdo->prepare("insert into memoria (nome) values (:nome)");
    $db->bindParam(":nome", $dados['nome']);
    $db->execute();
    if($db->rowCount() > 0){
      return true;
    }
      return false;
  }

  public function addPlacaDeVideo($dados) {
    $db = $this->pdo->prepare("insert into placa_de_video (nome) values (:nome)");
    $db->bindParam(":nome", $dados['nome']);
    $db->execute();
    if($db->rowCount() > 0){
      return true;
    }
      return false;
  }

    // public function cadastrarProcessador($valor) {
    //   $this->pdo->query("insert into processador (nome)
    //                                                   values ('".$valor['nome']."')");
    // }
    //
    // public function cadastrarMemoria($valor) {
    //   $this->pdo->query("insert into memoria (nome)
    //                                                   values ('".$valor['nome']."')");
    // }
    //
    // public function cadastrarPlaca_de_video($valor) {
    //   $this->pdo->query("insert into placa_de_video (nome)
    //                                                   values ('".$valor['nome']."')");
    // }

}
