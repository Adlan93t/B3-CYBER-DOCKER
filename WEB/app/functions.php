<?php

session_start();

function dd($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
}

function connectDB () {
    $dsn = 'mysql:dbname=b3cyber;host=mysql';
    $user = 'root';
    $password = '';

    $link = new PDO($dsn, $user, $password);

    return $link;
}