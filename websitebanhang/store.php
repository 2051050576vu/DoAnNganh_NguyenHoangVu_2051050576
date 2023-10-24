<?php
error_reporting(0);
include 'database.php';
global $link;
//Tìm kiếm
$mlsp = $_POST['cate'];
$where = "";
if (isset($_SESSION['searchStore'])){
    $search = $_SESSION['searchStore'];
    $where = "AND `sanpham`.`TenSP` LIKE '%$search%'";
}
//lọc
if (isset($_POST['cate'])){
    if ($_POST['cate'] == 0)
    {
        $where = "AND `loaisanpham`.`MaLSP` > 0";
    } else
        $where = "AND `loaisanpham`.`MaLSP` = $mlsp";
}
$item = mysqli_query($link,"SELECT *, `loaisanpham`.`Ten` FROM `sanpham` JOIN `loaisanpham` on `sanpham`.`MaLSP` = `loaisanpham`.`MaLSP` " . $where);
$user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];

$cate = mysqli_query($link,"SELECT * FROM `loaisanpham`");

$id = '';
$html = '';
if (mysqli_num_rows($cate)>0){
    while ($row = mysqli_fetch_assoc($cate)){
        $id = $row['MaLSP'];
        $name = $row['Ten'];
        $html .= '<li><a href="category.php?MaLSP='.$id.'">'.$name.'</a></li>';
    }
}
$brand = mysqli_query($link,"SELECT * FROM `nhacungcap`");
$user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];
//Giỏ hàng
$total = 0;
$number = 0;
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
foreach ($_SESSION['cart'] as $key => $value){
    $total += $value['ThanhTien'];
    $number += $value['SoLuong'];
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Store</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="css/style.css"/>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

        <style>
            .product-name a{
                font-size: 10px;
            }
            .product .product-body{
                height: 215px;
            }
             .nav-dropdown{
                 position: relative;
             }
            .nav-dropdown p{
                color: #FFFFFF;
            }
            .nav-dropdown ul{
                left: -40px;
                display: none;
                position: absolute;
                z-index: 99;
                background-color: #333;

            }
            .nav-dropdown li{
                padding: 10px;
                margin: 10px;
                width: 150px;
                height: 40px;
                text-align: center;
                justify-content: center;
            }
            .nav-dropdown ul a{
                font-size: 15px;
                color: #FFFFFF;
            }
            .nav-dropdown:hover ul{
                display: block;
            }
            .listPage{
                padding: 10px;
                text-align: center;
                list-style: none;
            }
            .listPage li{
                background-color: #ffffffBD;
                padding: 20px;
                display: inline-block;
                margin: 0 10px;
                cursor: pointer;
            }
            .listPage .active{
                background-color: #3a3b45;
                color: #ffffff;
            }
            .select select{
                width: 200px;
                height: 30px;
                margin-bottom: 10px;
                border-radius: 10px;
                text-align: center;
            }
            .aside input[type = submit]{
                width: 100px;
                border-radius: 10px;
            }
        </style>
    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> 0327414554</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 371 Nguyễn Kiệm</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> VND</a></li>
                        <?php if (isset($user['HoTen'])) { ?>

                            <li class="nav-dropdown">
                                <p><i class="fa fa-user-o"></i><?php echo $user['HoTen'] ?> </p>
                                <ul>

                                    <li><a href="logout.php">Đăng xuất</a></li>
                                </ul>
                            </li>
                        <?php } else{ ?>
                        <li class="nav-dropdown">
                            <p><i class="fa fa-user-o"></i>Tài khoản </p>
                            <ul>
                                <li><a href="login.php">Đăng nhập</a></li>
                                <li><a href="signup.php">Đăng kí</a></li>

                            </ul>
                            <?php }?>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="process/search.php?option=store" method="post">
                                    <button type="submit" value="<?php echo time(); ?>" name="btn-del" class="search-btn">Xóa</button>
									<input class="input"  name="searchStore" placeholder="Tìm kiếm tai đây">
									<button class="search-btn">Search</button>

								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<div class="qty"><?php echo $number ?></div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
                                            <?php  foreach ($cart as $key => $value): ?>
											<div class="product-widget">
												<div class="product-img">
													<img src="<?php echo $value['HinhAnh'] ?>" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="product.php?maSP=<?php echo $value['id'] ?>"><?php echo $value['TenSP'] ?></a></h3>
													<h4 class="product-price"><span class="qty"><?php echo $value['SoLuong']?>x</span><?php echo number_format($value['GiaBan']) ?></h4>
												</div>
												<a href="process/deleteCart.php?id=<?php echo $value['id']; ?>&option=store" class="delete"><i class="fa fa-close"></i></a>
											</div>
                                            <?php endforeach; ?>

										</div>
										<div class="cart-summary">
											<small><?php echo $number?> sản phẩm được chọn</small>
											<h5>Tổng tiền: <?php echo number_format($total) ?> VND</h5>
										</div>
										<div class="cart-btns">
											<a href="#">Giỏ hàng</a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li ><a href="Home.php">Home</a></li>
						<li><a href="#">Hot Deals</a></li>
						<li><a href="#">Store</a></li>
                        <?php echo $html; ?>
                        <?php
                        if ($_SESSION['user']['ChucVu'] == 'NhanVien')
                            echo '<li><a href="adminItem.php">Admin</a></li>';
                        ?>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li><a href="#">All Categories</a></li>
							<li><a href="#">Accessories</a></li>

						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
                            <form action="#" method="post">
                                <div class="select">
                                    <select name="cate" id="cate">
                                        <option value="0" selected>Loại sản phẩm</option>
                                        <option value="1" >Laptop</option>
                                        <option value="2" >PC</option>
                                        <option value="3" >Desktop</option>
                                        <option value="4" >Phụ kiện</option>
                                    </select>
                                </div>
                                <input type="submit" value="Lọc">
                            </form>
						</div>

						<div class="aside">
							<h3 class="aside-title">Brand</h3>
							<div class="checkbox-filter">
                                <?php foreach ($brand as $key => $value): ?>
                                    <div class="input-checkbox">
                                        <input type="checkbox" id="category-1">
                                        <label for="category-1">
                                            <span></span>
                                            <?php echo $value['TenNCC']?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
							</div>
						</div>
						<!-- /aside Widget -->


					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sort By:
									<select class="input-select">
										<option value="0">Popular</option>
										<option value="1">Position</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row">
							<!-- product -->
                            <?php foreach ($item as $key => $value) :?>
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="<?php echo $value['HinhAnh']?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo $value['Ten']?></p>
										<h3 class="product-name"><a href="product.php?maSP=<?php echo $value['maSP'] ?>"><?php echo $value['TenSP']?></a></h3>
										<h4 class="product-price"><?php echo number_format($value['GiaBan'])?> VND</h4>

										<div class="product-btns">
											<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
											<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
										</div>
									</div>
                                    <div class="add-to-cart">
                                        <form action="process/cart.php?id=<?php echo $value['maSP'] ?>&price=<?php echo $value['GiaBan'] ?>&TenSP=<?php echo $value['TenSP'] ?>&HinhAnh=<?php echo $value['HinhAnh'] ?>&option=store" method="post">
                                            <input type="submit" class="add-to-cart-btn" name="add" value="Đặt hàng">
                                        </form>
                                    </div>
								</div>
							</div>
                            <?php endforeach; ?>
							<!-- /product -->

						</div>
						<!-- /store products -->
					</div>
                    <ul class="listPage">
                    </ul>
                    <script src="js/style.js"></script>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Cung cấp những mẫu Laptop, PC với cấu hình mạnh và mức giá hợp lí nhất</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>371 Nguyễn Kiệm</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>0327414554</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
                                    <ul class="footer-links">
                                        <?php foreach ($cate as $key => $value): ?>
                                        <li><a href="#"><?php echo $value['Ten']?></a></li>
                                        <?php endforeach; ?>
                                    </ul>

							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>
