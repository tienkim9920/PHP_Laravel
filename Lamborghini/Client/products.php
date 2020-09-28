<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php

session_start();

include 'connection.php';

$query = "SELECT * FROM products";

$stml = $conn->prepare($query);
$stml->execute([$query]);

$products = $stml->fetchAll();

// Pagination



$page = 0;

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$countProduct = 6;

$start = ($page - 1) * $countProduct;

$productSlice = array_splice($products, $start, $countProduct, true);

// Button Pagination

$countButton = [];

$sumButton = count($products) / 6;

for ($i = 0; $i < $sumButton; $i++) {
	array_push($countButton, $i + 1);
}

$nextClick = $page + 1;
$preClick = $page - 1;

if ($nextClick > count($countButton)) {
	$nextClick = 1;
	$page = 1;
}

if ($preClick < 1) {
	$preClick = 1;
}



// Carts

if (!isset($_SESSION['userID'])) {
	$_SESSION['user'] = "999";
}

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

<body>
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
							<a href="logout.php" style="color: #ffffff;">(Logout)</a>
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
	<!-- products -->
	<!-- grow -->
	<div class="grow">
		<div class="container">
			<h2>Products</h2>
		</div>
	</div>
	<!-- grow -->
	<div class="pro-du">
		<div class="container">
			<div class="col-md-12 product1">
				<div class=" bottom-product">
					<?php foreach ($productSlice as $product) { ?>
						<div class="col-md-4 bottom-cd simpleCart_shelfItem">
							<div class="product-at ">
								<a href="single.php?idproduct=<?php echo $product['idproduct'] ?>"><img style="height: 17rem;" class="img-responsive" src="<?php echo $product['img'] ?>" alt="">
									<div class="pro-grid">
										<span class="buy-in">Buy Now</span>
									</div>
								</a>
							</div>
							<p class="tun"><span><?php echo $product['fullname'] ?></span><br><?php echo $product['name'] ?></p>
							<div class="ca-rt">
								<a href="#" class="item_add">
									<p class="number item_price"><i> </i><?php echo $product['price'] . ".000$" ?></p>
								</a>
							</div>
							<div class="clearfix"></div>
						</div>
					<?php } ?>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="pagination-Product" style="width: 100%; display: flex; justify-content: center;">
				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item">
							<a class="page-link" href="products.php?page=<?php echo $preClick ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
								<span class="sr-only">Previous</span>
							</a>
						</li>
						<?php foreach ($countButton as $count) { ?>
							<li class="page-item"><a class="page-link pageClick" href="products.php?page=<?php echo $count; ?>"><?php echo $count; ?></a></li>
						<?php } ?>
						<li class="page-item">
							<a class="page-link" href="products.php?page=<?php echo $nextClick ?>" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
								<span class="sr-only">Next</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>

		</div>
	</div>
	<!-- products -->
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

	<script>
		var temp = window.location.href.split('=');

		var pageClick = document.getElementsByClassName('pageClick')

		console.log(temp)

		if (temp.length < 2) {
			pageClick[0].setAttribute('style', 'color: #ffffff; background-color: orangered')
		}

		for (var i = 0; i < pageClick.length; i++) {
			if ((i + 1) === parseInt(temp[1])) {
				pageClick[i].setAttribute('style', 'color: #ffffff; background-color: orangered')
			}
		}
	</script>
</body>

</html>