<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'definir_variaveis_ambiente.php';

use RobsonLeal\DesbugandoBlog\Repository\Conectar;

session_start();

$conexaoObj = new Conectar();
$conexao = $conexaoObj->conectar();
$postagem = buscar_postagem($conexao);

$_SESSION['postagem'] = $postagem;
// header("Location: editar.php");
header("Location: detalhes.php");
exit;

function buscar_postagem($conexao)
{
  $resultSet = "";

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

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':oid_postagem', $_GET['id']);
    $stmt->execute();
    $resultSet = $stmt->fetch();
  } catch (PDOException $e) {
    $_SESSION['alerta'] = "ERRO ao postar: " . $e->getMessage();
  }

  $resultSet['TXT_TAGS'] = explode(',', $resultSet['TXT_TAGS']);

  return $resultSet;
}

function transformar_data_para_fuso_horario_br($timestamp)
{
  $datetime = new DateTime($timestamp, new DateTimeZone('UTC'));
  $datetime->setTimezone(new DateTimeZone('America/Sao_Paulo'));

  return $datetime->format('Y-m-d H:i:s');
}
