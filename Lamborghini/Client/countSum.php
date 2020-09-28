<?php

session_start();

include 'connection.php';

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
foreach ($carts as $cart) {
    $count += $cart['count'];
}

?>


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
                        <a href="login.php" style="color: #ffffff;">(Login)</a>
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