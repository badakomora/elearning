<?php 
session_start();
include 'conn.php';

$d_id = $_POST['d_id'];
$user_id = $_SESSION['user_id'];

$s = "SELECT * FROM mydepartment where user_id = $user_id";
$query1 = mysqli_query($con, $s);
$num = mysqli_num_rows($query1);
if($num > 0){
    $_SESSION['msg'] = "<div class='alert alert-danger'>Something went wrong, Permission not granted!</div>";
    header('location:../view/');
}else{
$query2 =mysqli_query($con, "INSERT INTO mydepartment(d_id, user_id) VALUES('$d_id','$user_id')");
    $_SESSION['msg1'] = "<div class='alert alert-success'>You are enrolled Successfully! Please check with your department for evaluation.</div>";
header('location:../view/');
}
?>