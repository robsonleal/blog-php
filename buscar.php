<?php
include_once "conexao.php";
session_start();

function buscar_todas_postagens_publicadas($conexao) {

  $resultArray = array();

  $sql = "SELECT
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

  $resultSet = $conexao->query($sql);

  while ($row = $resultSet->fetch()) {

    $row['TXT_TAGS'] = explode(',', $row['TXT_TAGS']);

    array_push($resultArray, $row);
  }

  return $resultArray;
}

$resultArray = buscar_todas_postagens_publicadas($conexao);

$_SESSION['resultArray'] = $resultArray;
header("Location: index.php", true, 301);
exit;
