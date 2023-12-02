<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
// Needed Dependencies || apt install php7.4-mbstring
  function smallcaps_text_generator($response)
  {
      $data = [];

              $table = [
                  '0' => "𝟶",
                  '1' => "𝟷",
                  '2' => "𝟸",
                  '3' => "𝟹",
                  '4' => "𝟺",
                  '5' => "𝟻",
                  '6' => "𝟼",
                  '7' => "𝟽",
                  '8' => "𝟾",
                  '9' => "𝟿",
                  'a' => "ᴀ",
                  'b' => "ʙ",
                  'c' => "ᴄ",
                  'd' => "ᴅ",
                  'e' => "ᴇ",
                  'f' => "ғ",
                  'g' => "ɢ",
                  'h' => "ʜ",
                  'i' => "ɪ",
                  'j' => "ᴊ",
                  'k' => "ᴋ",
                  'l' => "ʟ",
                  'm' => "ᴍ",
                  'n' => "ɴ",
                  'o' => "ᴏ",
                  'p' => "ᴘ",
                  'q' => "ǫ",
                  'r' => "ʀ",
                  's' => "s",
                  't' => "ᴛ",
                  'u' => "ᴜ",
                  'v' => "ᴠ",
                  'w' => "ᴡ",
                  'x' => "x",
                  'y' => "ʏ",
                  'z' => "ᴢ",
                  'A' => "ᴀ",
                  'B' => "ʙ",
                  'C' => "ᴄ",
                  'D' => "ᴅ",
                  'E' => "ᴇ",
                  'F' => "ғ",
                  'G' => "ɢ",
                  'H' => "ʜ",
                  'I' => "ɪ",
                  'J' => "ᴊ",
                  'K' => "ᴋ",
                  'L' => "ʟ",
                  'M' => "ᴍ",
                  'N' => "ɴ",
                  'O' => "ᴏ",
                  'P' => "ᴘ",
                  'Q' => "ǫ",
                  'R' => "ʀ",
                  'S' => "s",
                  'T' => "ᴛ",
                  'U' => "ᴜ",
                  'V' => "ᴠ",
                  'W' => "ᴡ",
                  'X' => "x",
                  'Y' => "ʏ",
                  'Z' => "ᴢ",
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
    $response = smallcaps_text_generator($_GET['string']);
    echo $response['result'];
  } else {
    die("Missing GET Parameter | Set and Retry | [string]");
  }
