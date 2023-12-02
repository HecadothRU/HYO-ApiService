<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
// Needed Dependencies || apt install php7.4-mbstring
  function cursive_text_generator($response)
  {
      $data = [];

              $table = [
                  '0' => "𝟢",
                  '1' => "𝟣",
                  '2' => "𝟤",
                  '3' => "𝟥",
                  '4' => "𝟦",
                  '5' => "𝟧",
                  '6' => "𝟨",
                  '7' => "𝟩",
                  '8' => "𝟪",
                  '9' => "𝟫",
                  'a' => "𝒶",
                  'b' => "𝒷",
                  'c' => "𝒸",
                  'd' => "𝒹",
                  'e' => "𝑒",
                  'f' => "𝒻",
                  'g' => "𝑔",
                  'h' => "𝒽",
                  'i' => "𝒾",
                  'j' => "𝒿",
                  'k' => "𝓀",
                  'l' => "𝓁",
                  'm' => "𝓂",
                  'n' => "𝓃",
                  'o' => "𝑜",
                  'p' => "𝓅",
                  'q' => "𝓆",
                  'r' => "𝓇",
                  's' => "𝓈",
                  't' => "𝓉",
                  'u' => "𝓊",
                  'v' => "𝓋",
                  'w' => "𝓌",
                  'x' => "𝓍",
                  'y' => "𝓎",
                  'z' => "𝓏",
                  'A' => "𝒜",
                  'B' => "𝐵",
                  'C' => "𝒞",
                  'D' => "𝒟",
                  'E' => "𝐸",
                  'F' => "𝐹",
                  'G' => "𝒢",
                  'H' => "𝐻",
                  'I' => "𝐼",
                  'J' => "𝒥",
                  'K' => "𝒦",
                  'L' => "𝐿",
                  'M' => "𝑀",
                  'N' => "𝒩",
                  'O' => "𝒪",
                  'P' => "𝒫",
                  'Q' => "𝒬",
                  'R' => "𝑅",
                  'S' => "𝒮",
                  'T' => "𝒯",
                  'U' => "𝒰",
                  'V' => "𝒱",
                  'W' => "𝒲",
                  'X' => "𝒳",
                  'Y' => "𝒴",
                  'Z' => "𝒵",
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
    $response = cursive_text_generator($_GET['string']);
    echo $response['result'];
  } else {
    die("Missing GET Parameter | Set and Retry | [string]");
  }
