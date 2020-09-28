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

$_SESSION['user'] = "999";

if (isset($_SESSION['userID'])){
    $idUser = $_SESSION['userID'];
}else{
    $idUser = $_SESSION['user'];
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

$email = $address = $phone = "";

$Error = array('email' => '', 'address' => '', 'phone' => '');


if (isset($_POST['placeOrder'])) {
		$emailBuy = $_POST['email'];
		$addressBuy = $_POST['address'];
		$phoneBuy = $_POST['phone'];


		$checkLoad = true;

		if (empty($emailBuy)){
			$checkLoad = false;
			$Error['email'] = "* Vui Lòng Kiểm Tra Lại Email!";
		}

		$email = $emailBuy;

		if (empty($addressBuy)){
			$checkLoad = false;
			$Error['address'] = "* Vui Lòng Kiểm Tra Lại Địa Chỉ!";
		}

		$address = $addressBuy;

		if (empty($phoneBuy)){
			$checkLoad = false;
			$Error['phone'] = "* Vui Lòng Kiểm Tra Lại Số Điện Thoại!";
		}

		$phone = $phoneBuy;

		$contentBody = "";

		$toTal = 0;

		if ($checkLoad){
			foreach ($carts as $cart) {
				$idUser = $_SESSION['userID'];
				$idProduct = $cart['idproduct'];
				$fullname = $cart['fullname'];
				$price = $cart['price'];
				$img = $cart['img'];
				$count = $cart['count'];

				$toTal += $price * $count;

				$contentBody .= '<tr><td style="border: 1px solid black;">' . $fullname . '</td><td style="border: 1px solid black;">' . $price . '.000$</td><td style="border: 1px solid black;">' . $count . '</td></tr>';

				$queryInsert = "INSERT INTO carts (iduser, idproduct, fullname, price, img, count)
						VALUES (?, ?, ?, ?, ?, ?)";

				$stmlInsert = $conn->prepare($queryInsert);
				$stmlInsert->execute([$idUser, $idProduct, $fullname, $price, $img, $count]);
			}

			$idUser = $_SESSION['user'];

			$queryDelete = "DELETE FROM carts WHERE idUser=?";

			$stmlDelete = $conn->prepare($queryDelete);

			$stmlDelete->execute([$idUser]);

			$to = $email;
			$subject = "Xác Nhận Đơn Hàng";

			$content = '<body style="display: flex; justify-content: center; width: 100%;">' . 
			'<div class="container" style="font-family: Arial, Helvetica, sans-serif; text-align: center;">' . 
			'<p>Xin Chào ' . $_SESSION['fullname'] . '</p><hr><h3>Thông Tin Khách Hàng</h3><p>' . $_SESSION['fullname'] .'</p><p>' . $emailBuy . '</p>
			<p>' . $phoneBuy . '</p>' .
			'<p>' . $addressBuy . '</p>' .
			'<hr><h3>Thông Tin Đơn Hàng</h3><table style="border: 1px solid black; padding-bottom: 1rem"><tr><th style="border: 1px solid black;">Tên Sản Phẩm</th><th style="border: 1px solid black;">Giá</th><th style="border: 1px solid black;">Số Lượng</th>
			</tr>' . $contentBody . '</table><hr><p style="font-size: 1.6rem;">Tổng Tiền: ' . $toTal . '.000$</p></div></body>';

			$header = "From: tienkim9920@gmail.com \r\n";
			$header .= "Content-type: text/html; charset=utf-8 \r\n";

			$loading = false;

			if (mail($to, $subject, $content, $header)){
				$loading = true;
			}

			if ($loading){
				header("Location: order.php");
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
        .wrapperBuy{
            margin-top: 3rem; 
            display: grid; 
            grid-template-columns: 0.6fr 1.4fr;
        }


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

        .ca-r a {
            color: #ffffff;
        }

        .ca-r a:hover {
            color: red;
        }

        .form-group input:placeholder-shown {
            font-style: italic;
        }

        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
            position: fixed;
            top: 33rem;
            left: 45%;
        }

        .wapperLoad {
            position: fixed;
            background-image: linear-gradient(rgba(242, 242, 242, .5), rgba(242, 242, 242, .5));
            width: 100%;
            height: 100%;
            z-index: 999;
            display: none;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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
            <h2>Place Order</h2>
        </div>
    </div>

    <div class="container">
        <div class="check" id="ShowCart" style="padding: 10rem 0;">
            <form action="orderBuy.php" method="POST" class="wrapperBuy">
                <div class="checkInformation" class="col-sm-4">
                    <div class="form-group">
                        <label>Email: </label>
                        <input type="email" name="email" class="form-control" placeholder="Vui Lòng Nhập Email" value="<?php echo $email ?>">
                        <span style="color: red; width: 100%;"><?php echo $Error['email']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Address: </label>
                        <input type="text" name="address" class="form-control" placeholder="Vui Lòng Nhập Địa Chỉ" value="<?php echo $address ?>">
                        <span style="color: red; width: 100%;"><?php echo $Error['address']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Phone: </label>
                        <input type="text" name="phone" class="form-control" placeholder="Vui Lòng Nhập Số Điện Thoại" value="<?php echo $phone ?>">
                        <span style="color: red; width: 100%;"><?php echo $Error['phone']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" rows="5" id="comment"></textarea>
                    </div>
                </div>
                <div class="productInformation" style="padding: 2rem 2rem;">
                    <table style="width:100%" class="table">
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Hình Ảnh</th>
                            <th>Giá</th>
                            <th>Số Lượng</th>
                        </tr>
                        <?php foreach ($carts as $cart){ ?>
                            <tr>
                                <td><?php echo $cart['fullname'] ?></td>
                                <td><img src="<?php echo $cart['img'] ?>" alt="" width="75px"></td>
                                <td><?php echo $cart['price'] ?></td>
                                <td><?php echo $cart['count'] ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <p style="font-size: 2rem;">Tổng Tiền: <?php echo $total ?>.000$</p>
                    <?php if (isset($_SESSION['userID'])) { ?>
                        <input type="hidden" value="Loading" id="CheckLoading">
                    <?php } ?>
                    <input type="submit" name="placeOrder" class="order" value="Buy" id="placeOrder">
                </div>
            </form>
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

            if (CheckLoading === undefined) {
                flag = false;
            }

            if (flag) {
                DomID('loading').setAttribute('style', "display: block")
            }
        })
    </script>
</body>

</html>