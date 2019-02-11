<?php
require_once("Database.php");

class Reserva {

  private $pdo;

  public function __construct()
  {
      $this->pdo = new Database();
      $this->pdo = $this->pdo->getConexao();
  }

  public function listarEventos()
  {
    $stmt = $this->pdo->prepare("SELECT id, title, start, end, color FROM reservas  WHERE situacao = 1");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function listarSolicitacoesEventos()
  {
    $stmt = $this->pdo->prepare("SELECT * FROM reservas  WHERE situacao = 0");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getDatas($laboratorio)
  {
    $db = $this->pdo->prepare("SELECT
                                *
                              FROM  reservas
                              WHERE laboratorios_id = $laboratorio
                              AND situacao = 1");
    $db->execute();
    return $db->fetchAll();
  }

  public function getSolicitacoesDatas($laboratorio)
  {
    $db = $this->pdo->prepare("SELECT
          LAB.nome AS nomeLaboratorio,
          RES.id,
          RES.title,
          RES.color,
          RES.start,
          RES.end,
          USER.nome AS usuarioNome,
          USER.email AS usuarioEmail,
          PROF.nome AS professorNome
    FROM
         usuarios AS USER,
         professores AS PROF,
         laboratorios AS LAB,
         reservas AS RES

    WHERE     PROF.id = RES.professores_id
          and USER.id = RES.usuarios_id
          and LAB.id = RES.laboratorios_id
          and RES.laboratorios_id = $laboratorio
          and RES.situacao = 0");
    $db->execute();
    return $db->fetchAll();
  }

  public function getReservasUsuario($laboratorio)
  {
    @session_start();
    $db = $this->pdo->prepare("SELECT
                                *
                              FROM  reservas
                              WHERE laboratorios_id = $laboratorio
                              AND situacao = 1
                              AND usuarios_id = :sessao");
    $db->bindParam(":sessao", $_SESSION['usuario']['id']);
    $db->execute();
    return $db->fetchAll();
  }

  public function cadastrar($dados)
  {
    @session_start();
    $db = $this->pdo->prepare("INSERT INTO reservas (professores_id, laboratorios_id, usuarios_id, title, color, start, end) values (:professores_id, :laboratorios_id, :usuarios_id, :title, :color, :start, :end)");
    $db->bindParam(":professores_id", $dados['professores_id']);
    $db->bindParam(":laboratorios_id", $dados['laboratorios_id']);
    $db->bindParam(":usuarios_id", $_SESSION['usuario']['id']);
    $db->bindParam(":title", $dados['title']);
    $db->bindParam(":color", $dados['color']);
    $db->bindParam(":start", $dados['start']);
    $db->bindParam(":end", $dados['end']);
    $db->execute();
    if($db->rowCount() > 0) {
      return true;
    }
      return false;
  }

  public function getDataHoraLab($inicio, $fim, $laboratorio)
  {
    $stmt = $this->pdo->prepare("select * from reservas
                                  where laboratorios_id = $laboratorio
                                  and ((start <= STR_TO_DATE('$inicio', '%Y-%m-%d %H:%i:%s') and end > STR_TO_DATE('$inicio', '%Y-%m-%d %H:%i:%s'))
                                  or (start < STR_TO_DATE('$fim', '%Y-%m-%d %H:%i:%s') and end >= STR_TO_DATE('$fim', '%Y-%m-%d %H:%i:%s'))
                                  or (start >= STR_TO_DATE('$inicio', '%Y-%m-%d %H:%i:%s') and end < STR_TO_DATE('$fim', '%Y-%m-%d %H:%i:%s')))");
    $stmt->execute();
    if($stmt->rowCount() > 0) {
      return false;
    }
      return true;
  }

  public function editarReserva($dados)
  {
    $db = $this->pdo->prepare("UPDATE reservas SET title = :title, color = :color WHERE id = :id");
    $db->execute(array(
    ':title'   => $dados['title'],
    ':color' => $dados['color'],
    ':id' => $dados['id']
    ));
    if($db->rowCount() > 0){
      return true;
    }
      return false;
  }

  public function excluirReserva($dados)
  {
    $stmt = $this->pdo->prepare("DELETE FROM reservas where id = :id");
    $stmt->execute(array(':id' => $dados['id']));
    $stmt->execute();
    if($stmt->rowCount() > 0){
      return false;
    }
      return true;
  }

  public function editarReservaUsuario($dados)
  {
    @session_start();
    $db = $this->pdo->prepare("UPDATE reservas SET title = :title, color = :color WHERE id = :id AND usuarios_id = :sessao");
    $db->execute(array(
    ':title'   => $dados['title'],
    ':color' => $dados['color'],
    ':id' => $dados['id'],
    ':sessao' => $_SESSION['usuario']['id']
    ));

    if($db->rowCount() > 0){
      return true;
    }
      return false;
  }

  public function excluirReservaUsuario($dados)
  {
    @session_start();
    $stmt = $this->pdo->prepare("DELETE FROM reservas where id = :id AND usuarios_id = :sessao");
    $stmt->execute(array(':id' => $dados['id'], ':sessao' => $_SESSION['usuario']['id']));
    $stmt->execute();
    if($stmt->rowCount() > 0){
      return false;
    }
      return true;
  }

  public function editarStatusReserva($dados)
  {
    $db = $this->pdo->prepare("UPDATE reservas SET title = :title, color = :color, situacao = :situacao WHERE id = :id");
    $db->execute(array(
    ':title'   => $dados['title'],
    ':color' => $dados['color'],
    ':situacao' => $dados['situacao'],
    ':id' => $dados['id']
    ));
    if($db->rowCount() > 0){
      return true;
    }
      return false;
  }

  public function editarDataReserva($dados)
  {
    $db = $this->pdo->prepare("UPDATE reservas SET  start = :start, end = :end WHERE id = :id");
    $db->execute(array(
    ':start' => $dados['1'],
    ':end' => $dados['2'],
    ':id' => $dados['0']
    ));
    if($db->rowCount() > 0){
      return true;
    }
      return false;
  }

  public function listarProfessor()
  {
      $stmt = $this->pdo->prepare("SELECT id, nome from professores");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  public function addProfessor($dados)
  {
    $db = $this->pdo->prepare("insert into professores (nome, matricula) values (:nome, :matricula)");
    $db->bindParam(":nome", $dados['nome']);
    $db->bindParam(":matricula", $dados['matricula']);
    $db->execute();
    if($db->rowCount() > 0){
      return true;
    }
      return false;
  }

}
