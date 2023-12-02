<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
// Needed Dependencies || apt install php7.4-mbstring
  function fraktur_text_generator($response)
  {
      $data = [];

              $table = [
                  '0' => "օ",
                  '1' => "յ",
                  '2' => "շ",
                  '3' => "Յ",
                  '4' => "կ",
                  '5' => "Տ",
                  '6' => "ճ",
                  '7' => "Դ",
                  '8' => "Ց",
                  '9' => "գ",
                  'a' => "𝔞",
                  'b' => "𝔟",
                  'c' => "𝔠",
                  'd' => "𝔡",
                  'e' => "𝔢",
                  'f' => "𝔣",
                  'g' => "𝔤",
                  'h' => "𝔥",
                  'i' => "𝔦",
                  'j' => "𝔧",
                  'k' => "𝔨",
                  'l' => "𝔩",
                  'm' => "𝔪",
                  'n' => "𝔫",
                  'o' => "𝔬",
                  'p' => "𝔭",
                  'q' => "𝔮",
                  'r' => "𝔯",
                  's' => "𝔰",
                  't' => "𝔱",
                  'u' => "𝔲",
                  'v' => "𝔳",
                  'w' => "𝔴",
                  'x' => "𝔵",
                  'y' => "𝔶",
                  'z' => "𝔷",
                  'A' => "𝔄",
                  'B' => "𝔅",
                  'C' => "ℭ",
                  'D' => "𝔇",
                  'E' => "𝔈",
                  'F' => "𝔉",
                  'G' => "𝔊",
                  'H' => "ℌ",
                  'I' => "ℑ",
                  'J' => "𝔍",
                  'K' => "𝔎",
                  'L' => "𝔏",
                  'M' => "𝔐",
                  'N' => "𝔑",
                  'O' => "𝔒",
                  'P' => "𝔓",
                  'Q' => "𝔔",
                  'R' => "ℜ",
                  'S' => "𝔖",
                  'T' => "𝔗",
                  'U' => "𝔘",
                  'V' => "𝔙",
                  'W' => "𝔚",
                  'X' => "𝔛",
                  'Y' => "𝔜",
                  'Z' => "ℨ",
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
    $response = fraktur_text_generator($_GET['string']);
    echo $response['result'];
  } else {
    die("Missing GET Parameter | Set and Retry | [string]");
  }
