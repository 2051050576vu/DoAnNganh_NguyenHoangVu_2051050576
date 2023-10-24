<?php
error_reporting(0);
include 'database.php';
global $link;
$where = "";
if (isset($_SESSION['search'])){
    $search = $_SESSION['search'];
    $where = "AND `sanpham`.`TenSP` LIKE '%$search%'";
}
$query = 'Select *, `loaisanpham`.`Ten` From `sanpham` LEFT JOIN `loaisanpham` on `sanpham`.`MaLSP` = `loaisanpham`.`MaLSP` WHERE `sanpham`.`MaLSP` = 1 ' . $where;
$lap = mysqli_query($link, $query);
$pc = mysqli_query($link, 'Select *, `loaisanpham`.`Ten` From `sanpham` LEFT JOIN `loaisanpham` on `sanpham`.`MaLSP` = `loaisanpham`.`MaLSP` WHERE `sanpham`.`MaLSP` = 2 ' . $where);
$desktop = mysqli_query($link, 'Select *, `loaisanpham`.`Ten` From `sanpham` LEFT JOIN `loaisanpham` on `sanpham`.`MaLSP` = `loaisanpham`.`MaLSP` WHERE `sanpham`.`MaLSP` = 3 ' . $where);
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

		<title>Electro - HTML Ecommerce Template</title>

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

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        <style>
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
        </style>
    </head>
	<body>

		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="adminItem.php"><i class="fa fa-phone"></i> 0327414554</a></li>
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
								<form  action="process/search.php" method="post">
                                        <button type="submit" name="btn-delete" class="search-btn">Xóa</button>
                                        <input class="input"  type="text" name="search" placeholder="Search here">
                                        <button type="submit" name="btn-search" class="search-btn">Tìm kiếm</button>
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
						<li class="active"><a href="#">Home</a></li>
						<li><a href="store.php">Store</a></li>
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

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop01.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Laptop<br>Collection</h3>
								<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop03.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Accessories<br>Collection</h3>
								<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/PC.jpg" alt="">
							</div>
							<div class="shop-body">
								<h3>PC<br>Collection</h3>
								<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">LAPTOP</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
									<li><a data-toggle="tab" href="#tab1">PC</a></li>
									<li><a data-toggle="tab" href="#tab1">Desktop</a></li>
									<li><a data-toggle="tab" href="#tab1">Accessories</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
                                        <?php foreach ($lap as $key => $value) :?>

                                            <div class="product">
                                                <div class="product-img">
                                                    <img src='<?php echo $value['HinhAnh']?>' alt="">
<!--                                                    <div class="product-label">-->
<!--                                                        <span class="sale">-30%</span>-->
<!--                                                        <span class="new">NEW</span>-->
<!--                                                    </div>-->
                                                </div>
                                                <div class="product-body">
                                                    <p class="product-category"><?php echo $value['Ten']?></p>
                                                    <h3 class="product-name"><a href="product.php?maSP=<?php echo $value['maSP'] ?>"><?php echo $value['TenSP']?></a></h3>
                                                    <h4 class="product-price"><?php echo number_format($value['GiaBan'])?> VND</h4>
                                                    <div class="product-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="product-btns">
                                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                                    </div>
                                                </div>
                                                <div class="add-to-cart">
<!--                                                    <a href="Cart.php?maSP=--><?php //echo $value['maSP'] ?><!--" class="add-to-cart-btn">thêm</a>-->
                                                    <form action="process/cart.php?id=<?php echo $value['maSP'] ?>&price=<?php echo $value['GiaBan'] ?>&TenSP=<?php echo $value['TenSP'] ?>&HinhAnh=<?php echo $value['HinhAnh'] ?>" method="post">
                                                        <input type="submit" class="add-to-cart-btn" name="add" value="Đặt hàng">
                                                    </form>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>
										<!-- product -->
										<!-- /product -->
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Days</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Hours</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Mins</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Secs</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">hot deal this week</h2>
							<p>New Collection Up to 50% OFF</p>
							<a class="primary-btn cta-btn" href="#">Shop now</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">PC</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li ><a data-toggle="tab" href="#tab2">Laptops</a></li>
									<li class="active"><a data-toggle="tab" href="#tab2">PC</a></li>
									<li><a data-toggle="tab" href="#tab2">Desktop</a></li>
									<li><a data-toggle="tab" href="#tab2">Accessories</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<!-- product -->
                                        <?php foreach ($pc as $key => $value) :?>

                                            <div class="product">
                                                <div class="product-img">
                                                    <img src='<?php echo $value['HinhAnh']?>' alt="">

                                                </div>
                                                <div class="product-body">
                                                    <p class="product-category"><?php echo $value['Ten']?></p>
                                                    <h3 class="product-name"><a href="product.php?maSP=<?php echo $value['maSP'] ?>"><?php echo $value['TenSP']?></a></h3>
                                                    <h4 class="product-price"><?php echo number_format($value['GiaBan'])?> VND</h4>
                                                    <div class="product-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="product-btns">
                                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                                    </div>
                                                </div>
                                                <div class="add-to-cart">
                                                    <form action="process/cart.php?id=<?php echo $value['maSP'] ?>&action='add' &price=<?php echo $value['GiaBan'] ?>&TenSP=<?php echo $value['TenSP'] ?>&HinhAnh=<?php echo $value['HinhAnh'] ?>" method="post">
                                                        <input type="submit" class="add-to-cart-btn" name="add" value="Đặt hàng">
                                                    </form>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>
										<!-- /product -->

									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
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
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">PC</a></li>
									<li><a href="#">Desktop</a></li>
									<li><a href="#">Accessories</a></li>
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