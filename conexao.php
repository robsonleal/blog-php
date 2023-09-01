<?php
define('HOST', '127.0.0.1');
define('DBNAME', 'desbugando_blog');
define('USER', 'developer');
define('PASSWORD', 'developer');

try {
  $conexao = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASSWORD);
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  exit;
}
