<?php

include('config/db_connect.php');

// write query to all todo list
    $sql = 'SELECT title, things, id FROM todos ORDER BY created_at';

    // make query and get result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array

    $todos = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory
    mysqli_free_result($result);

    // close conenction
    mysqli_close($conn);

    // explode
    explode(',', $todos[0]['things']);

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<h4 class="center grey-text">List:</h4>

<div class="container">
<div class="row">
    <?php foreach($todos as $todo){ ?>

        <div class="col s6 md3">
            <div class="card z-depth-0">
                <div class="card-conent center">
                    <h6><?php echo htmlspecialchars($todo['title']);?></h6>
                   <ul>
                   <?php foreach(explode(',', $todo['things']) as $thing){ ?>
                    <li><?php echo htmlspecialchars($thing); ?></li>
                   <?php } ?>
                   </ul>
        
                </div>
                <div class="card-action right-align">
                <a class="brand-text" href="details.php?id=<?php echo $todo['id']?>">more info</a>
                </div>
            </div>    
        </div>

    <?php } ?>
</div>
</div>
<?php include('templates/footer.php'); ?>

</html>
