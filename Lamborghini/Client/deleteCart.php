<?php

    session_start();

    include 'connection.php';

    $idCart =  $_POST['idCart'];

    $queryDelete = "DELETE FROM carts WHERE idcart=?";

    $stmlDelete = $conn->prepare($queryDelete);

    $stmlDelete->execute([$idCart]);


    //Render Cart

    // $idUser = $_SESSION['user'];

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
        $total += $cart['price'];
    }

?>


<div class="check" id="ShowCart">
    <h1>My Shopping Bag (<?php echo $count ?>)</h1>
    <div class="col-md-9 cart-items">
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


        <div class="clearfix"></div>
        <form action="checkout.php" method="GET">
            <input type="submit" name="placeOrder" class="order" value="Place Order">
        </form>
    </div>

    <div class="clearfix"> </div>
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
    alertify.success('Bạn Đã Xóa Thành Công!');
</script>