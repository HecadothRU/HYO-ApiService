<?php
 function octal_converter($type, $string) {
      $data = [];
              switch($_POST['type']) {
                  case 'toOctal':
                      $data['result'] = '';
                      for($i = 0; $i < strlen($string); $i++) {
                          $data['result'] .= decoct(ord($string[$i])) . ' ';
                      }
                      return $data['result'];
                      break;
                  case 'toText':
                      $content = explode(' ', $string);
                      $data['result'] = '';
                      foreach($content as $value) {
                          $data['result'] .= chr(octdec($value));
                      }
                      return $data['result'];
                      break;
              }
          }
          if (isset($_GET['type'])){
            if(isset($_GET['string'])){
              $response = octal_converter($_GET['type'],$_GET['string']);
              die($response);
            }else{
              die("Missing GET Parameter | Set and Retry | [string]");
            }
          }else{
            die("Missing GET Parameter | Set and Retry | [type] ~> [toOctal|toText]");
          }
