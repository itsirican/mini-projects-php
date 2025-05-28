<?php

  header('Content-Type: text/plain');

  $what = 'Saturne';

  $print_5x = function() use($what) {
    var_dump("Hello " . $what);
    var_dump("Hello " . $what);
    var_dump("Hello " . $what);
    var_dump("Hello " . $what);
    var_dump("Hello " . $what);
  };

  $print_5x();