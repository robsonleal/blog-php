<?php

namespace RobsonLeal\DesbugandoBlog\Model;

class Postagem
{
  private $idPostagem;
  private $titulo;
  private $conteudo;
  private $ultimaAlteracao;
  private $ativo;
  private $tags;

  public function __construct($idPostagem, $titulo, $conteudo, $ultimaAlteracao, $ativo, $tags)
  {
    $this->idPostagem = $idPostagem;
    $this->titulo = $titulo;
    $this->conteudo = $conteudo;
    $this->ultimaAlteracao = $ultimaAlteracao;
    $this->ativo = $ativo;
    $this->tags = $tags;
  }

  public function getIdPostagem() {
    return $this->idPostagem;
  }

  public function getTitulo() {
    return $this->titulo;
  }

  public function getConteudo() {
    return $this->conteudo;
  }

  public function getUltimaAlteracao() {
    return $this->ultimaAlteracao;
  }

  public function getAtivo() {
    return $this->ativo;
  }

  public function getTags() {
    return $this->tags;
  }
}
