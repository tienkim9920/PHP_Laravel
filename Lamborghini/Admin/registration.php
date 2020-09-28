<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
include 'connection.php';

if (isset($_POST['register'])) {
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];

	$passwordChange = password_hash($password, PASSWORD_DEFAULT);

	$status = 0;

	$query = "INSERT INTO users (fullname, phone, email, password, status)
		VALUES (?, ?, ?, ?, ?)";

	$stml = $conn->prepare($query);
	$stml->execute([$fullname, $phone, $email, $passwordChange, $status]);

	$success = "Bạn Đã Đăng Ký Thành Công!";
}
?>

<!DOCTYPE html>

<head>
	<title>Registration User</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- bootstrap-css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- //bootstrap-css -->
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/style-responsive.css" rel="stylesheet" />
	<!-- font CSS -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<!-- font-awesome icons -->
	<link rel="stylesheet" href="css/font.css" type="text/css" />
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons -->
	<script src="js/jquery2.0.3.min.js"></script>
</head>

<body>
	<div class="reg-w3">
		<div class="w3layouts-main">
			<h2>Register Now</h2>
			<?php if (isset($success)) { ?>
				<h3 class="alert alert-success" style="color: green;"><?php echo $success ?></h3>
			<?php } ?>
			<form action="registration.php" method="POST">
				<input type="text" class="ggg" name="fullname" placeholder="FULL NAME" required="">
				<input type="email" class="ggg" name="email" placeholder="E-MAIL" required="">
				<input type="text" class="ggg" name="phone" placeholder="PHONE" required="">
				<input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">

				<div class="clearfix"></div>
				<input type="submit" value="submit" name="register">
			</form>
			<p>Already Registered.<a href="login.php">Login</a></p>
		</div>
	</div>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.dcjqaccordion.2.7.js"></script>
	<script src="js/scripts.js"></script>
	<script src="js/jquery.slimscroll.js"></script>
	<script src="js/jquery.nicescroll.js"></script>
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
	<script src="js/jquery.scrollTo.js"></script>
</body>

</html>