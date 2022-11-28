<?php
include './database/connection.php';

if(isset($_POST['sendDelete'])){
    $unique = $_POST['sendDelete'];

    $sql = "delete from `users` where id = $unique";

    $result = mysqli_query($con,$sql);
}

?>