<?php
if (!isset($_SESSION['email'])) {
$msg = "Please Login Correctly!";
echo "<script type='text/javascript'>alert('$msg');</script>";
header("Refresh: 0, ../");
}
?>