<?php

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function render($view, $params) {
    extract($params);

    ob_start();
    require __DIR__."/../views/pages/".$view.".php";
    $content = ob_get_clean();

    require __DIR__."/../views/layouts/main.view.php";
}

function gen_alphabet() {
    $A = ord('A');
    $Z = ord('Z');

    $letters = [];
    for ($x = $A; $x <= $Z; $x++) {
        $letters[] = chr($x);
    }
    return $letters;
}
