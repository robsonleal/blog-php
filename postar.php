<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'definir_variaveis_ambiente.php';

use RobsonLeal\DesbugandoBlog\Repository\Conectar;

session_start();

$postagem = $_POST;
$conexaoObj = new Conectar($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
$conexao = $conexaoObj->conectar();
$alerta = validar_campos_postagem($postagem);
$postagem['txt_resumo'] = substr($postagem['txt_texto'], 0, 160);

if ($alerta == "") {
  $alerta = postar($conexao, $postagem);
}

$_SESSION['alerta'] = $alerta;
header("Location: index.php");
exit;

function postar($conexao, $postagem) {
  $alerta = "";

  try {
    $sql = "INSERT INTO postagens(
              TXT_TITULO,
              TXT_TEXTO,
              TXT_RESUMO,
              PAR_ATIVO)
            VALUES
              (:titulo, :texto, :resumo, :ativo)";

    $stmt = $conexao->prepare($sql);

    $stmt->bindParam(':titulo', $postagem['txt_titulo']);
    $stmt->bindParam(':texto', $postagem['txt_texto']);
    $stmt->bindParam(':resumo', $postagem['txt_resumo']);
    $stmt->bindParam(':ativo', $postagem['par_ativo']);

    // Não tem alerta quanto falha?? Analisar ...
    if ($stmt->execute()) {
      $postagem['oid_postagem'] = $conexao->lastInsertId();
    }

    $sql = "INSERT INTO postagens_tags(
              OID_POSTAGEM,
              OID_TAG)
            VALUES
              (:oid_postagem, :oid_tag)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':oid_postagem', $postagem['oid_postagem']);
    
    foreach ($postagem['txt_tags'] as $tag) {
      $stmt->bindParam(':oid_tag', $tag);
      $stmt->execute();
    }

    $alerta = "Postado com sucesso!";
  } catch (PDOException $e) {
    $alerta = "ERRO ao postar: " . $e->getMessage();
  }

  $_SESSION['atualizar'] = true;
  return $alerta;
}

function validar_campos_postagem($postagem) {
  $alerta = "";

  if (!isset($postagem["txt_titulo"]) || ($postagem["txt_titulo"] == ""))
    $alerta = "Preencha o título";
  elseif (!isset($postagem["par_ativo"]) || ($postagem["par_ativo"] == ""))
    $alerta = "Campo devo publicar não recebido";
  elseif (!isset($postagem["txt_tags"]) || ($postagem["txt_tags"] == ""))
    $alerta = "Selecione pelo menos uma tag";
  elseif (!isset($postagem["txt_texto"]) || ($postagem["txt_texto"] == ""))
    $alerta = "Publicação não pode ser vazia";

  return $alerta;
}
