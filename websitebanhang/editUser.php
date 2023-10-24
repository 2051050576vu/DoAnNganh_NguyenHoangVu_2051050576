<?php

include 'database.php';
global $link;
$user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];
$item = mysqli_query($link,"SELECT * FROM taikhoan");

if (isset($_GET['IDTaiKhoan'])){
    $idTK = $_GET['IDTaiKhoan'];
    $data = mysqli_query($link, "SELECT * FROM taikhoan WHERE IDTaiKhoan = $idTK");
    $cate = mysqli_fetch_assoc($data);

}

if (isset($_POST['Email'])){
    $name = $_POST['HoTen'];
    $birth= $_POST['NgaySinh'];
    $sex = $_POST['GioiTinh'];
    $phone = $_POST['SoDienThoai'];
    $email = $_POST['Email'];
    $pass = md5($_POST['Password']);
    $role = $_POST['ChucVu'];

    $sql = "UPDATE taikhoan SET HoTen = '$name', NgaySinh='$birth', GioiTinh='$sex', SoDienThoai='$phone', Email='$email', Password='$pass', ChucVu = '$role' WHERE IDTaiKhoan = $idTK ";
    $query = mysqli_query($link,$sql);
    if ($query){
        header('location: adminUser.php');
        session_start();
        $_SESSION['mess'] = "Cập nhật thành công!";

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
            <li><a href="">Hóa đơn</a></li>
            <li><a href="Home.php">Home</a></li>
            <?php if (isset($user['HoTen'])) { ?>
                <li class="nav-dropdown">
                    <a href="login1.php"><i class="fa fa-user-o"></i><?php echo $user['HoTen'] ?> </a>
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
                <h3>Sửa tài khoản</h3>
            </div>
            <div class="panel-body">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" placeholder="Họ và tên" name="HoTen" value="<?php echo $cate['HoTen'] ?>">
                        <label for="">Họ và tên</label>
                    </div>
                    <div class="form-group">
                        <input type="date" placeholder="Ngày Sinh" name="NgaySinh" value="<?php echo $cate['NgaySinh'] ?>">
                        <label for="">Ngày sinh</label>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Giới tính" name="GioiTinh" value="<?php echo $cate['GioiTinh'] ?>">
                        <label for="">Giới tính</label>
                    </div>
                    <div class="form-group">
                        <input type="number" placeholder="Số Điện Thoại" name="SoDienThoai" value="<?php echo $cate['SoDienThoai'] ?>">
                        <label for="">Số điện thoại</label>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Email" name="Email" value="<?php echo $cate['Email'] ?>">
                        <label for="">Email</label>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Mật khẩu" name="Password" value="<?php echo $cate['Password'] ?>">
                        <label for="">Mật khẩu</label>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Chức vụ" name="ChucVu" value="<?php echo $cate['ChucVu'] ?>">
                        <label for="">Chức vụ</label>
                    </div>
                    <button type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel-info">

            <div class="panel-heading">
                <h3>Danh sách tài khoản</h3>
            </div>
            <div class="panel-body">
                <table class="table-hover">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ và tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Email</th>
                        <th>Chức vụ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($item as $key => $value) :?>
                        <tr>
                            <td><?php echo $key+1?></td>
                            <td><?php echo $value['HoTen']?></td>
                            <td><?php echo $value['NgaySinh'] ?></td>
                            <td><?php echo $value['GioiTinh'] ?></td>
                            <td><?php echo $value['Email'] ?></td>
                            <td><?php echo $value['ChucVu'] ?></td>
                            <td>
                                <a href="editUser.php?IDTaiKhoan=<?php echo $value['IDTaiKhoan'] ?>" title="Sửa"><span><i class="fa-solid fa-pen" style="color: #16d436;"></i></span></a>
                                <a href="delete.php?IDTaiKhoan=<?php echo $value['IDTaiKhoan'] ?>" title="Xóa"><span> <i class="fa-solid fa-trash" style="color: #eb0000;"></i></span></a>
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
