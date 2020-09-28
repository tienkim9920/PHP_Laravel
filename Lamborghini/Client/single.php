<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php

session_start();

include 'connection.php';

$getIdProduct = $_GET['idproduct'];

$query = "SELECT * FROM single WHERE idproduct=?";

$stml = $conn->prepare($query);

$stml->execute([$getIdProduct]);

$ProductImgs = $stml->fetchAll();


$queryProduct = "SELECT * FROM products WHERE idproduct=?";

$stmlProduct = $conn->prepare($queryProduct);

$stmlProduct->execute([$getIdProduct]);

$products = $stmlProduct->fetchAll();


// Carts

if (!isset($_SESSION['userID'])) {
	$_SESSION['user'] = "999";
}

$idUser = $_SESSION['user'];

$queryCart = "SELECT * FROM carts WHERE iduser=?";

$stmlCart = $conn->prepare($queryCart);

$stmlCart->execute([$idUser]);

$carts = $stmlCart->fetchAll();

$count = 0;

foreach ($carts as $cart) {
	$count += $cart['count'];
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Lamborghini</title>
	<link rel="icon" href="./images/icon.jpg">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="js/jquery.min.js"></script>
	<!-- Custom Theme files -->
	<!--theme-style-->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!--//theme-style-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Mattress Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<!--fonts-->
	<link href='//fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
	<!--//fonts-->
	<!-- start menu -->
	<link href="css/memenu.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="js/memenu.js"></script>
	<!-- <script>
		$(document).ready(function() {
			$(".memenu").memenu();
		});
	</script> -->
	<script src="js/simpleCart.min.js"> </script>
	<script src="js/imagezoom.js"></script>

	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<style>
		.fab:hover {
			color: gray !important;
		}

		.ca-r a{
			color: #ffffff;
		}
		.ca-r a:hover{
			color: red;
		}
	</style>
</head>

<body>
	<!--header-->
	<div class="header" id="showHeader">
		<div class="header-top">
			<div class="container">
				<div class="social">
					<ul>
						<li style="padding: 0 1.5rem;"><a href="#"><i class='fab fa-facebook' style='font-size:28px; color: #ffffff;'></i></a></li>
						<li><a href="#"><i class="fab fa-instagram" style='font-size:28px; color: #ffffff;'></i></a></li>
						<li style="padding: 0 1.5rem;"><a href="#"><i class="fab fa-google-plus" style='font-size:28px; color: #ffffff;'> </i></a></li>
						<div class="clearfix"></div>
					</ul>
				</div>
				<div class="header-left">
					<div class="ca-r">
						<?php if (isset($_SESSION['userID'])) { ?>
							<span style="color: #ffffff;"><?php echo $_SESSION['fullname']; ?></span>
							<a style="color: #ffffff;" href="logout.php">(Logout)</a>
						<?php } else { ?>
							<a href="login.php">(Login)</a>
						<?php } ?>
						<div class="cart box_1">
							<a href="checkout.php">
								<h3>
									<div class="total">
										<img src="./images/cart.png" alt="" />
										<span>(<?php echo $count ?>)</span></div>
								</h3>
							</a>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>

			</div>
		</div>
		<div class="container" id="GroupNavigator" style="background-color: #ffffff;">
			<div class="head-navigation">
				<div class="logo">
					<!-- <h1><a href="index.html">Lamborghini</a></h1> -->
					<img src="./images/logo.png" alt="" width="125px">
				</div>
				<div class=" h_menu4">
					<ul class="memenu skyblue">
						<li><a class="color8" href="index.php">HOME</a></li>
						<li><a class="color1" href="products.php">PRODUCTS</a></li>
						<li><a class="color4" href="login.php">LOGIN</a></li>
						<li><a class="color6" href="contact.php">CONTACT</a></li>
					</ul>
				</div>

				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- grow -->
	<div class="grow">
		<div class="container">
			<h2>Single</h2>
		</div>
	</div>
	<!-- grow -->
	<div class="product">
		<div class="container">
			<div class="product-price1" id="showProduct">
				<div class="top-sing">
					<div class="col-md-7 single-top">
						<div class="flexslider">
							<ul class="slides">
								<?php foreach ($ProductImgs as $productImg) { ?>
									<li data-thumb="<?php echo $productImg['img1']; ?>">
										<div class="thumb-image"> <img style="height: 40rem;" src="<?php echo $productImg['img1']; ?>" data-imagezoom="true" class="img-responsive"> </div>
									</li>
								<?php } ?>
							</ul>
						</div>

						<div class="clearfix"> </div>
						<!-- slide -->


						<!-- FlexSlider -->
						<!-- <script defer src="js/jquery.flexslider.js"></script>
						<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

						<script>
							// Can also be used with $(document).ready()
							$(document).ready(function() {
								$('.flexslider').flexslider({
									animation: "slide",
									controlNav: "thumbnails"
								});
							});
						</script> -->
					</div>
					<div class="col-md-5 single-top-in simpleCart_shelfItem">
						<?php foreach ($products as $product) { ?>
							<div class="single-para ">
								<h4><?php echo $product['fullname'] ?></h4>
								<div class="star-on">

									<div class="review">
										<a> <?php echo $product['name'] ?> </a>

									</div>
									<div class="clearfix"> </div>
								</div>

								<h5 class="item_price"><?php echo $product['price'] . ".000$" ?></h5>
								<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
									diam nonummy nibh euismod tincidunt ut laoreet dolore
									magna aliquam erat </p>

								<input type="hidden" value="<?php echo $product['idproduct'] ?>" id="idProduct">
								<a style="cursor: pointer;" class="add-cart item_add" id="addProduct">ADD TO CART</a>
							</div>
						<?php } ?>
					</div>
					<div class="clearfix"> </div>
				</div>
				<!---->
			</div>

			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//content-->
	<div class="footer w3layouts">
		<div class="container">
			<div class="footer-top-at w3">

				<div class="col-md-3 amet-sed w3l">
					<h4>MORE INFO</h4>
					<ul class="nav-bottom">
						<li><a href="#">How to order</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="contact.html">Location</a></li>
						<li><a href="#">Shipping</a></li>
						<li><a href="#">Membership</a></li>
					</ul>
				</div>
				<div class="col-md-3 amet-sed w3ls">
					<h4>CATEGORIES</h4>
					<ul class="nav-bottom">
						<li><a href="#">Bed linen</a></li>
						<li><a href="#">Cushions</a></li>
						<li><a href="#">Duvets</a></li>
						<li><a href="#">Pillows</a></li>
						<li><a href="#">Protectors</a></li>
					</ul>

				</div>
				<div class="col-md-3 amet-sed agileits">
					<h4>NEWSLETTER</h4>
					<div class="stay agileinfo">
						<div class="stay-left wthree">
							<form action="#" method="post">
								<input type="text" placeholder="Enter your email " required="">
							</form>
						</div>
						<div class="btn-1 w3-agileits">
							<form action="#" method="post">
								<input type="submit" value="Subscribe">
							</form>
						</div>
						<div class="clearfix"> </div>
					</div>

				</div>
				<div class="col-md-3 amet-sed agileits-w3layouts">
					<h4>CONTACT US</h4>
					<p>Contrary to popular belief</p>
					<p>The standard chunk</p>
					<p>office : +12 34 995 0792</p>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="footer-class w3-agile">
			<p>© 2020 LAMBORGHINI . All Rights Reserved | Design by <a href="http://tienkim9920.github.io" target="_blank">Nguyễn Kim Tiền</a> </p>
		</div>
	</div>


	<!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />


	<script>
		$(document).on('click', '#addProduct', () => {
			let idProduct = $('#idProduct').val();

			$.ajax({
				type: "POST",
				url: "addCart.php",
				data: {
					id: idProduct
				},
				success: function(response) {
					$('#showProduct').html(response);
				}
			});

			$.ajax({
				type: "POST",
				url: "countSum.php",
				data: {
					id: idProduct
				},
				success: function(response) {
					$('#showHeader').html(response);
				}
			});

		});
	</script>
</body>

</html>