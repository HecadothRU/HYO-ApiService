<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
 function character_counter($response) {
        $data = [];
        $data['result']['characters'] = mb_strlen($response);
        $data['result']['words'] = str_word_count($response);
        $data['result']['lines'] = substr_count($response, "\r\n") + 1;;
        return array(
          'characters' => $data['result']['characters'],
          'words' => $data['result']['words'],
          'lines' => $data['result']['lines'],
        );
    }
    if (isset($_GET['string'])) {
      $response = character_counter($_GET['string']);
      echo nl2br("Characters: ". $response['characters'] ."\nWords: ".$response['words']."\nLines: ".$response['lines']."");
    } else {
      die("Missing GET Parameter | Set and Retry | [string]");
    }
