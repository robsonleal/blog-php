<?php

namespace RobsonLeal\DesbugandoBlog\Util;

class FormatadorData
{
  public static function fusoHorarioBr($timestamp)
  {
    $datetime = new \DateTime($timestamp, new \DateTimeZone('UTC'));
    $datetime->setTimezone(new \DateTimeZone('America/Sao_Paulo'));

    return $datetime->format('Y-m-d H:i:s');
  }
}
