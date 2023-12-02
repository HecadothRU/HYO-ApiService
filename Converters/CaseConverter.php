<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
function string_filter_alphanumeric($string) {
    $string = preg_replace('/[^a-zA-Z0-9\s]+/', '', $string);
    $string = preg_replace('/\s+/', ' ', $string);
    return $string;
}
  function case_converter($type, $text) {
    $data = [];
    switch($type)
    {
      case 'lowercase':
      return mb_strtolower($text);
      break;
      case 'uppercase':
      return mb_strtoupper($text);
      break;
      case 'sentencecase':
      return ucfirst($text);
      break;
      case 'camelcase':
      $words = explode(' ', $text);
      $pascalcase_words = array_map(function($word)
      {
        return ucfirst($word);
      }, $words);
      $pascalcase = implode($pascalcase_words);
      return lcfirst($pascalcase);
      break;
      case 'pascalcase':
      $words = explode(' ', string_filter_alphanumeric($text));
      $pascalcase_words = array_map(function($word)
      {
        return ucfirst($word);
      }, $words);
      $pascalcase = implode($pascalcase_words);
      return $pascalcase;
      break;
      case 'capitalcase':
      return ucwords($text);
      break;
      case 'constantcase':
      return mb_strtoupper(str_replace(' ', '_', trim(string_filter_alphanumeric($text))));
      break;
      case 'dotcase':
      return mb_strtolower(str_replace(' ', '.', trim(string_filter_alphanumeric($text))));
      break;
      case 'snakecase':
      return mb_strtolower(str_replace(' ', '_', trim(string_filter_alphanumeric($text))));
      break;
      case 'paramcase':
      return mb_strtolower(str_replace(' ', '-', trim(string_filter_alphanumeric($text))));
      break;
      }
      $values = [
        'text' => $text ?? null,
        'type' => $type ?? null,
      ];
    }
    if (isset($_GET['type']))
    {
      if (isset($_GET['text']))
      {
        $response = case_converter($_GET['type'], $_GET['text']);
        die($response);
      } else {
        die("Missing GET Parameter | Set and Retry | [text]");
      }
    } else {
      die("Missing GET Parameter | Set and Retry | [type] ~> [lowercase|uppercase|sentencecase|camelcase|pascalcase|capitalcase|constantcase|dotcase|snakecase|paramcase]");
    }
    /*
    * Types : $_GET ~> type
    * lowercase
    * uppercase
    * sentencecase
    * camelcase
    * pascalcase
    * capitalcase
    * constantcase
    * dotcasee
    * snakecase
    * paramcase
    */
