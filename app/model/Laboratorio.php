<?php
require_once("Database.php");

class Laboratorio {

  private $pdo;

  public function __construct() {
      $this->pdo = new Database();
      $this->pdo = $this->pdo->getConexao();
  }

  public function cadastrar($dados)
  {
    $db = $this->pdo->prepare("insert into laboratorios (nome, capacidade, situacao, hardwares_id) values (:nome, :capacidade, :situacao, :hardwares_id)");
    $db->bindParam(":nome", $dados['nome']);
    $db->bindParam(":capacidade", $dados['capacidade']);
    $db->bindParam(":situacao", $dados['situacao']);
    $db->bindParam(":hardwares_id", $dados['hardwares_id']);
    $db->execute();
    /* Se executou mais de 0 linhas... */
    if($db->rowCount() > 0)
      return $this->pdo->lastInsertId();
    return false;
  }

  public function listarNomeLaboratorios(){
    $stmt = $this->pdo->prepare("SELECT id, nome from laboratorios");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function buscarLaboratorios($id){
    $conn = new Database();
    $resultado = $conn->getConexao()->query("SELECT
      LAB.nome,
      LAB.capacidade,
      LAB.situacao,
      VGA.nome as placa_de_video,
      MEM.nome as memoria,
      PROC.nome as processador,
      SOFT.nome as softwareNome,
      SOFT.versao as softwareVersao,
      SOFT.tipo as softwareTipo
FROM
     laboratorios AS LAB
     INNER JOIN hardwares AS HARD on (HARD.id = LAB.hardwares_id)
     INNER JOIN laboratorios_softwares AS LABSOFT on (LAB.id = LABSOFT.laboratorios_id)
     INNER JOIN placa_de_video AS VGA on (VGA.id = HARD.placa_de_video_id)
     INNER JOIN memoria AS MEM on (MEM.id = HARD.memoria_id)
     INNER JOIN processador AS PROC on (PROC.id = HARD.processador_id)
     INNER JOIN softwares AS SOFT on (SOFT.id = LABSOFT.softwares_id)
WHERE
      LAB.id = $id")->fetch();
    return $resultado;
  }

  public function listarProcessador(){
    $stmt = $this->pdo->prepare("SELECT id, nome from processador");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function listarMemoria(){
    $stmt = $this->pdo->prepare("SELECT id, nome from memoria");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function listarPlaca_de_video(){
    $stmt = $this->pdo->prepare("SELECT id, nome from placa_de_video");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function listarSoftwares(){
    $stmt = $this->pdo->prepare("SELECT id, nome, versao, tipo from softwares");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}
