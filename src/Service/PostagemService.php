<?php

namespace RobsonLeal\DesbugandoBlog\Service;

use RobsonLeal\DesbugandoBlog\Repository\PostagemRepository;

class PostagemService
{
  private $postagemRepository;

  public function __construct()
  {
    $this->postagemRepository = new PostagemRepository();
  }

  public function buscarPostagensAtivas()
  {
    if (!isset($_SESSION['postagens']) || $_SESSION['postagens'] == "" || $_SESSION['atualizar'] === true) {
      $_SESSION['postagens'] = $this->postagemRepository->buscarPostagensAtivas();
      $_SESSION['atualizar'] = false;
    }

    return $_SESSION['postagens'];
  }

  public function buscarPostagem($id)
  {
    return $this->postagemRepository->buscarPostagem($id);
  }

  public function salvarPostagem($postagem)
  {
    $postagem['txt_resumo'] = substr($postagem['txt_texto'], 0, 160);

    if (!$this->validar_campos_postagem($postagem)) {
      //TODO lançar exception;
    }

    return $this->postagemRepository->salvarPostagem($postagem);
  }

  public function deletarPostagem($id)
  {
    return $this->postagemRepository->deletarPostagem($id);
  }

  private function validar_campos_postagem($postagem)
  {
    $alerta = "";

    if (!isset($postagem["txt_titulo"]) || ($postagem["txt_titulo"] == ""))
      $alerta = "Preencha o título";
    elseif (!isset($postagem["par_ativo"]) || ($postagem["par_ativo"] == ""))
      $alerta = "Campo devo publicar não recebido";
    elseif (!isset($postagem["txt_tags"]) || ($postagem["txt_tags"] == ""))
      $alerta = "Selecione pelo menos uma tag";
    elseif (!isset($postagem["txt_texto"]) || ($postagem["txt_texto"] == ""))
      $alerta = "Publicação não pode ser vazia";

    $_SESSION['alerta'] = $alerta;

    return $alerta == "" ? true : false;
  }
}
