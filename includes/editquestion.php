<?php
if(isset($_POST['faculty'])){
include 'conn.php';
$question = $_POST['question'];
$answer1 = $_POST['ch1'];
$answer2 = $_POST['ch2'];
$answer3 = $_POST['ch3'];
$answer4 = $_POST['ch4'];
$answer = $_POST['answer'];
$fid = $_POST['id'];

$query = mysqli_query($con, "UPDATE questions SET question = '$question', choice1 = '$answer1',choice2 = '$answer2',choice3 = '$answer3',choice4 = '$answer4', answer = '$answer' where id = $fid");
$msg = "Question updated successfully!";
echo "<script type='text/javascript'>alert('$msg');</script>";
header("Refresh: 0, ../faculty/q&A/");

}
if(isset($_POST['admin'])){
    include 'conn.php';
    $question = $_POST['question'];
    $answer1 = $_POST['ch1'];
    $answer2 = $_POST['ch2'];
    $answer3 = $_POST['ch3'];
    $answer4 = $_POST['ch4'];
    $answer = $_POST['answer'];
    $aid = $_POST['id'];
    
    $query = mysqli_query($con, "UPDATE questions SET question = '$question', choice1 = '$answer1',choice2 = '$answer2',choice3 = '$answer3',choice4 = '$answer4', answer = '$answer' where id = $aid");
    $msg2 = "Question updated successfully!";
    echo "<script type='text/javascript'>alert('$msg2');</script>";
    header("Refresh: 0, ../admin/q&A/");
}
?>