<?php

include 'config.php';

// echo '<per>';
// print_r($_GET['q']);
// echo '</per>';

$titleInput = $_GET['q'];

$querySearch = "SELECT * FROM pizzas WHERE title LIKE ?";

$stmlSearch = $conn->prepare($querySearch);
$stmlSearch->execute(['%' . $titleInput . '%']);

$pizzas = $stmlSearch->fetchAll();

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
                        <input type="hidden" name="id-delete" class="btn btn-danger" value="<?php echo $pizza['id']; ?>">
                        <input type="submit" name="delete" class="btn btn-danger" value="Delete">
                    </form>
                    &nbsp
                    <a href="update.php?id=<?php echo $pizza['id']; ?>" class="btn btn-warning" style="color: #ffffff">Update</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>