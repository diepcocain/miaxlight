<?php
require "./config/constants.php";

$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'miaxstore';


$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
    echo "Server is error!";
}
