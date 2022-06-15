<?php
include 'conn.php';
$did = $_POST['d_id'];
$user = $_POST['user'];
$query = mysqli_query($con, "SELECT users.id, users.email, 
mydepartment.user_id
FROM mydepartment
INNER JOIN users on users.id = mydepartment.user_id where users.email = '$user'");
while ($row = mysqli_fetch_array($query)){

$userid =  $row['user_id'];
$query1 = mysqli_query($con, "UPDATE mydepartment SET d_id = $did where user_id = '$userid'");
$msg = "User Department updated Successful!";
echo "<script type='text/javascript'>alert('$msg');</script>";
header("Refresh: 0, ../admin/users/");
}
?>