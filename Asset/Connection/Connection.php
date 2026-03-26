<?php
$serverName = getenv('DB_HOST') ?: 'localhost';
$user       = getenv('DB_USER') ?: 'root';
$password   = getenv('DB_PASS') ?: '';
$Database   = getenv('DB_NAME') ?: 'db_rapidmeals';

$con = mysqli_connect($serverName, $user, $password, $Database);

if (!$con) {
    die('Database connection failed: ' . mysqli_connect_error());
}
?>