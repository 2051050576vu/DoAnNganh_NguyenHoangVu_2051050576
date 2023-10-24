<?php
session_start();
$id = $_GET['id'];
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
unset($cart[$id]);
$_SESSION['cart'] = $cart;
if ($_GET['option'] == 'store')
    header('location: ../store.php');
else
    header('location:../Cart.php');
?>