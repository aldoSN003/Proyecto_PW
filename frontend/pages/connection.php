<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "Damaldo0203#";
$db_name = "pweb_db";

try {
    $db = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "GOOD BOYsdddddddddddd";
} catch (PDOException $e) {
    echo $e->getMessage();
}
