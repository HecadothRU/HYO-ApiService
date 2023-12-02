<?php

if(isset($_GET['action'])) {
  switch($_GET['action']) {
    case 'encode':
      if(isset($_GET['text'])) {
        $encoded_text = base64_encode($_GET['text']);
        echo json_encode(['encoded_text' => $encoded_text]);
      } else {
        echo json_encode(['error' => 'No text provided']);
      }
      break;
    case 'decode':
      if(isset($_GET['text'])) {
        $decoded_text = base64_decode($_GET['text']);
        echo json_encode(['decoded_text' => $decoded_text]);
      } else {
        echo json_encode(['error' => 'No text provided']);
      }
      break;
    default:
      echo json_encode(['error' => 'Invalid action']);
      break;
  }
} else {
  echo json_encode(['error' => 'No action provided']);
}
