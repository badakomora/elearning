<?php
if(isset($_POST['faculty'])){
    session_start();
include 'conn.php';
    $assessment = $_POST['assessment'];
    $fd_id = $_POST['id'];
    $notes = $_FILES['notes']['name'];

    $query = mysqli_query($con, "INSERT INTO assessments(assessment,notes, d_id) VALUES('$assessment', '$notes', '$fd_id')");
    $target = 'slides/'. basename($notes);
    if(move_uploaded_file($_FILES['notes']['tmp_name'], $target));
    $msg = "Assessment added successfully!";
    echo "<script type='text/javascript'>alert('$msg');</script>";
    header("Refresh: 0, ../faculty/assessments/");
}
if(isset($_POST['admin'])){
    session_start();
include 'conn.php';
    $assessment = $_POST['assessment'];
    $ad_id = $_POST['id'];
    $note = $_FILES['notes']['name'];
    
    $query = mysqli_query($con, "INSERT INTO assessments(assessment, notes, d_id) VALUES('$assessment', '$note', '$ad_id')");
    $target1 = 'slides/'. basename($note);
    if(move_uploaded_file($_FILES['notes']['tmp_name'], $target1));
    $msg2 = "Assessment added successfully!";
    echo "<script type='text/javascript'>alert('$msg2');</script>";
    header("Refresh: 0, ../admin/assessments/");
}else{
    echo 'Something went wrong! Go Back!';
}
?>