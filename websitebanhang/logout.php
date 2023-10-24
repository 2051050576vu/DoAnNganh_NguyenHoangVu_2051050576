<?php

include 'database.php';
global $link;
//unset($_SESSION['user']);
session_destroy();
header('location: Home.php');

?>