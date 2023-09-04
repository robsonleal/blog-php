<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once "conexao.php";
session_start();

if (isset($_SESSION['postagem']) && $_SESSION['postagem'] != "") {
  $postagem = $_SESSION['postagem'];
}

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