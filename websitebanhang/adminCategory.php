<?php
error_reporting(0);
include 'database.php';
global $link;
$item = mysqli_query($link,"SELECT * FROM loaisanpham");
$user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];

if (isset($_POST['MaLSP'])){
    $name= $_POST['Ten'];
    $id = $_POST['MaLSP'];

    $sql = "INSERT INTO loaisanpham(`MaLSP`, `Ten`) VALUES ('$id', '$name')";

    mysqli_query($link,$sql);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--    <link rel="stylesheet" href="css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/admin.css">
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <title>Danh mục tài khoản</title>
</head>
<body>
<div class="header">
    <div class="nav-header">
        <ul class="nav-bar">
            <li><a href="adminItem.php">Quản lí sản phẩm</a></li>
            <li><a href="adminCategory.php">Quản lí loại sản phẩm</a></li>
            <li><a href="adminUser.php">Quản lí tài khoản</a></li>
<!--            <li><a href="">Hóa đơn</a></li>-->
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
                <h3>Thêm mới sản phẩm</h3>
            </div>
            <div class="panel-body">
                <form action="#" method="post">
                    <div class="form-group">
                        <input type="text" placeholder="Mã loại sản phẩm" name="MaLSP">
                        <label for="">Mã loại sản phẩm</label>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Tên loại sản phẩm" name="Ten">
                        <label for="">Giới tính</label>
                    </div>
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel-info">
            <div class="panel-heading">
                <h3>Danh sách loại sản phẩm</h3>
            </div>
            <div class="panel-body">
                <table class="table-hover">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên loại phẩm</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($item as $key => $value) :?>
                        <tr>
                            <td><?php echo $key+1?></td>
                            <td><?php echo $value['Ten']?></td>
                            <td>
                                <a href="editCategory.php?MaLSP=<?php echo $value['MaLSP'] ?>" title="Sửa"><span><i class="fa-solid fa-pen" style="color: #16d436;"></i></span></a>
                                <a href="delete.php?MaLSP=<?php echo $value['MaLSP'] ?>" title="Xóa"><span> <i class="fa-solid fa-trash" style="color: #eb0000;"></i></span></a>
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



