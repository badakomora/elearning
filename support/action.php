<?php

$msg = $_POST['msg'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$position = $_POST['position'];

$con = mysqli_connect('localhost','root','','poam');
$insert = "INSERT INTO test(Fname, Lname, email, position, message) VALUES('$fname', '$lname', '$email', '$position', '$msg')";
mysqli_query($con, $insert);
header('location:./');

?>