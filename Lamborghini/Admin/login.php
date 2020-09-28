<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
	session_start();
	unset($_SESSION['user']);
	include 'connection.php';

	$email = $password = "";

	$Error = array('email' => '', 'password' => '');

	if(isset($_POST['login'])){
		$email = $_POST['Email'];
		$password = $_POST['Password'];

		$query = 'SELECT * FROM users WHERE email=?';
		$stml = $conn->prepare($query);
		$stml->execute([$email]);

		$users = $stml->fetchAll();

		if ($users == null){
			$Error['email'] = "* Email Không Tồn Tại!";
			$email = $password = "";
		}else{
			foreach($users as $user){
				if (!password_verify($password, $user['password'])){
					$Error['password'] = "* Vui Lòng Kiểm Tra Lại Password!";
					$password = "";

				}else{
					$_SESSION['user'] = $user['fullname'];
					header("Location: users.php");
				}
			}
		}
	}
?>


<!DOCTYPE html>

<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script
		type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- bootstrap-css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- //bootstrap-css -->
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/style-responsive.css" rel="stylesheet" />
	<!-- font CSS -->
	<link
		href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
		rel='stylesheet' type='text/css'>
	<!-- font-awesome icons -->
	<link rel="stylesheet" href="css/font.css" type="text/css" />
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons -->
	<script src="js/jquery2.0.3.min.js"></script>
</head>

<body>
	<div class="log-w3">
		<div class="w3layouts-main">
			<h2>Sign In Now</h2>
			<form action="login.php" method="post">
				<input type="email" class="ggg" name="Email" placeholder="E-MAIL" required="" value="<?php echo $email; ?>">
				<span style="color: red; width: 100%;"><?php echo $Error['email']; ?></span>
				<input type="password" class="ggg" name="Password" placeholder="PASSWORD" required="" value="<?php echo $password; ?>">
				<span style="color: red; width: 100%;"><?php echo $Error['password']; ?></span>
				<div class="clearfix"></div>
				<input type="submit" value="Sign In" name="login">
			</form>
			<p>Don't Have an Account ?<a href="registration.php">Create an account</a></p>
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