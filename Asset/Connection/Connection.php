<?php
// Use TCP to avoid socket path issues on some systems
$serverName = getenv('DB_HOST') ?: '127.0.0.1';
$user       = getenv('DB_USER') ?: 'root';
$password   = getenv('DB_PASS') ?: '';
$Database   = getenv('DB_NAME') ?: 'db_rapidmeals';

// Ensure we have pure scalars (avoid object from secrets provider wrappers)
if (is_object($serverName) && method_exists($serverName, '__toString')) {
    $serverName = (string) $serverName;
}
if (is_object($user) && method_exists($user, '__toString')) {
    $user = (string) $user;
}
if (is_object($password) && method_exists($password, '__toString')) {
    $password = (string) $password;
}
if (is_object($Database) && method_exists($Database, '__toString')) {
    $Database = (string) $Database;
}

$con = mysqli_connect($serverName, $user, $password, $Database);
if (!$con) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// In CLI / production you might prefer exception style:
// $con = new mysqli($serverName, $user, $password, $Database);
// if ($con->connect_error) {
//     die('Connect Error (' . $con->connect_errno . ') ' . $con->connect_error);
// }
?>