<?php
include 'conn.php';
$id = $_POST['id'];

$query = mysqli_query($con, "DELETE FROM users where id = $id");
$msg2 = "Selected User has been Deleted successfully!";
echo "<script type='text/javascript'>alert('$msg2');</script>";
header("Refresh: 0, ../admin/users/");
?>