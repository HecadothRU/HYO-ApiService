<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
// Needed Dependencies || apt install php7.4-mbstring
  function double_stuck_text_generator($response)
  {
      $data = [];

              $table = [
                  '0' => "𝟘",
                  '1' => "𝟙",
                  '2' => "𝟚",
                  '3' => "𝟛",
                  '4' => "𝟜",
                  '5' => "𝟝",
                  '6' => "𝟞",
                  '7' => "𝟟",
                  '8' => "𝟠",
                  '9' => "𝟡",
                  'a' => "𝕒",
                  'b' => "𝕓",
                  'c' => "𝕔",
                  'd' => "𝕕",
                  'e' => "𝕖",
                  'f' => "𝕗",
                  'g' => "𝕘",
                  'h' => "𝕙",
                  'i' => "𝕚",
                  'j' => "𝕛",
                  'k' => "𝕜",
                  'l' => "𝕝",
                  'm' => "𝕞",
                  'n' => "𝕟",
                  'o' => "𝕠",
                  'p' => "𝕡",
                  'q' => "𝕢",
                  'r' => "𝕣",
                  's' => "𝕤",
                  't' => "𝕥",
                  'u' => "𝕦",
                  'v' => "𝕧",
                  'w' => "𝕨",
                  'x' => "𝕩",
                  'y' => "𝕪",
                  'z' => "𝕫",
                  'A' => "𝔸",
                  'B' => "𝔹",
                  'C' => "ℂ",
                  'D' => "𝔻",
                  'E' => "𝔼",
                  'F' => "𝔽",
                  'G' => "𝔾",
                  'H' => "ℍ",
                  'I' => "𝕀",
                  'J' => "𝕁",
                  'K' => "𝕂",
                  'L' => "𝕃",
                  'M' => "𝕄",
                  'N' => "ℕ",
                  'O' => "𝕆",
                  'P' => "ℙ",
                  'Q' => "ℚ",
                  'R' => "ℝ",
                  'S' => "𝕊",
                  'T' => "𝕋",
                  'U' => "𝕌",
                  'V' => "𝕍",
                  'W' => "𝕎",
                  'X' => "𝕏",
                  'Y' => "𝕐",
                  'Z' => "ℤ",
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
    $response = double_stuck_text_generator($_GET['string']);
    echo $response['result'];
  } else {
    die("Missing GET Parameter | Set and Retry | [string]");
  }
