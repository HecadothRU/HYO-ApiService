<?php
 function slug_generator($str) {
   $data = [];
   mb_internal_encoding('utf-8');
   /* Replace all non words characters with the specified $delimiter */
   $string = preg_replace('/[^\p{L}\d-]+/u', '-', $str);
   /* Check for double $delimiters and remove them so it only will be 1 delimiter */
   $string = preg_replace('/-+/u', '-', $string);
   /* Remove the $delimiter character from the start and the end of the string */
   $string = trim($string, '-');
   /* lowercase */
   $string = mb_strtolower($string);
   $data['result'] = $string;
   return $data['result'];
 }
 if (isset($_GET['string']))
 {
     $response = slug_generator($_GET['string']);
     die($response);
 } else {
   die("Missing GET Parameter | Set and Retry | [string]");
}
