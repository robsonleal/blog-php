<?php
include "conexao.php";
include_once "../model/transacao.php";
session_start();

$sql = "SELECT data_reg, tipo, descricao, categoria, valor FROM transacoes";

$resultSet = $conexao->query($sql);
$resultArray = array();

while ($row = $resultSet->fetch()) {
  $transacao = new Transacao();
  $transacao->setData(new DateTime($row['data_reg']));
  $transacao->setTipo($row['tipo']);
  $transacao->setDescricao($row['descricao']);
  $transacao->setCategoria($row['categoria']);
  $transacao->setValor($row['valor']);

  $resultArray[] = $transacao;
}

$_SESSION['resultArray'] = $resultArray;
header("Location: ../index.php", true, 301);
exit;
