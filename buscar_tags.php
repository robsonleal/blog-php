<?php
include_once "conexao.php";
session_start();

function buscar_tags($conexao) {

  $resultArray = array();

  $sql = "SELECT
            OID_TAG,
            TXT_NOME
          FROM
            desbugando_blog.tags;";

  $resultSet = $conexao->query($sql);

  while ($row = $resultSet->fetch()) {

    array_push($resultArray, $row);
  }

  return $resultArray;
}

$resultArray = buscar_tags($conexao);

$_SESSION['tags'] = $resultArray;
header("Location: nova_postagem.php", true, 301);
exit;
