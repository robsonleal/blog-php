<?php
include_once "conexao.php";
session_start();

function buscar_todas_postagens_publicadas($conexao) {
  $resultArray = array();
  
  $sql = "SELECT TXT_TITULO, TXT_RESUMO, TXT_TAGS, DAT_ALTERACAO
          FROM postagens
          WHERE PAR_ATIVO = 'S'
          ORDER BY DAT_ALTERACAO DESC";

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
