<?php

session_start();

// $_SESSION['user'] = 1;


if (isset($_SESSION['userID'])){
    $idUser = $_SESSION['userID'];
}else{
    $idUser = $_SESSION['user'];
}

if (!isset($idUser)){
    header("Location: login.php");
}

include 'connection.php';

$idProduct = $_POST['id'];

$queryShow = "SELECT * FROM single WHERE idproduct=?";

$stmlShow = $conn->prepare($queryShow);

$stmlShow->execute([$idProduct]);

$ProductImages = $stmlShow->fetchAll();



$queryProduct = "SELECT * FROM products WHERE idproduct=?";

$stmlProduct = $conn->prepare($queryProduct);

$stmlProduct->execute([$idProduct]);

$products = $stmlProduct->fetchAll();


//Insert Product
//Tìm ra những sản phẩm mà User đó mua
$queryCarts = "SELECT * FROM carts WHERE iduser=?";

$stmlCart = $conn->prepare($queryCarts);

$stmlCart->execute([$idUser]);

$carts = $stmlCart->fetchAll();

$count = 0;

if (count($carts) > 0) {
    $flag = true;

    // //Tìm những sản phẩm có id giống nhau nếu giống thì tăng count
    foreach ($carts as $cart) {
        if ($cart['idproduct'] == $idProduct) {
            $count = $cart['count'] + 1;
            $flag = false;
        }
    }

    if ($flag == true) {
        $count = 1;
        foreach ($products as $product) {
            $fullname = $product['fullname'];
            $price = $product['price'];
            $img = $product['img'];
        }

        $queryInsert2 = "INSERT INTO carts (iduser, idproduct, fullname, price, img, count)
            VALUES (?, ?, ?, ?, ?, ?)";

        $stmlInsert2 = $conn->prepare($queryInsert2);
        $stmlInsert2->execute([$idUser, $idProduct, $fullname, $price, $img, $count]);
    } else {

        $queryUpdate = "UPDATE carts SET count=? WHERE iduser=? AND idproduct=?";

        $stmlUpdate = $conn->prepare($queryUpdate);

        $stmlUpdate->execute([$count, $idUser, $idProduct]);
    }
} else {
    $count = 1;

    foreach ($products as $product) {
        $fullname = $product['fullname'];
        $price = $product['price'];
        $img = $product['img'];
    }

    $queryInsert = "INSERT INTO carts (iduser, idproduct, fullname, price, img, count)
        VALUES (?, ?, ?, ?, ?, ?)";

    $stmlInsert = $conn->prepare($queryInsert);
    $stmlInsert->execute([$idUser, $idProduct, $fullname, $price, $img, $count]);
}


?>

<div class="product-price1" id="showProduct">
    <div class="top-sing">
        <div class="col-md-7 single-top">
            <div class="flexslider">
                <ul class="slides">
                    <?php foreach ($ProductImages as $productImg) { ?>
                        <li data-thumb="<?php echo $productImg['img1']; ?>">
                            <div class="thumb-image"> <img style="height: 40rem;" src="<?php echo $productImg['img1']; ?>" data-imagezoom="true" class="img-responsive"> </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="clearfix"> </div>
            <!-- slide -->

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



<style>
    /* ajs-message ajs-success ajs-visible */
    .ajs-visible {
        color: #ffffff;
        border: 1px solid #ffffff;
    }
</style>

<script>
    alertify.set('notifier', 'position', 'bottom-right');
    alertify.success('Bạn Đã Mua Thành Công!');
</script>