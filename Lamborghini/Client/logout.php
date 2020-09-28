
<?php 
    session_start();

    unset($_SESSION['userID']);

    header("Location: " . $_SERVER['HTTP_REFERER']);
?>