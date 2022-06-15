<?php
if(isset($_POST['faculty'])){
include 'conn.php';
$fid = $_POST['id'];

$query = mysqli_query($con, "DELETE FROM questions where id = $fid");
$msg = "Question Deleted successfully!";
echo "<script type='text/javascript'>alert('$msg');</script>";
header("Refresh: 0, ../faculty/q&A/");
}
if(isset($_POST['admin'])){
    include 'conn.php';
    $aid = $_POST['id'];
    
    $query = mysqli_query($con, "DELETE FROM questions where id = $aid");
    $msg2 = "Question Deleted successfully!";
    echo "<script type='text/javascript'>alert('$msg2');</script>";
    header("Refresh: 0, ../admin/q&A/");
    }
?>
