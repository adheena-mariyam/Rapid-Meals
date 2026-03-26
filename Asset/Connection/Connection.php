<?php
// Debug: Print environment variables
echo "DB_HOST: " . getenv('DB_HOST') . "<br>";
echo "DB_USER: " . getenv('DB_USER') . "<br>";
echo "DB_NAME: " . getenv('DB_NAME') . "<br>";
echo "DB_PORT: " . getenv('DB_PORT') . "<br>";

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
