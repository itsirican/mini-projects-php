<?php

  header('Content-Type: text/plain');

  $fp = fsockopen("ssl://downloads.codingcoursestv.eu", 443, $errno, $errstr, 30);
  if (!$fp) {
    echo "ERROR: $errno - $errstr <br />\n";
  } else {
    $out = "GET /056%20-%20php/weather/weather.php HTTP/1.1\r\n";
    $out .= "Host: downloads.codingcoursestv.eu\r\n";
    $out .= "Connection: Close\r\n\r\n";
    fwrite($fp, $out);
    $response = [];
    while (!feof($fp)) {
      $response[] = fgets($fp, 128);
    }
    fclose($fp);
    $responseStr = implode($response);
    // echo $responseStr;
    $splittedResponse = explode("\r\n\r\n", $responseStr);
    var_dump($splittedResponse[1]);
    // var_dump(json_decode($splittedResponse[1], true));
    
  }