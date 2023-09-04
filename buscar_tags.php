<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'definir_variaveis_ambiente.php';

use RobsonLeal\DesbugandoBlog\Repository\Conectar;

session_start();

$conexaoObj = new Conectar($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
$conexao = $conexaoObj->conectar();

function buscar_tags($conexao)
{

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
