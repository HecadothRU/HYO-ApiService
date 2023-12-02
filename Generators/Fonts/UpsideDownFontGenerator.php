<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Needed Dependencies || apt install php7.4-mbstring
  function upsidedown_text_generator($response)
  {
      $data = [];

      $table = [
          'A' => "∀",
          'B' => "q",
          'C' => "Ɔ",
          'E' => "Ǝ",
          'F' => "Ⅎ",
          'G' => "פ",
          'H' => "H",
          'I' => "I",
          'J' => "ſ",
          'L' => "˥",
          'M' => "W",
          'N' => "N",
          'P' => "Ԁ",
          'R' => "ᴚ",
          'T' => "⊥",
          'U' => "∩",
          'V' => "Λ",
          'Y' => "⅄",
          'a' => "ɐ",
          'b' => "q",
          'c' => "ɔ",
          'd' => "p",
          'e' => "ǝ",
          'f' => "ɟ",
          'g' => "ƃ",
          'h' => "ɥ",
          'i' => "ᴉ",
          'j' => "ɾ",
          'k' => "ʞ",
          'm' => "ɯ",
          'n' => "u",
          'p' => "d",
          'q' => "b",
          'r' => "ɹ",
          't' => "ʇ",
          'u' => "n",
          'v' => "ʌ",
          'w' => "ʍ",
          'y' => "ʎ",
          '1' => "Ɩ",
          '2' => "ᄅ",
          '3' => "Ɛ",
          '4' => "ㄣ",
          '5' => "ϛ",
          '6' => "9",
          '7' => "ㄥ",
          '8' => "8",
          '9' => "6",
          '0' => "0",
          "." => "˙",
          "," => "'",
          "'" => ",",
          '"' => ",,",
          "`" => ",",
          "<" => ">",
          ">" => "<",
          "∴" => "∵",
          "&" => "⅋",
          "_" => "‾",
          "?" => "¿",
          "¿" => "?",
          "!" => "¡",
          "¡" => "!",
          "[" => "]",
          "]" => "[",
          "(" => ")",
          ")" => "(",
          "{" => "}",
          "}" => "{",
          ";" => "؛",
          "‿" => "⁀",
          "⁅" => "⁆"
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
    $response = upsidedown_text_generator($_GET['string']);
    echo $response['result'];
  } else {
    die("Missing GET Parameter | Set and Retry | [string]");
  }
