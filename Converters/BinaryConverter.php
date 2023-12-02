<?php
  function string_to_binary($string) {
    $characters = str_split($string);
    $binary = [];
    foreach ($characters as $character) {
      $data = unpack('H*', $character);
      $binary[] = base_convert($data[1], 16, 2);
    }
    return implode(' ', $binary);
  }
  function binary_to_string($binary) {
    $binaries = explode(' ', $binary);
    $string = null;
    foreach ($binaries as $binary) {
      $string .= pack('H*', dechex(bindec($binary)));
    }
    return $string;
  }
 function binary_converter($type, $string) {
   switch($type) {
     case 'toBinary':
     return string_to_binary($string);
     break;
     case 'toText':
     return binary_to_string($string);
     break;
   }
  }
if (isset($_GET['type']))
{
  if (isset($_GET['string']))
  {
    $response = binary_converter($_GET['type'], $_GET['string']);
    die($response);
  } else {
    die("Missing GET Parameters | Set and Retry | [string]");
  }
} else {
  die("Missing GET Parameters | Set and Retry | [type] ~> [toBinary|toText]");
}
