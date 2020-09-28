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

        <?php
            include 'config.php';

            $idGET = $_GET['id'];

            $queryRender = "SELECT id, email, title, price FROM pizzas WHERE id='$idGET'";

            $stmlRender = $conn->prepare(($queryRender));
            $stmlRender->execute();

            $pizzas = $stmlRender->fetchAll();

            $error = array('id' => '' ,'email' => '', 'title' => '', 'price' => '');

            $flag = true;

            if (isset($_POST['update'])){

                $id = $_POST['id'];
                $email = $_POST['email'];
                $title = $_POST['title'];
                $price = $_POST['price'];

                if (empty($email)){
                    $error['email'] = "Email Không được để trống!";
                    $flag = false;
                }else{
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $error['email'] = "Email Sai Định Dạng!";
                        $flag = false;
                    }
                }

                if (empty($title)){
                    $error['title'] = "Title Không được để trống!";
                    $flag = false;
                }else{
                    if (!preg_match('/[a-zA-Z\s]/', $title)){
                        $error['title'] = "Title Sai Định Dạng!";    
                        $flag = false;        
                    }
                }

                if (empty($price)){
                    $error['price'] = "Price Không được để trống!";   
                    $flag = false;   
                }else{
                    if (!preg_match('/[0-9+.+0-9]/', $price)){
                        $error['price'] = "Price Sai Định Dạng!";  
                        $flag = false;         
                    }
                }

                if ($flag){
                    $queryUpdate = "UPDATE pizzas SET email='$email', title='$title', price='$price' WHERE id=$id";
                    $stmtUpdate = $conn->prepare($queryUpdate);
                    $stmtUpdate->execute([$email, $title, $price]);

                    header('Location: product.php');
                }
            }
        ?>

        <h1>Update Product</h1>

        <div class="bodyCart">
            <form method="POST" action="update.php" class="cartWapper">
                <?php foreach ($pizzas as $pizza) { ?>
                    <div class="groupInput">
                            <label class="block" for="email">ID</label>
                            <input class="block" type="text" name="id" value="<?php echo $pizza['id'] ?>" id="txtId">
                            <span class="Error" id="ErrorId"><?php echo $error['id']; ?></span>
                        </div>
                    <div class="groupInput">
                        <label class="block" for="email">Your Email</label>
                        <input class="block" type="text" name="email" value="<?php echo $pizza['email'] ?>" id="txtEmail">
                        <span class="Error" id="ErrorEmail"><?php echo $error['email']; ?></span>
                    </div>
                    <div class="groupInput">
                        <label class="block" for="title">Pizza Title</label>
                        <input class="block" type="text" name="title" value="<?php echo $pizza['title'] ?>" id="txtTitle">
                        <span class="Error" id="ErrorTitle"><?php echo $error['title']; ?></span>
                    </div>
                    <div class="groupInput">
                        <label class="block" for="price">Price</label>
                        <input class="block" type="text" name="price" value="<?php echo $pizza['price'] ?>" id="txtPrice">
                        <span class="Error" id="ErrorPrice"><?php echo $error['price']; ?></span>
                    </div>
                    <div class="groupSubmit">
                        <input type="submit" name="update" class="btn btn-info" value="UPDATE">
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>

    <script src="./Asset/javascripts.js"></script>

</body>

</html>