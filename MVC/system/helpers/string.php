<?php

/**
 * convert string to camel form with 2 mode: AbcDef || abcDef
 * @param  [string]  $string input
 * @param  integer $mode   0: abcDef | 1: AbcDef
 * @return [string]
 */
function strCamel($string, $mode = 1)
{
    $string  = preg_replace("/^[^a-zA-Z0-9]*|[^a-zA-Z0-9]*$/", "", $string);
    $string  = preg_replace("/([^a-zA-Z0-9]+)/", " ", $string);
    $segment = explode(" ", $string);
    $count = count($segment);

    if ($count === 1) {
        $string = $mode ? ucfirst($string) : lcfirst($string);
    }

    if ($count > 1) {
        foreach ($segment as $key => $word) {
          $segment[$key] = !$key && !$mode ? strtolower($word) :
          ucfirst(strtolower($word));
      }
      $string = implode("", $segment);
  }
  
  return $string;
}