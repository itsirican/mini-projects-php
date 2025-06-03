<?php
  header('Content-Type: text/plain');
  // setcookie('str', 'Hello World');
  // var_dump($_COOKIE);
  session_start();

  // $_SESSION['counter'] = 5;

  // session_regenerate_id();

  $_SESSION['counter'] += 1;

  var_dump($_SESSION);