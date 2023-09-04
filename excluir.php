<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'definir_variaveis_ambiente.php';

use RobsonLeal\DesbugandoBlog\Repository\Conectar;

session_start();

if (isset($_SESSION['postagem']) && $_SESSION['postagem'] != "") {
  $postagem = $_SESSION['postagem'];
}

$conexaoObj = new Conectar($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
$conexao = $conexaoObj->conectar();
$alerta = excluir_postagem($conexao, $postagem);

$_SESSION['alerta'] = $alerta;
header("Location: index.php");
exit;

function excluir_postagem($conexao, $postagem) {
  $alerta = "";
  try {
    $sql = "DELETE FROM
              postagens_tags
            WHERE
              OID_POSTAGEM = :id_postagem";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id_postagem', $postagem['OID_POSTAGEM']);
    $stmt->execute();

    $sql = "DELETE FROM
              postagens
            WHERE
              OID_POSTAGEM = :id_postagem";

    $stmt = $conexao->prepare($sql);

    $stmt->bindParam(':id_postagem', $postagem['OID_POSTAGEM']);

    if ($stmt->execute()) {
      $alerta = "Excluido com sucesso!";
      $_SESSION['atualizar'] = true;
      $_SESSION['postagem'] = "";
      $_SESSION['postagens'] = "";
    }
  } catch(PDOException $e) {
    $alerta = "Erro ao excluir o registro: " . $e->getMessage();
  }

  return $alerta;
}