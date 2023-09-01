<?php
include_once "conexao.php";
session_start();

function buscar_todas_postagens($conexao) {
  $resultArray = array();
  
  $sql = "SELECT OID_POSTAGEM, TXT_TITULO, TXT_TEXTO, TXT_RESUMO, TXT_TAGS, PAR_ATIVO, DAT_CRIACAO, DAT_ALTERACAO
          FROM postagens";

  $resultSet = $conexao->query($sql);

  while ($row = $resultSet->fetch()) {
    
    array_push($resultArray, $row);
  }

  return $resultArray;
}

$resultArray = buscar_todas_postagens($conexao);

$_SESSION['resultArray'] = $resultArray;
header("Location: index.php", true, 301);
exit;
