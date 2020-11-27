<?php

    include('config/db_connect.php');


    $title = $email = $things = '';
    $errors = array('email' => '', 'title' => '', 'things' => '');

    // if(isset($_GET['submit'])){
    //     echo $_GET['email'];
    //     echo $_GET['title'];
    //     echo $_GET['things'];
    // }
    if(isset($_POST['submit'])){
        
        //check email
        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required <br />';
        } else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Please type a valid email address <br />';
            }
        }

        //check title
        if(empty($_POST['title'])){
            $errors['title'] =  'An title is required <br />';
        } else {
            $title = $_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                $errors['title'] = 'Please type title right(must have letters and spaces only) <br />';
            }
        }
        //check things
        if(empty($_POST['things'])){
            $errors['things'] = 'An least one thing to do is required <br />';
        } else {
            $things = $_POST['things'];
            if(!preg_match('/^([a-zA-Z\s+)(,\s*[a-zA-Z\s]*)*$/', $things)){
                $errors['things'] = 'Please type comma seperated list <br />';
        
            }
        }

        if(array_filter($errors)){
            //echo 'errprs in the form';
        } else {

            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $things = mysqli_real_escape_string($conn, $_POST['things']);

            // create sql
            $sql = "INSERT INTO todos(title, email, things) VALUES('$title', '$email', '$things')";

            // save to db and check
            if(mysqli_query($conn, $sql)){
                //success
                //echo 'form is valid'; 
                header('Location: index.php');
            } else {
                // error
                echo 'query error: ' . mysqli_error($conn);
            }
            
            
        }
       
    }       // end of POST check
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Add</h4>
    <form class="white" action="add.php" method="POST">
    <label>Your Email:</label>
    <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
    <div class="red-text"><?php echo $errors['email']; ?></div>
    <label>Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
    <div class="red-text"><?php echo $errors['title']; ?></div>
    <label>Things to do (comma separeted):</label>
    <input type="text" name="things" value ="<?php echo htmlspecialchars($things) ?>">
    <div class="red-text"><?php echo $errors['things']; ?></div>
    <div class="center">
    <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
    </div>
    
</section>

<?php include('templates/footer.php'); ?>

</html>