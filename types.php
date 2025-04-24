
<pre>
<?php

  if (isset($_GET["price"])) {
    $price = (int)$_GET["price"];
    var_dump($price);
    echo"<br>";
    var_dump($price * M_PI);
  }

  var_dump($_GET);

  if (isset($_GET["name"])) {
    $name = @(string)$_GET["name"];
    var_dump($name . "...");
  }
  ?>
</pre>

<a href="types.php?<?php echo http_build_query(["name" => ["abdel", "naciri"]]) ?>">Link</a>