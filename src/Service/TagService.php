<?php

namespace RobsonLeal\DesbugandoBlog\Service;

use RobsonLeal\DesbugandoBlog\Repository\TagRepository;

class TagService
{
  private $tagsRepository;

  public function __construct()
  {
    $this->tagsRepository = new TagRepository();
  }

  public function buscarTags()
  {
    return $this->tagsRepository->buscarTags();
  }
}
