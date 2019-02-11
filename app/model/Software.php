<?php
require_once("Database.php");

class Software
{
  private $pdo;

  public function __construct()
  {
      $this->pdo = new Database();
      $this->pdo = $this->pdo->getConexao();
  }

  public function cadastrar($laboratorio_id, $softwares)
  {
    /**
      * Para cada software da variavel softwares vou ter que cadastrar na tabela laboratorio_softwares;
    */
    // Eu preciso percorrer o array que contem os meus softwares, que é a variável $softwares
    // Se você tem um array de $softwares, nele contem 1 ou N posições, basta fazer um foreach...
    // Para cada software dentro de $softwares ele irá inserir no banco, ai vai para proxima posição do $softwares.... Até terminar.
    foreach($softwares as $key => $software) {
      $db = $this->pdo->prepare("insert into laboratorios_softwares (laboratorios_id, softwares_id) values (:laboratorios_id, :softwares_id)");
      $db->bindParam(":laboratorios_id", $laboratorio_id);
      $db->bindParam(":softwares_id", $software);
      $db->execute();
    }

    return true;
  }

  public function getAll($laboratorio)
  {
    $db = $this->pdo->prepare("SELECT
                                t1.*
                              FROM softwares as t1
                              INNER JOIN laboratorios_softwares as t2 ON(t2.softwares_id = t1.id)
                              INNER JOIN laboratorios as t3 ON(t2.laboratorios_id = t3.id)
                              WHERE t3.id = $laboratorio");
    $db->execute();
    return $db->fetchAll();
  }

  public function addSoftware($dados)
  {
    $db = $this->pdo->prepare("insert into softwares (nome, versao, tipo) values (:nome, :versao, :tipo)");
    $db->bindParam(":nome", $dados['nome']);
    $db->bindParam(":versao", $dados['versao']);
    $db->bindParam(":tipo", $dados['tipo']);
    $db->execute();
    if ($db->rowCount() > 0) {
      return true;
    }
      return false;
  }

}
