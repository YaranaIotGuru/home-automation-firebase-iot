<?php

session_start();

date_default_timezone_set('Asia/Kolkata');

$host = "localhost";
$user = "yout-user-name";
$pass = "your-database-password";
$db = "your-database-name";

$conn = mysqli_connect($host, $user, $pass, $db);

mysqli_set_charset($conn, 'utf8');
$conn->set_charset('utf8mb4');

