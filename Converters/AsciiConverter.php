<?php
 function ascii_converter($type, $string) {
     $data = [];
         // Types toAscii | toText
             switch($type) {
                 case 'toAscii':
                     $data['result'] = '';
                     for($i = 0; $i < strlen($string); $i++) {
                         $data['result'] .= ord($string[$i]) . ' ';
                     }
                     return $data['result'];
                     break;
                 case 'toText':
                     $content = explode(' ', $string);
                     $data['result'] = '';
                     foreach($content as $value) {
                         $data['result'] .= chr($value);
                     }
                     return $data['result'];
                     break;
             }
         }
         if (isset($_GET['type']))
         {
           if (isset($_GET['string'])){
             $response = ascii_converter($_GET['type'], $_GET['string']);
             die($response);
           } else {
             die("Missing GET Parameter | Set and Retry | [string]");
           }
         } else {
           die("Missing GET Parameter | Set and Retry | [type] ~> [toAscii|toText]");
         }
