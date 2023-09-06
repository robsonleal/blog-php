<?php

namespace RobsonLeal\DesbugandoBlog\Controller;

use RobsonLeal\DesbugandoBlog\Service\PostagemService;

class PostagemController
{
  private $postagemService;

  public function __construct()
  {
    $this->postagemService = new PostagemService();
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
    $_SESSION['postagem'] = $this->postagemService->buscarPostagem($id);
    include __DIR__ . '/../Template/detalhes.php';
  }
}
