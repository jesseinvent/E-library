<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'eLibrary');

$link="http://localhost/ebook/";


try {
    //code...
    $dsn = "mysql:dbname=".DATABASE."; host=".HOST."";
    $db_con = new PDO($dsn, USER, PASSWORD);
    $db_con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    //throw $th;
    echo $e->getMessage();
}