<?php
  echo basename(__FILE__)."<br>"; // index.php
  echo basename(__FILE__, ".php")."<br>"; // index
  echo dirname(__FILE__)."<br>"; // C:\xampp\htdocs\irican
  echo dirname(__FILE__, 2)."<br>"; // C:\xampp\htdocs
  echo realpath(__FILE__)."<br>"; // C:\xampp\htdocs\irican\index.php
  echo "<pre>";
  print_r(pathinfo(__FILE__));
  echo "</pre>";
  // Array
  // (
  //     [dirname] => C:\xampp\htdocs\irican
  //     [basename] => index.php
  //     [extension] => php
  //     [filename] => index
  // )
  echo pathinfo(__FILE__)["extension"]."<br>"; // php
  echo pathinfo(__FILE__, PATHINFO_FILENAME)."<br>"; // index