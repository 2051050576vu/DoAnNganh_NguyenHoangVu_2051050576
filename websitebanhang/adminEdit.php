<?php

include 'database.php';
global $link;
$item = mysqli_query($link,"SELECT * FROM sanpham");

if (isset($_GET['maSP'])){
    $idSP = $_GET['maSP'];
    $data = mysqli_query($link, "SELECT * FROM sanpham WHERE maSP = $idSP");
    $cate = mysqli_fetch_assoc($data);

}

if (isset($_POST['TenSP'])){

    $name = $_POST['TenSP'];
    $quantity = $_POST['SoLuong'];
    $buy = $_POST['GiaNhap'];
    $sell = $_POST['GiaBan'];
    $idLSP = $_POST['MaLSP'];
    $idNCC = $_POST['MaNCC'];
    $pic =$_POST['HinhAnh'];

    $sql = "UPDATE sanpham SET TenSP = '$name', SoLuong='$quantity', GiaNhap='$buy', GiaBan='$sell', MaLSP='$idLSP', MaNCC='$idNCC', HinhAnh = '$pic' WHERE maSP = $idSP ";
    $query = mysqli_query($link,$sql);
    if ($query){
        header('location: adminItem.php');
    }
    else{
        echo "Lỗi";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/login.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="header">
        <div class="nav-header">
            <ul class="nav-bar">
                <li><a href="adminItem.php">Quản lí sản phẩm</a></li>
                <li><a href="adminCategory.php">Quản lí loại sản phẩm</a></li>
                <li><a href="adminUser.php">Quản lí tài khoản</a></li>
<!--                <li><a href="">Hóa đơn</a></li>-->
                <li><a href="Home.php">Home</a></li>
                <?php if (isset($user['HoTen'])) { ?>
                    <li class="nav-dropdown">
                        <a href="login.php"><i class="fa fa-user-o"></i><?php echo $user['HoTen'] ?> </a>
                        <ul>

                            <li><a href="logout.php">Đăng xuất</a></li>
                        </ul>
                    </li>
                <?php } else{ ?>
                    <li class="nav-dropdown">
                        <p>Tài khoản </p>
                        <ul>
                            <li><a href="login.php">Đăng nhập</a></li>
                            <li><a href="signup.php">Đăng kí</a></li>

                        </ul>
                    </li>
                <?php }?>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="col-md-6">
            <div class="panel-info-1">
                <div class="panel-heading">
                    <h3>Sửa sản phẩm</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="Tên sản phẩm" name="TenSP" value="<?php echo $cate['TenSP'] ?>">
                            <label for="">Tên sản phẩm</label>
                        </div>
                        <div class="form-group">
                            <input type="number" placeholder="Số lượng" name="SoLuong" value="<?php echo $cate['SoLuong'] ?>">
                            <label for="">Số lượng</label>
                        </div>
                        <div class="form-group">
                            <input type="number" placeholder="Giá nhập" name="GiaNhap" value="<?php echo $cate['GiaNhap'] ?>">
                            <label for="">Giá nhập</label>
                        </div>
                        <div class="form-group">
                            <input type="number" placeholder="Giá bán" name="GiaBan" value="<?php echo $cate['GiaBan'] ?>">
                            <label for="">Giá bán</label>
                        </div>
                        <div class="form-group">
                            <input type="number" placeholder="Mã loại sản phẩm" name="MaLSP" value="<?php echo $cate['MaLSP'] ?>">
                            <label for="">Mã loại sản phẩm</label>
                         </div>
                         <div class="form-group">
                            <input type="number" placeholder="Mã nhà cung cấp" name="MaNCC" value="<?php echo $cate['MaNCC'] ?>">
                            <label for="">Mã nhà cung cấp</label>
                         </div>
                        <div class="form-group">
                            <input type="text" placeholder="Hình ảnh URL" name="HinhAnh" value="<?php echo $cate['HinhAnh'] ?>">
                            <label for="">Hình ảnh URL</label>
                        </div>
                        <button type="submit">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel-info">
                <div class="panel-heading">
                    <h3><?php echo $_SESSION['mess'];  ?></h3>
                    <h3>Danh sách danh mục sản phẩm</h3>
                </div>
                <div class="panel-body">
                    <table class="table-hover">
                        <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá nhập</th>
                            <th>Giá bán</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($item as $key => $value) :?>
                            <tr>
                                <td><?php echo $key+1?></td>
                                <td><?php echo $value['TenSP']?></td>
                                <td><?php echo $value['SoLuong'] ?></td>
                                <td><?php echo $value['GiaNhap'] ?></td>
                                <td><?php echo $value['GiaBan'] ?></td>
                                <td>
                                    <a href="adminEdit.php?maSP=<?php echo $value['maSP'] ?>" title="Sửa"><span><i class="fa-solid fa-pen" style="color: #16d436;"></i></span></a>
                                    <a href="" title="Xóa"><span> <i class="fa-solid fa-trash" style="color: #eb0000;"></i></span></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
