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
    return $this->postagemRepository->buscarPostagensAtivas();
  }

  public function buscarPostagem($id)
  {
    return $this->postagemRepository->buscarPostagem($id);
  }
}
