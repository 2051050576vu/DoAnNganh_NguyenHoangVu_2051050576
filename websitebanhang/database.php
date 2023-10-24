<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "Admin@123";
$db = "quanlybanhangdientu";
global $link;
$link = mysqli_connect($servername, $username, $password, $db);
if(!$link) {
    die('Connect failed!'.mysqli_error($link));
}
mysqli_select_db($link,$db);
?>
