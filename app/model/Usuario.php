<?php
require_once("Database.php");

class Usuario {

  private $pdo;

  public function __construct()
  {
      $this->pdo = new Database();
      $this->pdo = $this->pdo->getConexao();
  }

  public function verificaLogin($login)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    if($stmt->rowCount() > 0) {
      return true;
    }
      return false;
  }

  public function inserir($dados)
  {
    $stmt = $this->pdo->prepare("insert into usuarios (nome, login, senha, email) values (:nome, :login, :senha, :email)");
    $stmt->bindParam(':nome', $dados['nomeSolicitante']);
    $stmt->bindParam(':login', $dados['login']);
    $stmt->bindParam(':senha', $dados['password']);
    $stmt->bindParam(':email', $dados['email']);
    $stmt->execute();
    if($stmt->rowCount() > 0) {
      return true;
    }
      return false;
  }

  public function logar($usuario, $password)
  {
    $sql = "SELECT * FROM usuarios WHERE login = :usuario AND senha = MD5(:senha)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $password, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  #verifica se o usuario é ativo
  public function verificaAtivo($usuario)
  {
    $sql = "SELECT * FROM usuarios WHERE login = :usuario AND situacao = 1";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  #busca todos os usuarios cadastrados
  public function getAll()
  {
    $stmt = $this->pdo->prepare("SELECT * FROM usuarios");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  #busca usuario especifico para editar
  public function buscar($id)
  {
    $stmt = $this->pdo->prepare("SELECT id, nome, email, situacao, nivel FROM usuarios Where id = $id");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

    #busca usuario especifico
    public function listarUsuario($id)
    {
      $conn = new Database();
      $resultado = $conn->getConexao()->query("SELECT * FROM usuarios as u WHERE u.id = '.$id.'")->fetch();
    }

    public function excluir($id)
    {
      $stmt = $this->pdo->prepare("DELETE FROM usuarios where id = $id");
      return $stmt->execute();
    }
    public function atualizar($id, $nome, $email, $situacao, $nivel)
    {
      $stmt = $this->pdo->prepare('UPDATE usuarios SET nome = :nome, email = :email, situacao = :situacao, nivel = :nivel WHERE id = :id');
      $stmt->execute(array(
      ':id'   => $id,
      ':nome' => $nome,
      ':email' => $email,
      ':situacao' => $situacao,
      ':nivel' => $nivel
      ));
      return $stmt->rowCount();
    }
}
