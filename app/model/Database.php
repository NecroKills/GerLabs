<?php


class Database {

    private $username = "root";
    private $password = "";
    private $conexao;

    function __construct() {
        try {
            $conn = new PDO('mysql:host=localhost;dbname=gerlabs', $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
            $this->conexao = $conn;
        } catch (PDOException $e) {
            echo 'ERRO AO CONECTAR: ' . $e->getMessage();
        }
    }

    public function getConexao() {
        return $this->conexao;
    }

}
