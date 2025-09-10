<?php
$host = "localhost";
$user = "root";  // default phpMyAdmin user
$pass = "";      // default no password
$name   = "intern";

$conn = new mysqli($host, $user, $pass, $name);

if ($conn->connect_error) {
    die($conn->connect_error);
}
?>