<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php

//-------Carts

session_start();

include 'connection.php';

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


//-----Login
$email = $password = "";

$Error = array('email' => '', 'password' => '');

if (isset($_POST['login'])) {

	$email = $_POST['email'];
	$password = $_POST['password'];

	$query = 'SELECT * FROM users WHERE email=?';
	$stml = $conn->prepare($query);
	$stml->execute([$email]);

	$users = $stml->fetchAll();

	if ($users == null) {
		$Error['email'] = "* Email Không Tồn Tại!";
		$email = $password = "";
	} else {
		foreach ($users as $user) {
			if (!password_verify($password, $user['password'])) {
				$Error['password'] = "* Vui Lòng Kiểm Tra Lại Password!";
				$password = "";
			} else {
				$_SESSION['userID'] = $user['id'];
				$_SESSION['fullname'] = $user['fullname'];
				header("Location: checkout.php");
			}
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
			<h2>Login</h2>
		</div>
	</div>
	<!-- grow -->
	<!--content-->
	<div class="container">
		<div class="account">
			<div class="account-pass">
				<div class="col-md-8 account-top">
					<form action="login.php" method="POST">
						<div>
							<span>Email</span>
							<input type="text" name="email">
							<span style="color: red; padding-top: 1rem; width: 100%;"><?php echo $Error['email'] ?></span>
						</div>
						<div>
							<span>Password</span>
							<input type="password" name="password">
							<span style="color: red; padding-top: 1rem; width: 100%;"><?php echo $Error['password'] ?></span>
						</div>
						<input type="submit" value="Login" name="login">
					</form>
				</div>
				<div class="col-md-4 left-account ">
					<a href="single.html"><img class="img-responsive " src="images/t1.jpg" alt=""></a>
					<div class="five">
						<h2>25% </h2><span>discount</span>
					</div>
					<a href="register.html" class="create">Create an account</a>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
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
</body>

</html>