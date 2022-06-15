<?php
include 'conn.php';
$id = $_POST['id'];

$query = mysqli_query($con, "DELETE FROM departments where id = $id");
$msg = "Department Deleted successfully!";
echo "<script type='text/javascript'>alert('$msg');</script>";
header("Refresh: 0, ../admin/departments/");
?>