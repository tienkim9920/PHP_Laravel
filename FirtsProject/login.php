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

        .groupInput input {
            color: gray;
        }

        .btnAddCart {
            margin-top: 1.3rem;
        }
    </style>
</head>

<body>
    <div class="wapper">
        <?php include('./Template/header.php'); ?>

        <?php
        session_start();
        include 'config.php';

        $username = $password = "";

        $error = array('username' => '', 'password' => '');

        $idUser = "";

        if (isset($_POST['submit'])) {

            $flag = true;

            $username = $_POST['username'];
            $password = $_POST['password'];

            if (empty($username)) {
                $error['username'] = "Email Không được để trống!";
                $flag = false;
            }

            if (empty($password)) {
                $error['password'] = "Password Không được để trống!";
                $flag = false;
            }


            if ($flag) {
                $sql = "SELECT * FROM accounts WHERE username=?";

                $stmtAccount = $conn->prepare($sql);

                $stmtAccount->execute([$username]);

                $userAccount = $stmtAccount->fetchAll();

                if ($userAccount == null) {
                    $error['username'] = "Username Không Tồn Tại!";
                } else {
                    foreach ($userAccount as $account) {
                        if (password_verify($password, $account['password'])) {
                            if ($account['status'] == true) {
                                $_SESSION['user'] = $account['fullname'];
                                header("Location: product.php");
                            } else {
                                $status = "Bạn Không Có Quyền Truy Cập";
                            }
                        } else {
                            $error['password'] = "Vui Lòng Kiểm Tra Lại Password!";
                        }
                    }
                }
            }
        }
        ?>


        <h1>Login</h1>

        <div class="bodyCart">
            <form method="POST" action="login.php" class="cartWapper">

                <?php if (isset($status)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $status ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>

                <div class="groupInput">
                    <label class="block" for="email">Username</label>
                    <input class="block" type="text" name="username" value="<?php echo $username ?>">
                    <span class="Error" id="ErrorEmail"><?php echo $error['username']; ?></span>
                </div>
                <div class="groupInput">
                    <label class="block" for="title">Password</label>
                    <input class="block" type="password" name="password" value="<?php echo $password ?>">
                    <span class="Error" id="ErrorTitle"><?php echo $error['password']; ?></span>
                </div>
                <div class="groupSubmit">
                    <input type="submit" name="submit" class="btn btn-info" value="Login">
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstraps -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>