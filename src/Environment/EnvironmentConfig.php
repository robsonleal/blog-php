<?php

namespace RobsonLeal\DesbugandoBlog\Environment;

class EnvironmentConfig
{
  public static function load()
  {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    if (!isset($_ENV['DB_HOST']) || !isset($_ENV['DB_NAME']) || !isset($_ENV['DB_USER']) || !isset($_ENV['DB_PASS'])) {
      die('Variáveis de ambiente não estão definidas.');
    }
  }
}
