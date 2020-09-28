<?php
session_start();

if (!isset($_SESSION['user'])){
    header("Location: login.php");
}

include 'config.php';

$queryRender = 'SELECT id, email, title, price FROM pizzas';

$stmlRender = $conn->prepare($queryRender);
$stmlRender->execute();
$pizzas = $stmlRender->fetchAll();
?>

<?php

// $flag = false;

// if (isset($_POST['delete'])) {
//     echo $_POST['id-delete'];

//     $id_delete = $_POST['id-delete'];

//     $queryDelete = "DELETE FROM pizzas WHERE id=$id_delete";

//     $stmlDelete = $conn->prepare($queryDelete);
//     $stmlDelete->execute();
//     $flag = true;
// }

// if ($flag) {
//     header("Location: product.php");
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add To Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./Asset/style.css">

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/> -->

    <style>
        .btn-primary {
            padding: .6rem 1.5rem !important;
            border: none;
        }

        td {
            color: gray;
            line-height: 2.3rem;
        }

        img {
            width: 38px;
        }

        .title-h1 {
            padding: 2rem 0 !important;
        }

        .form-inline {
            padding: 1rem 0;
        }

        .btnAddCart {
            margin-top: 1.3rem;
        }
    </style>
</head>

<body>
    <div class="wapper">
        <?php include('./Template/header.php'); ?>

        <h1 class="title-h1">Pizzas</h1>

        <div class="container">
            <div class="form-inline d-flex justify-content-end">
                <input class="form-control" type="text" placeholder="Search" name="q" id="inputSearch">
            </div>


            <?php if (isset($_SESSION['msg'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['msg'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php unset($_SESSION['msg']);
            } ?>


            <div id="updateTable">
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody id="containerProduct">
                        <?php foreach ($pizzas as $pizza) { ?>
                            <tr class="rowProduct">
                                <td><?php echo htmlspecialchars($pizza['id']); ?></td>
                                <td><img src="img/pizza.svg" alt="pizza"></td>
                                <td class="titlePizza"><?php echo htmlspecialchars($pizza['title']); ?></td>
                                <td><?= number_format($pizza['price'], 0, ',', '.') . ' VNĐ'; ?></td>
                                <td class="d-flex">
                                    <a href="view.php?id=<?php echo $pizza['id']; ?>" class="btn btn-success">View</a>
                                    &nbsp
                                    <div>
                                        <input type="hidden" name="idDelete" class="btn btn-danger" value="<?php echo $pizza['id']; ?>" id="<?php echo $pizza['id']; ?>">
                                        <input type="submit" name="delete" class="btn btn-danger" value="Delete" id="submitDelete<?php echo $pizza['id']; ?>">

                                        <!-- <button type="submit" name="id-delete" class="btn btn-danger" value="<?php echo $pizza['id']; ?>" id="submitDelete">Delete</button> -->
                                    </div>
                                    &nbsp
                                    <a href="update.php?id=<?php echo $pizza['id']; ?>" class="btn btn-warning" style="color: #ffffff">Update</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- <script>
        function DomID(id){
            return document.getElementById(id)
        }

        // Chọn tất cả các class tên giống nhau chứa những dữ liệu muốn tìm kiếm
        var rowProduct = document.querySelectorAll('.rowProduct')

        DomID('inputSearch').addEventListener('keyup', () => {
            var inputSearch = DomID('inputSearch').value.toUpperCase()

            var arrTemp = []
            for (var i = 0; i < rowProduct.length; i++){
                
                // Tạo 1 class vào thẻ bên Html mà mình muốn tìm kiếm theo trường đó 
                // Và và sẽ convert sang innerHTML
                let title = rowProduct[i].getElementsByClassName('titlePizza')[0].innerHTML
                console.log(title)

                if (title.toUpperCase().indexOf(inputSearch) > -1){
                    arrTemp.push(rowProduct[i])
                    console.log("True")
                }
                console.log("123123")
            }

            for (var i = 0; i < arrTemp.length; i++){
                console.log(arrTemp[i].innerHTML)
            }

            render(arrTemp)
        })

        function render(arrRender){

            DomID('containerProduct').innerHTML = ""
            var filterArr = []

            for (var i = 0; i < arrRender.length; i++){
                var str = '<tr class="rowProduct">' + arrRender[i].innerHTML + '</tr>'
                filterArr.push(str)
            }

            var renderHTML = filterArr.join('');
            DomID('containerProduct').innerHTML = renderHTML
        }


    </script> -->

    <!-- Bootstraps -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script>
        $(document).on('keyup', '#inputSearch', function() {
            let q = $(this).val();

            $.ajax({
                type: "get",
                url: "search.php",
                data: {
                    q: q
                },
                success: function(data) {
                    $('#updateTable').html(data);
                }
            });
        });

        <?php foreach ($pizzas as $pizza) { ?>
            $(document).on('click', '#submitDelete' + <?php echo $pizza['id'] ?>, function() {

                let idDelete = $('#' + <?php echo $pizza['id'] ?>).val();

                console.log(idDelete)

                $.ajax({
                    type: "post",
                    url: "delete.php",
                    data: {
                        idDelete: idDelete
                    },
                    success: function(data) {
                        $('#updateTable').html(data);
                    }
                });

            });
        <?php } ?>
    </script>

    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />


    <!-- Datatable Search -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>

    <script>

        $(document).ready(function() {
            $('#example').DataTable();
        } );

    </script> -->

</body>

</html>
</body>

</html>