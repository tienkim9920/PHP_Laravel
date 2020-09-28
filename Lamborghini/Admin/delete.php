
<?php
    include 'connection.php';

    $idDelete = $_POST['id'];

    $queryDelete = "DELETE FROM users WHERE id=?";

    $stmlDelete = $conn->prepare($queryDelete);
    $stmlDelete->execute([$idDelete]);


    $queryRender = "SELECT * FROM users";

    $stmlRender = $conn->prepare($queryRender);
    $stmlRender->execute();

    $users = $stmlRender->fetchAll();

?>


<table class="table-active" id="myTable">
    <thead>
        <tr>
            <th data-breakpoints="xs">ID</th>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user['id'] ?></td>
                <td><?php echo $user['fullname'] ?></td>
                <td><?php echo $user['phone'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td>
                    <a href="update.php?id=<?php echo $user['id'] ?>" class="btn btn-primary">Update</a>
                    <input type="hidden" name="idDelete" class="btn btn-danger" value="<?php echo $user['id']; ?>" id="<?php echo $user['id']; ?>">
                    <input type="submit" name="delete" class="btn btn-danger" value="Delete" id="submitDelete<?php echo $user['id']; ?>">
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<style>
    /* ajs-message ajs-success ajs-visible */
    .ajs-visible{
        color: #ffffff;
        border: 1px solid #ffffff;
    }

</style>

<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });

    alertify.set('notifier','position', 'bottom-right');
    alertify.success('Bạn Đã Xóa Thành Công!');
</script>