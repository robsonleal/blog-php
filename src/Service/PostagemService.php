<?php

namespace RobsonLeal\DesbugandoBlog\Service;

use RobsonLeal\DesbugandoBlog\Repository\{PostagemRepository, TagRepository};

class PostagemService
{
  private $postagemRepository;
  private $tagRepository;

  public function __construct()
  {
    $this->postagemRepository = new PostagemRepository();
    $this->tagRepository = new TagRepository();
  }

  public function buscarPostagensAtivas()
  {
    if (!isset($_SESSION['postagens']) || $_SESSION['postagens'] == "" || $_SESSION['atualizar'] === true) {
      $_SESSION['postagens'] = $this->postagemRepository->buscarPostagensAtivas();
      $_SESSION['atualizar'] = false;
    }

    $_SESSION['postagem'] = "";

    return $_SESSION['postagens'];
  }

  public function buscarPostagem($id)
  {
    if (!isset($_SESSION['postagem']) || $_SESSION['postagem'] == "") {
      $_SESSION['postagem'] = $this->postagemRepository->buscarPostagem($id);
    }

    return $_SESSION['postagem'];
  }

  public function editarPostagem($postagem)
  {
    try{
      $this->validarCamposPostagem($postagem);
      $postagem['txt_resumo'] = $this->criarResumo($postagem['TXT_TEXTO']);
      $_SESSION['atualizar'] = true;

      $this->postagemRepository->editarPostagem($postagem);
    } catch(\Exception $e) {
      $_SESSION['alerta'] = $e->getMessage();
    }
  }

  public function salvarPostagem($postagem)
  {
    try {
      $this->validarCamposPostagem($postagem);
      $postagem['txt_resumo'] = $this->criarResumo($postagem['TXT_TEXTO']);
      $_SESSION['atualizar'] = true;

      $this->postagemRepository->salvarPostagem($postagem);
    } catch(\Exception $e) {
      $_SESSION['alerta'] = $e->getMessage();
    }
  }

  public function deletarPostagem($id)
  {
    $_SESSION['atualizar'] = true;
    return $this->postagemRepository->deletarPostagem($id);
  }

  private function criarResumo($string)
  {
    return substr($string, 0, 160);
  }

  private function validarCamposPostagem($postagem)
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

    if($alerta != "") {
      throw new \Exception($alerta);
    }
  }
}
