<?php

  // use Admin\User as Admin;
  use Client\User as Client;

  require __DIR__."/autoload.php";

  // require __DIR__."/src/Admin/Role.php";
  // require __DIR__."/src/Admin/User.php";
  // require __DIR__."/src/Client/User.php";

  // function autoload($class) {
  //   var_dump($class);
  //   if ($class == "Admin\User") {
  //     require __DIR__."/src/Admin/User.php";
  //     return;
  //   }
  //   if ($class == "Admin\Role") {
  //     require __DIR__."/src/Admin/Role.php";
  //     return;
  //   }
  //   if ($class == "Client\User") {
  //     require __DIR__."/src/Client/User.php";
  //     return;
  //   }
  // }

  // function autoload($class) {
  //   $path = __DIR__."/src/".str_replace('\\', '/', $class).".php";
  //   // var_dump($path);
  //   if (file_exists($path)) {
  //     require $path;
  //   }
  // }

  // spl_autoload_register('autoload');

  // $admin = new Admin();
  $admin = new App\Admin\User();
  var_dump($admin);

  // $client = new Client();
  // var_dump($client);