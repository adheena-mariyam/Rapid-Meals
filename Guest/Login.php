<?php
$serverName = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');
$port = getenv('DB_PORT');

if ($port) {
    $con = mysqli_connect($serverName, $user, $password, $database, $port);
} else {
    $con = mysqli_connect($serverName, $user, $password, $database);
}

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
