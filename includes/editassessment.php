<?php
include 'conn.php';
$assessment = $_POST['assessment'];
$id = $_POST['id'];

$query = mysqli_query($con, "UPDATE assessments SET assessment = '$assessment' where id = $id");
if($query){
    $msg = "Assessment updated successfully!";
    echo "<script type='text/javascript'>alert('$msg');</script>";
    header("Refresh: 0, ../admin/assessments/");
}else{
    $msg2 = "Error! Something went wrong, Please Retry.";
    echo "<script type='text/javascript'>alert('$msg2');</script>";
    header('location:../admin/assessments/');
}

?>