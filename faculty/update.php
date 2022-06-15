<?php
if(isset($_POST['submit'])){
include '../includes/conn.php';
$id = $_POST['id'];
$aid = $_POST['aid'];
$user = $_POST['user'];
$update = mysqli_query($con, "UPDATE results set attempt = '$id' where a_id = '$aid' ");
$msg2 = "Record Updated!";
echo "<script type='text/javascript'>alert('$msg2');</script>";
header("Refresh: 0, search.php?user=$user");
}


?>