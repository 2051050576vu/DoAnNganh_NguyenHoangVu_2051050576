<?php

include  "database.php";
global $link;

if (isset($_POST['email'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM taikhoan WHERE Email = '$email'";
    $query = mysqli_query($link,$sql);
    $data = mysqli_fetch_assoc($query);
    $checkEmail = mysqli_num_rows($query);
    if ($checkEmail == 1){
        $checkPass = password_verify($pass, $data['Password']);
        if ($checkPass){
            $_SESSION['user'] = $data;
            if ($data['ChucVu'] == 'NhanVien'){
                header("location: Home.php");
            }
            else {
                header("location: Home.php");
            }
        }
        else {
            echo "Mật khẩu không đúng";
        }
    } else{
        echo "Email không tồn tài";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Gmail</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="js/login.js"></script>
</head>
<body>
<div id="wrapper">

    <form action="" method="post">
        <h3>Đăng nhập</h3>
        <div class="form-group">
            <input type="text" name="email" required>
            <label for="">Email</label>
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" required>
            <label for="">Mật khẩu</label>
        </div>
        <div class="pass">
            <input type="checkbox" placeholder="Show password" onclick="javascript:showPassword()">
            <h2>Hiển thị mật khẩu</h2>
        </div>
        <input type="submit" name="login" value="Đăng nhập" id="btn-login">
        <div class="signup">
            <a href="signup.php">Đăng kí tài khoản</a>
        </div>
        <div class="signup">
            <a href="Home.php">Quay lại</a>
        </div>
    </form>

</div>
</body>
</html>
