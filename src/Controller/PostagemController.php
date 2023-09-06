<?php

namespace RobsonLeal\DesbugandoBlog\Controller;

use RobsonLeal\DesbugandoBlog\Service\{PostagemService, TagService};

class PostagemController
{
  private $postagemService;
  private $tagService;

  public function __construct()
  {
    $this->postagemService = new PostagemService();
    $this->tagService = new TagService();
  }

  public function index()
  {
    $currentPage = "postagens";
    $postagens = $this->postagemService->buscarPostagensAtivas();
    include __DIR__ . '/../Template/postagens.php';
  }

  public function show($id)
  {
    $currentPage = "detalhes";
    $postagem = $this->postagemService->buscarPostagem($id);
    include __DIR__ . '/../Template/detalhes.php';
  }

  public function edit($id)
  {
    $currentPage = "editar";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $_SESSION['post'] = $_POST;
      $this->postagemService->editarPostagem($_POST);
      echo var_dump($_POST);
      header("Location: /");
    }
    $postagem = $this->postagemService->buscarPostagem($id);
    $tags = $this->tagService->buscarTags();
    include __DIR__ . '/../Template/editar.php';
  }

  public function save()
  {
    $currentPage = "nova_postagem";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postagemService->salvarPostagem($_POST);
      header("Location: /");
    }
    $tags = $this->tagService->buscarTags();
    include __DIR__ . '/../Template/criar.php';
  }

  public function delete($id)
  {
    $this->postagemService->deletarPostagem($id);

    header("Location: /");
  }
}
