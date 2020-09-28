<?php
    include 'connection.php';

    $idDelete = $_POST['id'];

    $queryDelete = "DELETE FROM products WHERE idproduct=?";

    $stmlDelete = $conn->prepare($queryDelete);
    $stmlDelete->execute([$idDelete]);


    $queryRender = "SELECT * FROM products";

    $stmlRender = $conn->prepare($queryRender);
    $stmlRender->execute();

    $products = $stmlRender->fetchAll();

?>


<table class="table" id="myTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) { ?>
            <tr>
                <td><?php echo $product['idproduct'] ?></td>
                <td>
                    <img src="../Client/<?php echo $product['img'] ?>" alt="" style="width: 60px;">
                </td>
                <td><?php echo $product['fullname'] ?></td>
                <td><?php echo $product['price'] ?></td>
                <td><?php echo "Còn Hàng" ?></td>
                <td>
                    <a href="productUpdate.php?idproduct=<?php echo $product['idproduct'] ?>" class="btn btn-primary">Update</a>
                    <input type="hidden" name="idDelete" class="btn btn-danger" value="<?php echo $product['idproduct']; ?>" id="<?php echo $product['idproduct']; ?>">
                    <input type="submit" name="delete" class="btn btn-danger" value="Delete" id="submitDelete<?php echo $product['idproduct']; ?>">
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<a href="productNew.php" class="btn btn-primary" style="margin-left: 1rem; margin-bottom: 1rem;">New Product</a>

<style>
    /* ajs-message ajs-success ajs-visible */
    .ajs-visible {
        color: #ffffff;
        border: 1px solid #ffffff;
    }
</style>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    alertify.set('notifier', 'position', 'bottom-right');
    alertify.success('Bạn Đã Xóa Thành Công!');
</script>