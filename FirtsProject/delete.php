<?php

    include 'config.php';

    //Xóa Sản Phẩm
    $idDelete = $_POST['idDelete'];

    $queryDelete = "DELETE FROM pizzas WHERE id=$idDelete";

    $stmlDelete = $conn->prepare($queryDelete);
    $stmlDelete->execute();


    //Render Sản Phẩm
    $queryRender = 'SELECT id, email, title, price FROM pizzas';

    $stmlRender = $conn->prepare($queryRender);
    $stmlRender->execute();
    $pizzas = $stmlRender->fetchAll();


?>

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
                    <form action="product.php" method="POST">
                        <input type="hidden" name="id-delete" class="btn btn-danger" value="<?php echo $pizza['id']; ?>" id="<?php echo $pizza['id']; ?>">
                        <input type="submit" name="delete" class="btn btn-danger" value="Delete" id="submitDelete<?php echo $pizza['id']; ?>">
                    </form>
                    &nbsp
                    <a href="update.php?id=<?php echo $pizza['id']; ?>" class="btn btn-warning" style="color: #ffffff">Update</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    alertify.set('notifier','position', 'bottom-left');
    alertify.success('Bạn Đã Xóa Thành Công');
</script>