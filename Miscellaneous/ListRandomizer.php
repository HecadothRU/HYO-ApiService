<?php
 function list_randomizer($text) {
   $data = [];
   $result = array_filter(explode("\r\n", $text));
   array_map('input_clean', $result);
   shuffle($result);
   $data['result'] = implode("\r\n", $result);
  }
if (isset($_GET['text'])) {
  $response = list_randomizer($_GET['text']);
  die($response);
} else {
  die("Missing GET Parameter: | Set and Try Again | [text]");
}
