<?php
include 'conn.php';
$department = $_POST['department'];
$id = $_POST['id'];

$query = mysqli_query($con, "UPDATE departments SET department = '$department' where id = $id");
$msg2 = "Department updated successfully!";
echo "<script type='text/javascript'>alert('$msg2');</script>";
header("Refresh: 0, ../admin/departments/");
?>