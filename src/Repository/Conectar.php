<?php

namespace RobsonLeal\DesbugandoBlog\Repository;

use RobsonLeal\DesbugandoBlog\Environment\EnvironmentConfig;

class Conectar
{
  private $host;
  private $dbname;
  private $user;
  private $password;

  public function __construct()
  {
    EnvironmentConfig::load();

    $this->host = $_ENV['DB_HOST'];
    $this->dbname = $_ENV['DB_NAME'];
    $this->user = $_ENV['DB_USER'];
    $this->password = $_ENV['DB_PASS'];
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
