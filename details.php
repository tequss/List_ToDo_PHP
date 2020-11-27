<?php

    include('config/db_connect.php');

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM todos WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            // success
            header('LOcation: index.php');
        } else {
            // failure
            echo 'query error: ' . mysqli_eroor($conn);
        }
    }
// check GET request id param
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // make sql

    $sql = "SELECT * FROM todos WHERE id = $id";

    // get the query result
    $result = mysqli_query($conn, $sql);

    // fetch result in array format
    $todo = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

}

?>

<!DOCTYPE html>
<html>

    <?php include('templates/header.php'); ?>

    <div class="container center">
        <?php if($todo): ?>
            <h4><?php echo htmlspecialchars($todo['title']); ?> </h4>
            <p>Created by: <?php echo htmlspecialchars($todo['email']); ?> </p>
            <p><?php echo date($todo['created_at']); ?> </p>
            <h5>List:</h5>
            <p><?php echo htmlspecialchars($todo['things']); ?> </p>

            <!-- Delete form -->

            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $todo['id'] ?>">
                <input type="submit" name=delete value="Delete" class="btn brand z-depth-0">
            </form>


        <?php else: ?>

            <h5> No such list exist! </h>

        <?php endif; ?>

    <?php include('templates/footer.php'); ?>

</html>