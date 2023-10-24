<?php

include '../database.php';
global $link;
session_start();
$id = $_GET['id'];
$maLSP = $_GET['MaLSP'];
$price = $_GET['price'];
$name = $_GET['TenSP'];
$pic = $_GET['HinhAnh'];
$sql = "SELECT * FROM `sanpham` WHERE `maSP` = $id";
$res = mysqli_query($link,$sql);

if ($res){
    $product = mysqli_fetch_assoc($res);
}
$item = [
    'id' => $product['maSP'],
    'TenSP' => $product['TenSP'],
    'HinhAnh' => $product['HinhAnh'],
    'GiaBan' => $product['GiaBan'],
    'SoLuong' => 1,
    'ThanhTien' => $product['GiaBan']
];

if (isset($_SESSION['cart'][$id])){
    $item['SoLuong'] +=1;
    $item['ThanhTien'] = $product['GiaBan'] * $item['SoLuong'];
} else{
    $item['SoLuong']	= 1;
    $item['ThanhTien'] = $product['GiaBan'];
}
$_SESSION['cart'][$id] = $item;
if ($_GET['option'] == 'product')
    header('location: ../product.php?maSP='.$id);
else if ($_GET['option'] == 'store')
    header('location: ../store.php');
else if ($_GET['option'] == 'category')
    header('location: ../category.php?id='.$id.'&MaLSP='.$maLSP);
else
    header('location: ../Home.php');

?>
