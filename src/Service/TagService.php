<?php

namespace RobsonLeal\DesbugandoBlog\Service;

use RobsonLeal\DesbugandoBlog\Repository\TagRepository;

class TagService
{
  private $tagRepository;

  public function __construct()
  {
    $this->tagRepository = new TagRepository();
  }

  public function buscarTags()
  {
    if (!isset($_SESSION['tags']) || $_SESSION['tags'] == "") {
      $_SESSION['tags'] = $this->tagRepository->buscarTags();
    }

    return $_SESSION['tags'];
  }
}
