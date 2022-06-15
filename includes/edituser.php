<?php
include 'conn.php';
$staff = $_POST['staff'];
$id = $_POST['id'];

$query = mysqli_query($con, "UPDATE users SET staff = '$staff' where id = $id");
$msg2 = "Selected User updated successfully!";
echo "<script type='text/javascript'>alert('$msg2');</script>";
header("Refresh: 0, ../admin/users/");
?>