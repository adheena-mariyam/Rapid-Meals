<?php
// Get database credentials from environment variables
$serverName = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');
$port = getenv('DB_PORT');

// If port is set, use it
if ($port) {
    $con = mysqli_connect($serverName, $user, $password, $database, $port);
} else {
    $con = mysqli_connect($serverName, $user, $password, $database);
}

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
