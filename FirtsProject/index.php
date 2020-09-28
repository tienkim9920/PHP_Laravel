<?php
    session_start();

    if (!isset($_SESSION['user'])){
        header("Location: login.php");
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
        .groupInput input{
            color: gray;
        }
        .btnAddCart{
            margin-top: 1.3rem;
        }
    </style>
</head>

<body>   
    <div class="wapper">
        <?php include('./Template/header.php'); ?>

        <?php include 'insert.php'; ?>

        <h1>Add To Cart</h1>

        <div class="bodyCart">
            <form method="POST" action="index.php" class="cartWapper">
                <div class="groupInput">
                    <label class="block" for="email">Your Email</label>
                    <input class="block" type="text" name="email" value="<?php echo $email ?>" id="txtEmail">
                    <span class="Error" id="ErrorEmail"><?php echo $error['email']; ?></span>
                </div>
                <div class="groupInput">
                    <label class="block" for="title">Pizza Title</label>
                    <input class="block" type="text" name="title" value="<?php echo $title ?>" id="txtTitle">
                    <span class="Error" id="ErrorTitle"><?php echo $error['title']; ?></span>
                </div>
                <div class="groupInput">
                    <label class="block" for="price">Price</label>
                    <input class="block" type="text" name="price" value="<?php echo $price ?>" id="txtPrice">
                    <span class="Error" id="ErrorPrice"><?php echo $error['price']; ?></span>
                </div>
                <div class="groupSubmit">
                    <input type="submit" name="submit" class="btn btn-info" value="SUBMIT" id="submitAddCart">
                </div>
            </form>
        </div>
    </div>

    <script src="./Asset/javascripts.js"></script>

</body>

</html>