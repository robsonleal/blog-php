<?php

namespace RobsonLeal\DesbugandoBlog\Repository;

class TagRepository
{
  private $conexao;

  public function __construct()
  {
    $conectar = new Conectar();
    $this->conexao = $conectar->conectar();
  }

  public function buscarTags()
  {
    $sql = "SELECT
            OID_TAG,
            TXT_NOME
          FROM
            desbugando_blog.tags;";

    $resultSet = $this->conexao->query($sql);

    $resultArray = [];

    while ($row = $resultSet->fetch()) {

      array_push($resultArray, $row);
    }

    $this->conexao = null;

    return $resultArray;
  }
}
