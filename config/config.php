<?php

define('DBHOST', 'localhost');

define('DBNAME', 'coffee-blend');

define('DBUSER', 'root');

define('DBPASS', '');


try {
    $conn = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'connected ...';
} catch (Exception $e) {
    echo 'connection failed:' . $e->getMessage();
}
