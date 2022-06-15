<?php
if(isset($_POST['faculty'])){
    session_start();
    include 'conn.php';
    $fid = $_POST['id'];

    $query = mysqli_query($con, "DELETE FROM assessments where id = $fid");

    
        $msg = "Assessment Deleted Successfully!";
        echo "<script type='text/javascript'>alert('$msg');</script>";
        header("Refresh: 0, ../faculty/assessments/");
}
if(isset($_POST['admin'])){
    session_start();
    include 'conn.php';
    $aid = $_POST['id'];
    
    $query = mysqli_query($con, "DELETE FROM assessments where id = $aid");

    $msg2 = "Assessment Deleted Successfully!";
    echo "<script type='text/javascript'>alert('$msg2');</script>";
    header("Refresh: 0, ../admin/assessments/");
}

?>