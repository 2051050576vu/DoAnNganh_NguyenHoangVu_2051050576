<?php
error_reporting(0);
include 'database.php';
global $link;
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
//unset($_SESSION['cart']);
$user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];
$total = 0;
$number =0;
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

		<title>Giỏ hàng</title>

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
        <link rel="stylesheet" href="css/cart.css"/>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>



        <![endif]-->
        <style>
            table, th, td{
                border: 1px solid;
            }
            table{
                width: 900px;
            }
            th, td{
                padding: 10px;
            }
            span{
                margin-right: 10px;
            }
            .form-button{
                margin-top: 10px;
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
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input" placeholder="Search here">
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
                                                        <h3 class="product-name"><a href="#"><?php echo $value['TenSP'] ?></a></h3>
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
						<li><a href="Home.php">Home</a></li>
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

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Giỏ Hàng</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Giỏ hàng</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
        <div class="container">
            <?php
                if ($_GET['option'] == 'message')
                    echo '<h4 class="mess">Đã đặt hàng thành công <i class="fa-solid fa-check"></i> </h4>';
            ?>
        </div>
		<!-- /BREADCRUMB -->
        <form action="Cart.php?action=submit" method="post">
            <div class="container">
                <div class="col-md-61">
                    <div class="panel-info">
                        <div class="panel-heading">
                            <h3>Danh sách danh mục sản phẩm</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ảnh</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                <?php  foreach ($cart as $key => $value): ?>

                                    <tr>
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo $value['TenSP']?></td>
                                        <td><img class="img" src="<?php echo $value['HinhAnh'] ?>" alt=""></td>
                                        <td><?php echo number_format($value['GiaBan'])?></td>
                                        <td>
                                            <?php if ($value['SoLuong'] > 1) {
                                                $min = $value['id'];
                                                echo '<a class="button" href="process/cart1.php?id=' . $min . '&type=minus&option=cart">-</a>';
                                            }
                                            ?>
                                            <input type="number" name="quantity" value="<?php echo $value['SoLuong']?>" class="input-quan">
                                            <a class="button" href="process/cart1.php?id=<?php echo $value['id']; ?>&type=add&option=cart">+</a>
                                        </td>
                                        <td><?php echo number_format($value['ThanhTien']) ?> VND</td>
                                        <td><a href="process/deleteCart.php?id=<?php echo $value['id']; ?>" class="btn btn-danger">Xóa</a></td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION -->
            <div class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">

                        <div class="col-md-7">
                            <!-- Billing Details -->
                            <div class="billing-details">
                                <div class="section-title">
                                    <h3 class="title">Địa chỉ giao hàng</h3>
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="first-name" placeholder="Họ và tên">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="address" placeholder="Địa chỉ">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="city" placeholder="Thành phố">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="tel" name="tel" placeholder="Số điện thoại ">
                                </div>

                            </div>
                            <!-- /Billing Details -->

                            <!-- Shiping Details -->
                            <div class="shiping-details">
                                <div class="section-title">
                                    <h3 class="title">Địa chỉ thay thế</h3>
                                </div>
                                <div class="input-checkbox">
                                    <input type="checkbox" id="shiping-address">
                                    <label for="shiping-address">
                                        <span></span>
                                        Ship to a diffrent address?
                                    </label>
                                    <div class="caption">
                                        <div class="form-group">
                                            <input class="input" type="text" name="first-name" placeholder="Họ và tên">
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="email" name="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="text" name="address" placeholder="Địa chỉ">
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="text" name="city" placeholder="Thành phố">
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="tel" name="tel" placeholder="Số điện thoại ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Shiping Details -->

                            <!-- Order notes -->
                            <div class="order-notes">
                                <textarea class="input" placeholder="Order Notes"></textarea>
                            </div>
                            <!-- /Order notes -->
                        </div>


                        <!-- Order Details -->
                        <div class="col-md-5 order-details">
                            <div class="section-title text-center">
                                <h3 class="title">Your Order</h3>
                            </div>
                            <div class="order-summary">
                                <div class="order-col">
                                    <div><strong>PRODUCT</strong></div>
                                    <div><strong>TOTAL</strong></div>
                                </div>
                                <div class="order-products">
                                    <?php  foreach ($cart as $key => $value): ?>
                                    <div class="order-col">
                                        <div><strong>x<?php echo $value['SoLuong']?></strong> <?php echo $value['TenSP']?></div>
                                        <div><?php echo $value['GiaBan']?></div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="order-col">
                                    <div>Shiping</div>
                                    <div><strong>FREE</strong></div>
                                </div>
                                <div class="order-col">
                                    <div><strong>TOTAL</strong></div>
                                    <div><strong class="order-total"><?php echo number_format($total)?></strong></div>
                                </div>
                            </div>

                            <a href="process/order.php" class="primary-btn order-submit">Place order</a>
                        </div>
                        <!-- /Order Details -->
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
        </form>
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
