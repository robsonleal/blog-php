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
    try {
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
    } catch (\PDOException $e) {
      $_SESSION['alerta'] = "ERRO ao buscar postagem: " . $e->getMessage();
      $this->conexao = null;
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

      $_SESSION['alerta'] = "Postagem encontrada!";
    } catch (\PDOException $e) {
      $_SESSION['alerta'] = "ERRO ao buscar postagem: " . $e->getMessage();
      $this->conexao = null;
    }
    $resultSet['TXT_TAGS'] = explode(',', $resultSet['TXT_TAGS']);

    $this->conexao = null;
    return $resultSet;
  }

  public function salvarPostagem($postagem)
  {
    try {
      $sql = "INSERT INTO postagens(
              TXT_TITULO,
              TXT_TEXTO,
              TXT_RESUMO,
              PAR_ATIVO)
            VALUES
              (:titulo, :texto, :resumo, :ativo)";

      $stmt = $this->conexao->prepare($sql);

      $stmt->bindParam(':titulo', $postagem['txt_titulo']);
      $stmt->bindParam(':texto', $postagem['txt_texto']);
      $stmt->bindParam(':resumo', $postagem['txt_resumo']);
      $stmt->bindParam(':ativo', $postagem['par_ativo']);

      if ($stmt->execute()) {
        $postagem['oid_postagem'] = $this->conexao->lastInsertId();
      }

      $sql = "INSERT INTO postagens_tags(
                OID_POSTAGEM,
                OID_TAG)
              VALUES
                (:oid_postagem, :oid_tag)";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':oid_postagem', $postagem['oid_postagem']);

      foreach ($postagem['txt_tags'] as $tag) {
        $stmt->bindParam(':oid_tag', $tag);
        $stmt->execute();
      }

      $_SESSION['alerta'] = "Postado com sucesso!";

      $this->conexao = null;
    } catch (\PDOException $e) {
      $_SESSION['alerta'] = "ERRO ao postar: " . $e->getMessage();
      $this->conexao = null;
    }
  }

  public function editarPostagem($postagem)
  {
    try {
      $sql = "UPDATE postagens
              SET
                TXT_TITULO = :titulo,
                TXT_TEXTO = :texto,
                TXT_RESUMO = :resumo,
                PAR_ATIVO = :ativo
              WHERE
                OID_POSTAGEM = :oid_postagem";

      $stmt = $this->conexao->prepare($sql);

      $stmt->bindParam(':titulo', $postagem['txt_titulo']);
      $stmt->bindParam(':texto', $postagem['txt_texto']);
      $stmt->bindParam(':resumo', $postagem['txt_resumo']);
      $stmt->bindParam(':ativo', $postagem['par_ativo']);
      $stmt->bindParam(':oid_postagem', $postagem['oid_postagem']);

      $stmt->execute();

      $sql = "DELETE FROM postagens_tags WHERE OID_POSTAGEM = :oid_postagem";
      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':oid_postagem', $postagem['oid_postagem']);
      $stmt->execute();

      $sql = "INSERT INTO postagens_tags(
                OID_POSTAGEM,
                OID_TAG)
              VALUES
                (:oid_postagem, :oid_tag)";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':oid_postagem', $postagem['oid_postagem']);

      foreach ($postagem['txt_tags'] as $tag) {
        $stmt->bindParam(':oid_tag', $tag);
        $stmt->execute();
      }

      $_SESSION['alerta'] = "Postagem atualizada com sucesso!";
    } catch (\PDOException $e) {
      $_SESSION['alerta'] = "ERRO ao atualizar: " . $e->getMessage();
    } finally {
      $this->conexao = null;
    }
  }

  public function deletarPostagem($id)
  {
    try {
      $sql = "DELETE FROM
              postagens_tags
            WHERE
              OID_POSTAGEM = :id_postagem";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':id_postagem', $id);
      $stmt->execute();

      $sql = "DELETE FROM
              postagens
            WHERE
              OID_POSTAGEM = :id_postagem";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':id_postagem', $id);
      $stmt->execute();
      $_SESSION['alerta'] = "Excluido com sucesso!";
      $this->conexao = null;
    } catch (\PDOException $e) {
      $_SESSION['alerta'] = "Erro ao excluir o registro: " . $e->getMessage();
      $this->conexao = null;
    }
  }
}
