<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'definir_variaveis_ambiente.php';

use RobsonLeal\DesbugandoBlog\Repository\Conectar;

session_start();

$conexaoObj = new Conectar($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
$conexao = $conexaoObj->conectar();
$resultArray = buscar_todas_postagens_publicadas($conexao);

$_SESSION['postagens'] = $resultArray;
header("Location: index.php");

function buscar_todas_postagens_publicadas($conexao)
{

  $resultArray = array();

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

  $resultSet = $conexao->query($sql);

  while ($row = $resultSet->fetch()) {

    $row['TXT_TAGS'] = explode(',', $row['TXT_TAGS']);
    $row['DAT_ALTERACAO'] = transformar_data_para_fuso_horario_br($row['DAT_ALTERACAO']);

    array_push($resultArray, $row);
  }

  $conexao = null;

  return $resultArray;
}

function transformar_data_para_fuso_horario_br($timestamp)
{
  $datetime = new DateTime($timestamp, new DateTimeZone('UTC'));
  $datetime->setTimezone(new DateTimeZone('America/Sao_Paulo'));

  return $datetime->format('Y-m-d H:i:s');
}
