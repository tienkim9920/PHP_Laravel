<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
session_start();

include 'connection.php';

$loading = true;
$flag = true;

$_SESSION['user'] = "999";

if (isset($_SESSION['userID'])){
	$idUser = $_SESSION['userID'];
	//Tao ra idUserTemp để đẩy product vào SESSION['userID'] sau đó xóa hết 
	$idUserTemp = $_SESSION['user'];

	$queryPushProduct = "SELECT * FROM carts WHERE iduser=?";

	$stmlPushProduct = $conn->prepare($queryPushProduct);

	$stmlPushProduct->execute([$idUserTemp]);

	$pushCarts = $stmlPushProduct->fetchAll();

	foreach($pushCarts as $cart){
		$idCart = $cart['idcart'];
		$idUser = $_SESSION['userID'];
		$idProduct = $cart['idproduct'];
		$fullname = $cart['fullname'];
		$price = $cart['price'];
		$img = $cart['img'];
		$count = $cart['count'];

		$queryADD = "INSERT INTO carts (iduser, idproduct, fullname, price, img, count)
		VALUES (?, ?, ?, ?, ?, ?)";

		$stmlADD = $conn->prepare($queryADD);
		$stmlADD->execute([$idUser, $idProduct, $fullname, $price, $img, $count]);

		$queryDELETE = "DELETE FROM carts WHERE idcart=?";

		$stmlDelete = $conn->prepare($queryDELETE);
		$stmlDelete->execute([$idCart]);
	}
}else{
	$idUser = $_SESSION['user'];
	$flag = false;
}

$query = "SELECT * FROM carts WHERE iduser=?";

$stml = $conn->prepare($query);

$stml->execute([$idUser]);

$carts = $stml->fetchAll();

$count = 0;
$total = 0;

foreach ($carts as $cart) {
	$count += $cart['count'];
	$total += $cart['price'] * $cart['count'];
}


// Check User

$queryUser = "SELECT * FROM users";

$stmlUser = $conn->prepare($queryUser);

$stmlUser->execute();

$users = $stmlUser->fetchAll();


if (isset($_GET['placeOrder'])){

	if (!$flag){
		header("Location: login.php");
	}else{
		$checkProduct = true;
		if ($carts == null){
			$checkProduct = false;
		}
	
		if (!$checkProduct){
			$ErrorBuy = "Vui Lòng Chọn Mua Sản Phẩm!";
		}else{
			header("Location: orderBuy.php");
		}
	}
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
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--fonts-->
	<link href='//fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
	<!--//fonts-->
	<!-- start menu -->
	<link href="css/memenu.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="js/memenu.js"></script>
	<script>
		$(document).ready(function() {
			$(".memenu").memenu();
		});
	</script>
	<script src="js/simpleCart.min.js"> </script>

	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<style>
		.fab:hover {
			color: gray !important;
		}

		.close {
			opacity: 0.8 !important;
		}

		.close:hover {
			opacity: 1 !important;
		}

		input.order {
			background: #8ce78a;
			width: 100%;
			padding: 1rem 0;
			border: none;
			outline: none;
		}

		input.order:hover {
			background: #54dd54;
		}

		.ca-r a{
			color: #ffffff;
		}
		.ca-r a:hover{
			color: red;
		}

		.form-group input:placeholder-shown{
			font-style: italic;
		}

		.loader {
			border: 16px solid #f3f3f3;
			border-radius: 50%;
			border-top: 16px solid #3498db;
			width: 120px;
			height: 120px;
			-webkit-animation: spin 2s linear infinite; /* Safari */
			animation: spin 2s linear infinite;
			position: fixed;
			top: 33rem;
			left: 45%;
		}

		.wapperLoad{
			position: fixed;
			background-image: linear-gradient(rgba(242,242,242,.5), rgba(242,242,242,.5));
			width: 100%;
			height: 100%;
			z-index: 999;
			display: none;
		}

			/* Safari */
			@-webkit-keyframes spin {
			0% { -webkit-transform: rotate(0deg); }
			100% { -webkit-transform: rotate(360deg); }
			}

			@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
			}
	</style>
</head>

<body>
	
	<div class="wapperLoad" id="loading">
		<div class="loader"></div>
	</div>

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

					<div class="search-box">
						<div id="sb-search" class="sb-search">
							<form action="#" method="post">
								<input class="sb-search-input" placeholder="Enter your search term..." type="search" id="search">
								<input class="sb-search-submit" type="submit" value="">
								<span class="sb-icon-search"> </span>
							</form>
						</div>
					</div>

					<div class="ca-r">
						<?php if (isset($_SESSION['userID'])) { ?>
							<span style="color: #ffffff;"><?php echo $_SESSION['fullname']; ?></span>
							<a href="logout.php">(Logout)</a>
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

	<div class="grow">
		<div class="container">
			<h2>Checkout</h2>
		</div>
	</div>

	<div class="container">
		<div class="check" id="ShowCart">
			<h1>My Shopping Bag (<?php echo $count ?>)</h1>
			<div class="col-md-9 cart-items">
				<?php if (isset($ErrorBuy)) { ?>
					<div class="alert alert-danger"><?php echo $ErrorBuy; ?></div>
				<?php } ?>
				<?php foreach ($carts as $cart) { ?>
					<div class="cart-header2">
						<div class="close" style="opacity: .8;">
							<input type="hidden" style="cursor: pointer;" class="btn btn-danger" id="<?php echo $cart['idcart'] ?>" value="<?php echo $cart['idcart'] ?>">
							<input type="submit" style="cursor: pointer;" class="btn btn-danger" id="submit<?php echo $cart['idcart'] ?>" value="X">
						</div>
						<div class="cart-sec simpleCart_shelfItem">
							<div class="cart-item cyc">
								<img style="width: 25rem; height: 16rem;" src="<?php echo $cart['img'] ?>" class="img-responsive" alt="" />
							</div>
							<div class="cart-item-info">
								<h3><a style="font-size: 1.8rem;"><?php echo $cart['fullname'] ?></a><span style="font-size: 1.6rem;">Số Lượng: <?php echo $cart['count'] ?></span></h3>
								</ul>
								<div class="delivery">
									<p style="font-size: 1.6rem;">Giá: <?php echo $cart['price'] ?>.000$</p>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="clearfix"></div>

						</div>
					</div>
				<?php } ?>
			</div>

			<div class="col-md-3 cart-total">
				<div class="price-details">
					<h3>Price Details</h3>
					<span>Total</span>
					<span class="total1"><?php echo $total ?>.000$</span>
					<span>Discount</span>
					<span class="total1">---</span>
					<div class="clearfix"></div>
				</div>
				<ul class="total_price">
					<li class="last_price">
						<h4>TOTAL</h4>
					</li>
					<li class="last_price"><span><?php echo $total ?>.000$</span></li>
					<div class="clearfix"> </div>
				</ul>

				<form action="checkout.php" method="get">
					<input type="submit" class="order" value="Place Order" name="placeOrder" id="placeOrder">
				</form>



				<div class="clearfix"></div>

			</div>

			<div class="clearfix"></div>
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
			<p>© 2015 Mattress . All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
		</div>
	</div>


	<!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />


	<script>
		<?php foreach ($carts as $cart) { ?>
			$(document).on('click', '#submit<?php echo $cart['idcart'] ?>', () => {
				let value = $('#<?php echo $cart['idcart'] ?>').val();

				$.ajax({
					type: "POST",
					url: "deleteCart.php",
					data: {
						idCart: value
					},
					success: function(response) {
						$('#ShowCart').html(response);
					}
				});

				$.ajax({
					type: "POST",
					url: "countSum.php",
					data: {
						idCart: value
					},
					success: function(response) {
						$('#showHeader').html(response);
					}
				});
			});
		<?php } ?>

		function DomID(id) {
			return document.getElementById(id);
		}

		var flag = true;
		DomID('placeOrder').addEventListener('click', () => {
			var CheckLoading = DomID('CheckLoading');

			if (CheckLoading === undefined){
				flag = false;
			}

			if (flag) {
				DomID('loading').setAttribute('style', "display: block")
			}
		})

	</script>
</body>

</html>