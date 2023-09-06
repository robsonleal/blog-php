<?php

namespace RobsonLeal\DesbugandoBlog\Util;

class FormatadorData
{
  const MESES_PT_BR = [
    'January' => 'janeiro',
    'February' => 'fevereiro',
    'March' => 'março',
    'April' => 'abril',
    'May' => 'maio',
    'June' => 'junho',
    'July' => 'julho',
    'August' => 'agosto',
    'September' => 'setembro',
    'October' => 'outubro',
    'November' => 'novembro',
    'December' => 'dezembro'
  ];

  public static function formatarDataParaExibicao($data)
  {
    $dataFormatada = $data->format('F \d\e Y');

    foreach (FormatadorData::MESES_PT_BR as $en => $ptbr) {
      $dataFormatada = str_replace($en, $ptbr, $dataFormatada);
    }

    return $dataFormatada;
  }

  public static function fusoHorarioBr($timestamp)
  {
    $datetime = new \DateTime($timestamp, new \DateTimeZone('UTC'));
    $datetime->setTimezone(new \DateTimeZone('America/Sao_Paulo'));

    return $datetime->format('Y-m-d H:i:s');
  }
}
