<?php

namespace RobsonLeal\DesbugandoBlog\Repository;

class Conectar
{
  private $host;
  private $dbname;
  private $user;
  private $password;

  public function __construct($host, $dbname, $user, $password)
  {
    $this->host = $host;
    $this->dbname = $dbname;
    $this->user = $user;
    $this->password = $password;
  }

  public function conectar()
  {
    try {
      $conexao = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->password);
      $conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      return $conexao;
    } catch (\PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      exit;
    }
  }
}
