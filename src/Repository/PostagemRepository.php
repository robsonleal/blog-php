<?php

namespace RobsonLeal\DesbugandoBlog\Repository;

use RobsonLeal\DesbugandoBlog\Util\FormatadorData;

class PostagemRepository
{
  private $conexao;

  public function __construct()
  {
    $conectar = new Conectar();
    $this->conexao = $conectar->conectar();
  }

  public function buscarPostagensAtivas()
  {
    $sql = "SELECT
            p.OID_POSTAGEM,
            p.TXT_TITULO,
            p.TXT_RESUMO,
            p.DAT_ALTERACAO,
            GROUP_CONCAT(t.TXT_NOME ORDER BY t.TXT_NOME ASC) AS TXT_TAGS
          FROM
            desbugando_blog.postagens p
          LEFT JOIN desbugando_blog.postagens_tags pt ON
            p.OID_POSTAGEM = pt.OID_POSTAGEM
          LEFT JOIN desbugando_blog.tags t ON
            pt.OID_TAG = t.OID_TAG
          GROUP BY
            p.OID_POSTAGEM,
            p.TXT_TITULO
          ORDER BY
            p.DAT_ALTERACAO DESC;";

    $resultArray = [];
    $resultSet = $this->conexao->query($sql);

    while ($row = $resultSet->fetch()) {

      $row['TXT_TAGS'] = explode(',', $row['TXT_TAGS'] ?? '');
      $row['DAT_ALTERACAO'] = FormatadorData::fusoHorarioBr($row['DAT_ALTERACAO']);

      array_push($resultArray, $row);
    }

    $this->conexao = null;

    return $resultArray;
  }

  public function buscarPostagem($id)
  {
    try {
      $sql = "SELECT
              p.OID_POSTAGEM,
              p.TXT_TITULO,
              p.TXT_TEXTO,
              p.DAT_ALTERACAO,
              p.PAR_ATIVO,
              GROUP_CONCAT(t.TXT_NOME ORDER BY t.TXT_NOME ASC) AS TXT_TAGS
            FROM
              desbugando_blog.postagens p
            LEFT JOIN desbugando_blog.postagens_tags pt ON
              p.OID_POSTAGEM = pt.OID_POSTAGEM
            LEFT JOIN desbugando_blog.tags t ON
              pt.OID_TAG = t.OID_TAG
            WHERE
              p.OID_POSTAGEM = :oid_postagem
            GROUP BY
              p.OID_POSTAGEM,
              p.TXT_TITULO
            ORDER BY
              p.DAT_ALTERACAO DESC;";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':oid_postagem', $id);
      $stmt->execute();

      $resultSet = "";
      $resultSet = $stmt->fetch();
    } catch (\PDOException $e) {
      $_SESSION['alerta'] = "ERRO ao buscar postagem: " . $e->getMessage();
    }

    $resultSet['TXT_TAGS'] = explode(',', $resultSet['TXT_TAGS']);

    return $resultSet;
  }
}
