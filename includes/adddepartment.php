<?php
include 'conn.php';
$department = $_POST['department'];

$query = mysqli_query($con, "INSERT INTO departments(department) VALUES('$department')");
$msg = "Department added successfully!";
echo "<script type='text/javascript'>alert('$msg');</script>";
header("Refresh: 0, ../admin/departments/");

?>