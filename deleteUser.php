<?php
include_once 'connection.php';

$id = $_GET['id'];

$query="DELETE FROM `user`  WHERE id = '$id'";
$run=mysqli_query($conn,$query);
if($run) {
    header('location:home.php');
} else {
    echo $query;
}
?>
