<?php
$localhost = "127.0.0.1";
$username = "root";
$password = "";
$database = "system_db";

$conn = new mysqli($localhost, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}