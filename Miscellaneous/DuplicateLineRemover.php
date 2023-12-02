<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
function duplicate_lines_remover($response) {
  $data = [];
  $lines_array = explode("\r\n", $response);
  $new_lines_array = array_unique($lines_array);
  $data['result']['text'] = implode("\r\n", $new_lines_array);
  $data['result']['lines'] = substr_count($response, "\r\n") + 1;
  $data['result']['new_lines'] = count($new_lines_array);
  $data['result']['removed_lines'] = count($lines_array) - count($new_lines_array);

  return array(
    'old' => $data['result']['lines'],
    'new' => $data['result']['new_lines'],
    'removed' => $data['result']['removed_lines'],
  );
}

if (isset($_GET['string'])) {
  $response = duplicate_lines_remover($_GET['string']);
  echo nl2br($response['new']);
} else {
  die("Missing GET Parameter | Set and Retry | [string]");
}
