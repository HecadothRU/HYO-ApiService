<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
// Needed Dependencies || apt install php7.4-mbstring
  function invisible_doubleink_text_generator($response)
  {
      $data = [];
              $table = [
                  '0' => "0҉҉",
                  '1' => "1҉҉",
                  '2' => "2҉҉",
                  '3' => "3҉҉",
                  '4' => "4҉҉",
                  '5' => "5҉҉",
                  '6' => "6҉҉",
                  '7' => "7҉҉",
                  '8' => "8҉҉",
                  '9' => "9҉҉",
                  'a' => "a҉҉",
                  'b' => "b҉҉",
                  'c' => "c҉҉",
                  'd' => "d҉҉",
                  'e' => "e҉҉",
                  'f' => "f҉҉",
                  'g' => "g҉҉",
                  'h' => "h҉҉",
                  'i' => "i҉҉",
                  'j' => "j҉҉",
                  'k' => "k҉҉",
                  'l' => "l҉҉",
                  'm' => "m҉҉",
                  'n' => "n҉҉",
                  'o' => "o҉҉",
                  'p' => "p҉҉",
                  'q' => "q҉҉",
                  'r' => "r҉҉",
                  's' => "s҉҉",
                  't' => "t҉҉",
                  'u' => "u҉҉",
                  'v' => "v҉҉",
                  'w' => "w҉҉",
                  'x' => "x҉҉",
                  'y' => "y҉҉",
                  'z' => "z҉҉",
                  'A' => "A҉҉",
                  'B' => "B҉҉",
                  'C' => "C҉҉",
                  'D' => "D҉҉",
                  'E' => "E҉҉",
                  'F' => "F҉҉",
                  'G' => "G҉҉",
                  'H' => "H҉҉",
                  'I' => "I҉҉",
                  'J' => "J҉҉",
                  'K' => "K҉҉",
                  'L' => "L҉҉",
                  'M' => "M҉҉",
                  'N' => "N҉҉",
                  'O' => "O҉҉",
                  'P' => "P҉҉",
                  'Q' => "Q҉҉",
                  'R' => "R҉҉",
                  'S' => "S҉҉",
                  'T' => "T҉҉",
                  'U' => "U҉҉",
                  'V' => "V҉҉",
                  'W' => "W҉҉",
                  'X' => "X҉҉",
                  'Y' => "Y҉҉",
                  'Z' => "Z҉҉",
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
    $response = invisible_doubleink_text_generator($_GET['string']);
    echo $response['result'];
  } else {
    die("Missing GET Parameter | Set and Retry | [string]");
  }
