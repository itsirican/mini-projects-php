<?php

// user: names
// pw: 9y-PTruni0SVAlKm

try {
    $pdo = new PDO('mysql:host=localhost;dbname=names;charset=utf8mb4', 'names', '9y-PTruni0SVAlKm', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
catch (PDOException $e) {
    // var_dump($e->getMessage());
    echo 'A problem occured with the database connection...';
    die();
}

/*
$stmt = $pdo->prepare('SELECT * FROM `names`');
$stmt->execute();
var_dump($stmt->fetch(PDO::FETCH_ASSOC));
*/