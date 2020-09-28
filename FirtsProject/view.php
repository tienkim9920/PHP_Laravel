
<?php
    include 'config.php';

    $idGET = $_GET['id'];

    $queryRender = "SELECT email, title, price, create_at FROM pizzas WHERE id=$idGET";

    $stmlRender = $conn->prepare($queryRender);
    $stmlRender->execute();

    $pizza = $stmlRender->fetchAll();

    $title = "";
    foreach ($pizza as $value){
        $title = $value['title'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add To Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="./Asset/style.css">
    <style>
        .btn-primary {
            padding: .6rem 1.5rem !important;
            border: none;
        }
        .title-h1{
            padding: 3rem 0 !important;        
        }
        img{
            width: 200px;
            margin-bottom: 4rem;
        }
        .btnAddCart{
            margin-top: 1.3rem;
        }
    </style>
</head>

<body>
    <div class="wapper">
        <?php include('./Template/header.php'); ?>

        <h1 class="title-h1"><?php echo $title; ?></h1>

        <div class="bodyCart">
            <div class="cartWapper">
                <div class="text-center">
                    <?php foreach ($pizza as $value) { ?>
                        <img src="img/pizza.svg" alt="pizza">
                        <p><?= 'Giá: ' . number_format($value['price'], 0, ',', '.') . ' VNĐ'; ?></p>
                        <p><?php echo 'Email: ' . $value['email']; ?></p>
                        <p><?php echo 'Ngày Tạo: ' . $value['create_at']; ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script src="./Asset/javascripts.js"></script>

</body>

</html>