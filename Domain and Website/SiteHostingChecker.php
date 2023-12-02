<?php
 function website_hosting_checker($host) {
   $host_ip = gethostbyname($host);
   $call = file_get_contents('http://ip-api.com/json/'.$host_ip);
   return $call;
  }
  if (isset($_GET['host']))
  {
    $response = website_hosting_checker($_GET['host']);
      if ($response != null) {
        die($response);
      } else {
        die("Error: Function Call Returned NULL | No Data To Display!");
      }
  } else {
    die("Missing GET Parameter: | Set and Try Again | [host]");
  }
