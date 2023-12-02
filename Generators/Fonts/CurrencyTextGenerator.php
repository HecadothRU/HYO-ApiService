<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
// Needed Dependencies || apt install php7.4-mbstring
  function currency_text_generator($response)
  {
      $data = [];

              $table = [
                  '0' => "0",
                  '1' => "1",
                  '2' => "2",
                  '3' => "3",
                  '4' => "4",
                  '5' => "5",
                  '6' => "6",
                  '7' => "7",
                  '8' => "8",
                  '9' => "9",
                  'a' => "₳",
                  'b' => "฿",
                  'c' => "₵",
                  'd' => "Đ",
                  'e' => "Ɇ",
                  'f' => "₣",
                  'g' => "₲",
                  'h' => "Ⱨ",
                  'i' => "ł",
                  'j' => "J",
                  'k' => "₭",
                  'l' => "Ⱡ",
                  'm' => "₥",
                  'n' => "₦",
                  'o' => "Ø",
                  'p' => "₱",
                  'q' => "Q",
                  'r' => "Ɽ",
                  's' => "₴",
                  't' => "₮",
                  'u' => "Ʉ",
                  'v' => "V",
                  'w' => "₩",
                  'x' => "Ӿ",
                  'y' => "Ɏ",
                  'z' => "Ⱬ",
                  'A' => "₳",
                  'B' => "฿",
                  'C' => "₵",
                  'D' => "Đ",
                  'E' => "Ɇ",
                  'F' => "₣",
                  'G' => "₲",
                  'H' => "Ⱨ",
                  'I' => "ł",
                  'J' => "J",
                  'K' => "₭",
                  'L' => "Ⱡ",
                  'M' => "₥",
                  'N' => "₦",
                  'O' => "Ø",
                  'P' => "₱",
                  'Q' => "Q",
                  'R' => "Ɽ",
                  'S' => "₴",
                  'T' => "₮",
                  'U' => "Ʉ",
                  'V' => "V",
                  'W' => "₩",
                  'X' => "Ӿ",
                  'Y' => "Ɏ",
                  'Z' => "Ⱬ",
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
    $response = currency_text_generator($_GET['string']);
    echo $response['result'];
  } else {
    die("Missing GET Parameter | Set and Retry | [string]");
  }
