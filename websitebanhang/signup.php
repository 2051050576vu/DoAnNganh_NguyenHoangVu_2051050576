<?php

include 'database.php';
global $link;
$err = [];
if (isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $Rpassword = $_POST['rPassword'];
    if (empty($name)){
        $err['name'] = 'Bạn chưa nhập họ và tên';
    }
    if (empty($email)){
        $err['email'] = 'Bạn chưa nhập email';
    } else {
        $user = "SELECT `Email` FROM `taikhoan`";
        $checkEmail = mysqli_query($link,$user);
        if (mysqli_num_rows($checkEmail)> 0){
            while ($row = mysqli_fetch_assoc($checkEmail))
                foreach ($row as $key => $value){
                    if ($email == $value){
                        $err['email'] = 'Email đã tồn tại';
                    }
                    break;
                }
        }
    }
    if (empty($password)){
        $err['password'] = 'Bạn chưa nhập mật khẩu';
    }
    if ($password != $Rpassword){
        $err['rPassword'] = 'Mật khẩu nhập lại không đúng';
    }
    if (empty($err)){
        $pass = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO taikhoan(HoTen, SoDienThoai, Email, Password) VALUES ('$name', '$phone', '$email', '$pass')";
        $query = mysqli_query($link, $sql);
        if ($query){
            header("location: login.php");
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="js/login.js"></script>
    <style>
        .has-err{
            color: red;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <form action="" method="post">
        <h3>Đăng kí</h3>
        <div class="form-group">
            <input type="text" name="email" required>
            <label for="">Email</label>
            <div class="has-err">
                <span> <?php echo (isset($err['email']))?$err['email']:'' ?> </span>
            </div>
        </div>
        <div class="form-group">
            <input type="text" name="name" required>
            <label for="">Họ và tên</label>
            <div class="has-err">
                <span> <?php echo (isset($err['name']))?$err['name']:'' ?> </span>
            </div>
        </div>
        <div class="form-group">
            <input type="number" name="phone" required>
            <label for="">Số điện thoại</label>
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" required>
            <label for="">Mật khẩu</label>
            <div class="has-err">
                <span> <?php echo (isset($err['password']))?$err['password']:'' ?> </span>
            </div>
        </div>
        <div class="form-group">
            <input type="password" name="rPassword" id="rPassword" required>
            <label for="">Xác nhận lại mật khẩu</label>
            <div class="has-err">
                <span> <?php echo (isset($err['rPassword']))?$err['rPassword']:'' ?> </span>
            </div>
        </div>
        <div class="pass">
            <input type="checkbox" placeholder="Show password" onclick="javascript:showPassword()">
            <h2>Hiển thị mật khẩu</h2>
        </div>
        <input type="submit" value="Đăng kí" id="btn-login">
    </form>
</div>
</body>
</html>

