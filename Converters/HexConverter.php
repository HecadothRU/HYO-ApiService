<?php
  function hex_converter($type, $input) {
      // types : toHex | toText
        /* Check for any errors */
        switch($type) {
          case 'toHex':
          return bin2hex($input);
          break;
          case 'toText':
          return hex2bin($input);
          break;
        }
    }
    if (isset($_GET['type']))
    {
      if (isset($_GET['input']))
      {
        $response = hex_converter($_GET['type'], $_GET['input']);
        die($response);
      } else {
        die("Missing GET Parameter | Set and Retry | [input]");
      }
    } else {
      die("Missing GET Parameter | Set and Retry | [type] ~> [toHex|toText]");
    }
