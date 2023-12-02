<?php
if (isset($_GET['string']))
{
  $array = explode(' ', $_GET['string']);
  die(implode(' ', array_reverse($array)));
} else {
  die("Missing GET Parameters | Set and Retry | [string]");
}
