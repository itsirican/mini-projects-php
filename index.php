<?php
  // echo basename(__FILE__)."<br>"; // index.php
  // echo basename(__FILE__, ".php")."<br>"; // index
  // echo dirname(__FILE__)."<br>"; // C:\xampp\htdocs\irican
  // echo dirname(__FILE__, 2)."<br>"; // C:\xampp\htdocs
  // echo realpath(__FILE__)."<br>"; // C:\xampp\htdocs\irican\index.php
  // echo "<pre>";
  // print_r(pathinfo(__FILE__));
  // echo "</pre>";
  // // Array
  // // (
  // //     [dirname] => C:\xampp\htdocs\irican
  // //     [basename] => index.php
  // //     [extension] => php
  // //     [filename] => index
  // // )
  // echo pathinfo(__FILE__)["extension"]."<br>"; // php
  // echo pathinfo(__FILE__, PATHINFO_FILENAME)."<br>"; // index

  // $date = date_create("2025-24-01 12:00");
  
  // $date = date_create_from_format("d/m/Y H:i", "24-01-2005 12:00");
  // // var_dump($date);
  // // var_dump(date_format($date, "d/m/Y H:i"));
  // if (date_format($date, "d/m/Y H:i") != "24-01-2005 12:00") {
  //   echo "done!";
  // }
  $deadline = "24/01/2005 12:00";
  if ($deadline !== null && date_format(date_create_from_format("d/m/Y H:i", $deadline), 'd/m/Y H:i') != $deadline) {
    echo "error";
  }
