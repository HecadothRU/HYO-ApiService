<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
// Needed Dependencies || apt install php7.4-mbstring
  function bubble_text_generator($response)
  {
      $data = [];

              $table = [
                  '0' => "⓪",
                  '1' => "①",
                  '2' => "②",
                  '3' => "③",
                  '4' => "④",
                  '5' => "⑤",
                  '6' => "⑥",
                  '7' => "⑦",
                  '8' => "⑧",
                  '9' => "⑨",
                  'a' => "ⓐ",
                  'b' => "ⓑ",
                  'c' => "ⓒ",
                  'd' => "ⓓ",
                  'e' => "ⓔ",
                  'f' => "ⓕ",
                  'g' => "ⓖ",
                  'h' => "ⓗ",
                  'i' => "ⓘ",
                  'j' => "ⓙ",
                  'k' => "ⓚ",
                  'l' => "ⓛ",
                  'm' => "ⓜ",
                  'n' => "ⓝ",
                  'o' => "ⓞ",
                  'p' => "ⓟ",
                  'q' => "ⓠ",
                  'r' => "ⓡ",
                  's' => "ⓢ",
                  't' => "ⓣ",
                  'u' => "ⓤ",
                  'v' => "ⓥ",
                  'w' => "ⓦ",
                  'x' => "ⓧ",
                  'y' => "ⓨ",
                  'z' => "ⓩ",
                  'A' => "Ⓐ",
                  'B' => "Ⓑ",
                  'C' => "Ⓒ",
                  'D' => "Ⓓ",
                  'E' => "Ⓔ",
                  'F' => "Ⓕ",
                  'G' => "Ⓖ",
                  'H' => "Ⓗ",
                  'I' => "Ⓘ",
                  'J' => "Ⓙ",
                  'K' => "Ⓚ",
                  'L' => "Ⓛ",
                  'M' => "Ⓜ",
                  'N' => "Ⓝ",
                  'O' => "Ⓞ",
                  'P' => "Ⓟ",
                  'Q' => "Ⓠ",
                  'R' => "Ⓡ",
                  'S' => "Ⓢ",
                  'T' => "Ⓣ",
                  'U' => "Ⓤ",
                  'V' => "Ⓥ",
                  'W' => "Ⓦ",
                  'X' => "Ⓧ",
                  'Y' => "Ⓨ",
                  'Z' => "Ⓩ",
              ];
              $data['result'] = '';
              for($i = 0; $i < mb_strlen($_GET['string']); $i++) {
                $character = $response[$i];
                  $data['result'] .= array_key_exists($character, $table) ? $table[$character] : $character;
                }
      return array(
        'text' => $_GET['string'] ?? null,
        'result' => $data['result'],
      );
  }
  if (isset($_GET['string'])) {
    $response = bubble_text_generator($_GET['string']);
    echo $response['result'];
  } else {
    die("Missing GET Parameter | Set and Retry | [string]");
  }
