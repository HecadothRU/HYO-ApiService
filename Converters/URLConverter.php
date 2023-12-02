<?php
 function url_converter($type, $url) {
        $data = [];

            if ($type === "encode") {
              $data['result'] = urlencode($url);
            } elseif ($type === "decode"){
              $data['result'] = urldecode($url);
            }
        return $data['result'];
    }
if (isset($_GET['type'])){
    if (isset($_GET['url'])){
      $response = url_converter($_GET['type'], $_GET['url']);
      switch ($_GET['type']) {
        case "encode":
        die("Encoded URL: ". $response);
        break;
        case "decode":
        die("Decoded URL: ". $response);
        break;
      }
    }
    else {
      die("Missing GET Parameter | Set and Retry | [url]");
    }
} else {
  die("Missing GET Parameter | Set and Retry | [type] ~> [encode/decode]");
}
