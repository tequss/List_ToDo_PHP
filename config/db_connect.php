<?php
//connect to database
$conn = mysqli_connect('localhost', 'tequs', 'password', 'todo_list');

//check conenction
if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
}

?>