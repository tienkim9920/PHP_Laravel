<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
    session_start();
    include 'connection.php';

    $idProduct = $_GET['idproduct'];

    $query = 'SELECT * FROM products WHERE idproduct=?';

    $stmlRender = $conn->prepare($query);
    $stmlRender->execute([$idProduct]);

    $products = $stmlRender->fetchAll();


    if (isset($_POST['update'])){
        $id = $_POST['idproduct'];
        // echo $id;

        $query = 'SELECT * FROM products WHERE idproduct=?';

        $stmlRender = $conn->prepare($query);
        $stmlRender->execute([$id]);
    
        $products = $stmlRender->fetchAll();

        foreach ($products as $product) {
            $fileUnlink = $product['img'];
        }

        $fileUpload = $_FILES['fileUpload'];
        // print_r($fileUpload);
        $fileDatabase = '/images/' . $fileUpload['name'];
        // echo $fileDatabase;

        $fullname = $_POST['fullname'];
        // echo $fullname;

        $price = $_POST['price'];
        // echo $price;


        if ($fileUpload != null){
            $fileName = $fileUpload['tmp_name'];
            // echo $fileName;
            $destination = '../Client/images/' . $fileUpload['name'];
            // echo $destination;
            move_uploaded_file($fileName, $destination);
            $fileDelete = '../Client' . $fileUnlink;
            // echo $fileDelete;
            unlink($fileDelete);
        }

        $queryUpdate = "UPDATE products SET img=?,fullname=?, price=? WHERE idproduct=?";
        $stmlUpdate = $conn->prepare($queryUpdate);
        $stmlUpdate->execute([$fileDatabase ,$fullname, $price, $id]);

        header("Location: products.php");
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

            <div class="brand">

                <a href="index.html" class="logo">
                    VISITORS
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>

            <div class="top-nav clearfix">

                <ul class="nav pull-right top-menu">

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


                </ul>

            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">

                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li class="sub-menu">
                            <a class="active" href="javascript:;">
                                <i class="fa fa-th"></i>
                                <span>Data Tables</span>
                            </a>
                            <ul class="sub">
                                <li><a href="users.php">Quản Lý Người Dùng</a></li>
                                <li><a class="active" href="products.php">Quản Lý Sản Phẩm</a></li>
                                <li><a href="carts.php">Quản Lý Hóa Đơn</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div class="table-agile-info">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Cập Nhật Sản Phẩm
                        </div>
                        <div class="group-update d-flex justify-content-center py-5">
                            <form class="w-50" method="POST" action="productUpdate.php" enctype="multipart/form-data">
                                <?php foreach ($products as $product) { ?>
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input name="idproduct" type="text" class="form-control" value="<?php echo $product['idproduct']; ?>" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input name="fileUpload" type="file" class="form-control w-50" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input name="fullname" type="text" class="form-control" value="<?php echo $product['fullname']; ?>" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="price" type="text" class="form-control" value="<?php echo $product['price']; ?>">
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