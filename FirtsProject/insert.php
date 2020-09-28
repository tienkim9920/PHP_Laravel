<?php
include 'config.php';

$email = $title = $price = "";

$error = array('email' => '', 'title' => '', 'price' => '');

$success = "";

if (isset($_POST['submit'])) {

    $flag = true;

    $email = $_POST['email'];
    $title = $_POST['title'];
    $price = $_POST['price'];

    if (empty($email)) {
        $error['email'] = "Email Không được để trống!";
        $flag = false;
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "Email Sai Định Dạng!";
            $flag = false;
        }
    }

    if (empty($title)) {
        $error['title'] = "Title Không được để trống!";
        $flag = false;
    } else {
        if (!preg_match('/[a-zA-Z\s]/', $title)) {
            $error['title'] = "Title Sai Định Dạng!";
            $flag = false;
        }
    }

    if (empty($price)) {
        $error['price'] = "Price Không được để trống!";
        $flag = false;
    } else {
        if (!preg_match('/[0-9+.+0-9]/', $price)) {
            $error['price'] = "Price Sai Định Dạng!";
            $flag = false;
        }
    }

    if ($flag) {
        $sql = "INSERT INTO pizzas (email, title, price) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email, $title, $price]);

        $email = $title = $price = "";

        $success = "Bạn Đã Thêm Thành Công!";
        $_SESSION['msg'] = $success;

        header("Location: product.php");
    }
}
