<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
    session_start();
    include 'connection.php';

    $idUser = $_GET['id'];

    $query = 'SELECT * FROM users WHERE id=?';

    $stmlRender = $conn->prepare($query);
    $stmlRender->execute([$idUser]);

    $users = $stmlRender->fetchAll();

    if (isset($_POST['update'])){
        $id = $_POST['id'];
        echo $id;
        $fullname = $_POST['fullname'];
        echo $fullname;
        $phone = $_POST['phone'];
        echo $phone;
        $email = $_POST['email'];
        echo $email;
        $password = $_POST['password'];

        $passwordChange = password_hash($password, PASSWORD_DEFAULT);
        echo $passwordChange;

        $queryUpdate = "UPDATE users SET fullname=?, phone=?, email=?, password=? WHERE id=?";
        $stmlUpdate = $conn->prepare($queryUpdate);
        $stmlUpdate->execute([$fullname, $phone, $email, $passwordChange, $id]);

        header("Location: users.php");
    }
?>



<!DOCTYPE html>

<head>
    <title>Admin Users
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/style-responsive.css" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="css/font.css" type="text/css" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <script src="js/jquery2.0.3.min.js"></script>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">

                <a href="index.html" class="logo">
                    VISITORS
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="username"><?php echo $_SESSION['user'] ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="login.html"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li class="sub-menu">
                            <a class="active" href="javascript:;">
                                <i class="fa fa-th"></i>
                                <span>Data Tables</span>
                            </a>
                            <ul class="sub">
                                <li><a class="active" href="users.html">Quản Lý Người Dùng</a></li>
                                <li><a href="products.html">Quản Lý Sản Phẩm</a></li>
                                <li><a href="carts.html">Quản Lý Hóa Đơn</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div class="table-agile-info">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Cập Nhật Người Dùng
                        </div>
                        <div class="group-update d-flex justify-content-center py-5">
                            <form class="w-50" method="POST" action="update.php">
                                <?php foreach ($users as $user) { ?>
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input name="id" type="text" class="form-control" value="<?php echo $user['id']; ?>" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input name="fullname" type="text" class="form-control" value="<?php echo $user['fullname']; ?>" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="phone" type="text" class="form-control" value="<?php echo $user['phone']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" type="email" class="form-control" value="<?php echo $user['email']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input name="password" type="password" class="form-control" value="<?php echo $user['password']; ?>">
                                    </div>
                                    <input name="update" type="submit" class="btn btn-primary" value="Update">
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2020 Visitors. All rights reserved | Design by <a href="http://tienkim9920.github.io">Nguyễn Kim Tiền</a></p>
                </div>
            </div>
            <!-- / footer -->
        </section>

        <!--main content end-->
    </section>

    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>


    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/jquery.scrollTo.js"></script>
</body>

</html>