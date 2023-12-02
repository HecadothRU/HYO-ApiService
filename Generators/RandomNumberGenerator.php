<?php

  function randomCode($response)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $response; $i++)
    {
      $index = rand(0, strlen($characters) - 1); $randomString .= $characters[$index];
    }
      return $randomString;
    }

    if (isset($_GET['length']))
    {
        $response = randomCode($_GET['length']);
        echo $response;
    }
    else
    {
      die("Missing GET Parameter | Set and Retry | [length(int value)]");
    }
