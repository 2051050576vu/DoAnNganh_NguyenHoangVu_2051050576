<?php

include 'database.php';
global $link;
if (isset($_GET['maSP'])){
    $idSP = $_GET['maSP'];

    $query = mysqli_query($link,"DELETE FROM sanpham WHERE maSP = $idSP");
    if ($query){
        header('location: adminItem.php');
    }
    else{
        echo "Lỗi";
    }
}

if (isset($_GET['IDTaiKhoan'])){
    $account = $_GET['IDTaiKhoan'];

    $del = mysqli_query($link,"DELETE FROM taikhoan WHERE IDTaiKhoan = $account");
    if ($del){
        header('location: adminUser.php');
    }
    else{
        echo "Lỗi";
    }
}

if (isset($_GET['MaLSP'])){
    $idLSP = $_GET['MaLSP'];

    $del = mysqli_query($link,"DELETE FROM taikhoan WHERE IDTaiKhoan = $idLSP");
    if ($del){
        header('location: adminCategory.php');
    }
    else{
        echo "Lỗi";
    }
}

?>