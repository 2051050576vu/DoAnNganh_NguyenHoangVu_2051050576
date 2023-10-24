<?php
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
session_start();
$hoadon = 'SELECT max(MaHD) as hoadon FROM hoadon';
$query = mysqli_query($link,$hoadon);
$row = mysqli_fetch_row($query);
print_r($row);
$total = 0;
foreach ($_SESSION['cart'] as $key => $value){
    $maSP = $value['id'];
    $maHD = $row[0] + 1;
    $quantity = $value['SoLuong'];
    $tong = $value['ThanhTien'];
    $total += $tong;
    $item = "INSERT INTO quanlybanhangdientu.chitiethoadon(maSP, MaHD, SoLuong, TongTien) VALUES ($maSP, $maHD,$quantity, $tong)";
    mysqli_query($link,$item);
}
$date =  date('Y-m-d H:i:s', time());
$user = $_SESSION['user']['IDTaiKhoan'];
$sql = "INSERT INTO quanlybanhangdientu.hoadon(NgayTao, IDTaiKhoan, TongHD) VALUES ('$date', $user, $total)";
mysqli_query($link, $sql);
unset($_SESSION['cart']);
header('location: ../Cart.php?option=message');



?>