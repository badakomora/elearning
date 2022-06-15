<?php
if(isset($_POST['submit'])){
include '../../includes/conn.php';
$id = $_POST['id'];
$user = $_POST['user'];
$update = mysqli_query($con, "DELETE FROM results WHERE id = '$id'");
header("location: ./");
}


?>