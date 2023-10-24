<?php
session_start();
$id = $_GET['id'];
echo '<pre>';
print_r($_GET);
echo '</pre>';
if($_GET['option'] == 'cart'){
    if ($_GET['type'] == 'add'){
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['SoLuong'] += 1;
            $_SESSION['cart'][$id]['ThanhTien'] = $_SESSION['cart'][$id]['GiaBan'] * $_SESSION['cart'][$id]['SoLuong'];
        }
    } else if($_GET['type'] == 'minus'){
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['SoLuong'] -= 1;
            $_SESSION['cart'][$id]['ThanhTien'] = $_SESSION['cart'][$id]['GiaBan'] * $_SESSION['cart'][$id]['SoLuong'];
        }
    }
    header('location: ../Cart.php');
}
if($_GET['option'] == 'product'){
    if ($_GET['type'] == 'add'){
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['SoLuong'] += 1;
            $_SESSION['cart'][$id]['ThanhTien'] = $_SESSION['cart'][$id]['GiaBan'] * $_SESSION['cart'][$id]['SoLuong'];
        }
    } else if($_GET['type'] == 'minus'){
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['SoLuong'] -= 1;
            $_SESSION['cart'][$id]['ThanhTien'] = $_SESSION['cart'][$id]['GiaBan'] * $_SESSION['cart'][$id]['SoLuong'];
        }
    }
    header('location: ../product.php?maSP='.$id);
}

?>