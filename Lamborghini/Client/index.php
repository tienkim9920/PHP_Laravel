<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
	session_start();

	// if (!isset($_SESSION['user'])){
	//     header("Location: login.php");
	// }

	include 'connection.php';

	$query = 'SELECT * FROM products';

	$stmlRender = $conn->prepare($query);
	$stmlRender->execute();

	$products = $stmlRender->fetchAll();

	$productSlice = array_slice($products, 0, 4, true);

	$productShow = array_splice($products, 4, 4, true);

	// Carts

	// $idUser = $_SESSION['user'];
	
	// if (!isset($_SESSION['userID'])){
	// 	$_SESSION['user'] = "999";
	// }
	$_SESSION['user'] = "999";
	if (isset($_SESSION['userID'])){
        $idUser = $_SESSION['userID'];
    }else{
        $idUser = $_SESSION['user'];
    }

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

		.ca-r a{
			color: #ffffff;
		}
		.ca-r a:hover{
			color: red;
		}
	</style>
</head>

<body onscroll="myFunction()">
	<!--header-->
	<div class="header">
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

					<!-- search-scripts -->
					<script src="js/classie.js"></script>
					<script src="js/uisearch.js"></script>
					<script>
						new UISearch(document.getElementById('sb-search'));
					</script>
					<!-- //search-scripts -->

					<div class="ca-r">
						<?php if (isset($_SESSION['userID'])) { ?>
							<span style="color: #ffffff;"><?php echo $_SESSION['fullname']; ?></span>
							<a style="cursor: pointer;" href="logout.php">(Logout)</a>
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
		<div class="container" id="GroupNavigator">
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
	<div class="banner">
		<div class="container">
			<script src="js/responsiveslides.min.js"></script>
			<script>
				$(function() {
					$("#slider").responsiveSlides({
						auto: true,
						nav: true,
						speed: 500,
						namespace: "callbacks",
						pager: true,
					});
				});
			</script>
			<div id="top" class="callbacks_container">
				<ul class="rslides" id="slider">
					<li>

						<div class="banner-text">
							<h3>Lorem Ipsum is </h3>
							<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a
								piece of classical Latin literature from 45 BC.</p>

						</div>

					</li>
					<li>

						<div class="banner-text">
							<h3>There are many </h3>
							<p>Popular belief Contrary to , Lorem Ipsum is not simply random text. It has roots in a
								piece of classical Latin literature from 45 BC.</p>


						</div>

					</li>
					<li>
						<div class="banner-text">
							<h3>Sed ut perspiciatis</h3>
							<p>Lorem Ipsum is not simply random text. Contrary to popular belief, It has roots in a
								piece of classical Latin literature from 45 BC.</p>


						</div>

					</li>
				</ul>
			</div>

		</div>
	</div>

	<!--content-->
	<div class="container">
		<div class="cont">
			<div class="content">
				<div class="content-top-bottom">
					<h2>Lamborghini PRODUCTS</h2>

					<?php foreach ($productSlice as $product) { ?>
						<div class="col-md-6 men fix-col">
							<a href="single.php?idproduct=<?php echo $product['idproduct']; ?>" class="b-link-stripe b-animate-go thickbox"><img class="img-responsive" src="<?php echo $product['img'] ?>" alt="">
								<div class="b-wrapper">
									<h3 class="b-animate b-from-top top-in b-delay03 ">
										<span><?php echo $product['fullname'] ?></span>
									</h3>
								</div>
							</a>
						</div>
					<?php } ?>
					<div class="clearfix"> </div>
				</div>

				<div class="content-top">
					<h1>NEW PRODUCTS</h1>
					<div class="grid-in">

						<?php foreach ($productShow as $product) { ?>
							<div class="col-md-3 grid-top simpleCart_shelfItem">
								<a href="single.php?idproduct=<?php echo $product['idproduct']; ?>" class="b-link-stripe b-animate-go  thickbox"><img style="height: 17rem;" class="img-responsive" src="<?php echo $product['img'] ?>" alt="">
									<div class="b-wrapper">
										<h3 class="b-animate b-from-left b-delay03 ">
											<span><?php echo $product['name']; ?></span>
										</h3>
									</div>
								</a>
								<p><a href="single.php?idproduct=<?php echo $product['idproduct']; ?>"><?php echo $product['name']; ?></a></p>
								<a href="single.php?idproduct=<?php echo $product['idproduct']; ?>" class="item_add">
									<p class="number item_price"><i> </i><?php echo $product['price'] . ".000$"; ?></p>
								</a>
							</div>
						<?php } ?>
						
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			<!----->
		</div>
		<!---->
	</div>
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

	<script src="./js/Sticky.js"></script>
</body>

</html>