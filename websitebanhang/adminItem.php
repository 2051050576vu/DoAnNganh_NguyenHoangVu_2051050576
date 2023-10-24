<?php
error_reporting(0);
include 'database.php';
global $link;
$where = "";
if (isset($_SESSION['searchAdmin'])){
    $search = $_SESSION['searchAdmin'];
    $where = "WHERE `sanpham`.`TenSP` LIKE '%$search%'";
}
$item = mysqli_query($link,"SELECT * FROM sanpham " .$where );
$user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];

if (isset($_POST['TenSP'])){
    $name = $_POST['TenSP'];
    $quantity = $_POST['SoLuong'];
    $buy = $_POST['GiaNhap'];
    $sell = $_POST['GiaBan'];
    $idLSP = $_POST['MaLSP'];
    $idNCC = $_POST['MaNCC'];
    $pic = $_POST['HinhAnh'];

    $sql = "INSERT INTO sanpham(TenSP, SoLuong, GiaNhap, GiaBan, MaLSP, MaNCC, HinhAnh) VALUES ('$name', '$quantity', '$buy', '$sell', '$idLSP', '$idNCC','$pic')";

    mysqli_query($link,$sql);
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
    <link type="text/css" rel="stylesheet" href="css/style.css"/>

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
                        <a href="login.php"><?php echo $user['HoTen'] ?> </a>
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
    <div class="col-md-6">
        <div class="header-search">
            <form  action="process/search.php" method="post">
                <button type="submit" value="<?php echo time(); ?>" name="btn-delete" class="search-btn">Xóa</button>
                <input class="input" type="text" value="<?php echo $_SESSION['searchAdmin'];?>" name="searchAdmin" placeholder="Search here">
                <button type="submit" name="btn-search" class="search-btn">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="col-md-6">
            <div class="panel-info-1">
                <div class="panel-heading">
                    <h3>Thêm mới sản phẩm</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="Tên sản phẩm" name="TenSP">
                            <label for="">Tên sản phẩm</label>
                        </div>
                        <div class="form-group">
                            <input type="number" placeholder="Số lượng" name="SoLuong">
                            <label for="">Số lượng</label>
                        </div>
                        <div class="form-group">
                            <input type="number" placeholder="Giá nhập" name="GiaNhap">
                            <label for="">Giá nhập</label>
                        </div>
                        <div class="form-group">
                            <input type="number" placeholder="Giá bán" name="GiaBan">
                            <label for="">Giá bán</label>
                        </div>
                        <div class="form-group">
                            <input type="number" placeholder="Mã loại sản phẩm" name="MaLSP">
                            <label for="">Mã loại sản phẩm</label>
                        </div>
                        <div class="form-group">
                            <input type="number" placeholder="Mã nhà cung cấp" name="MaNCC">
                            <label for="">Mã nhà cung cấp</label>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Hình ảnh URL" name="HinhAnh">
                            <label for="">Hình ảnh URL</label>
                        </div>
                        <button type="submit">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel-info">
                <div class="panel-heading">
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
                                    <a href="delete.php?maSP=<?php echo $value['maSP'] ?>" title="Xóa"><span> <i class="fa-solid fa-trash" style="color: #eb0000;"></i></span></a>
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