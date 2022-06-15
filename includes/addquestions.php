<?php
if(isset($_POST['faculty'])){
include 'conn.php';
$question = $_POST['question'];
$answer1 = $_POST['answer1'];
$answer2 = $_POST['answer2'];
$answer3 = $_POST['answer3'];
$answer4 = $_POST['answer4'];
$answer = $_POST['answer'];
$fa_id = $_POST['id'];

$query = mysqli_query($con, "INSERT INTO questions(question,choice1, choice2, choice3, choice4, answer, a_id) VALUES('$question', '$answer1', '$answer2', '$answer3', '$answer4', '$answer', '$fa_id')");
$msg = "Question added successfully!";
echo "<script type='text/javascript'>alert('$msg');</script>";
header("Refresh: 0, ../faculty/q&A/");

}
if(isset($_POST['admin'])){
include 'conn.php';
$question = $_POST['question'];
$answer1 = $_POST['answer1'];
$answer2 = $_POST['answer2'];
$answer3 = $_POST['answer3'];
$answer4 = $_POST['answer4'];
$answer = $_POST['answer'];
$aa_id = $_POST['id'];

$query = mysqli_query($con, "INSERT INTO questions(question,choice1, choice2, choice3, choice4, answer, a_id) VALUES('$question', '$answer1', '$answer2', '$answer3', '$answer4', '$answer', '$aa_id')");
$msg2 = "Question added successfully!";
echo "<script type='text/javascript'>alert('$msg2');</script>";
header("Refresh: 0, ../admin/q&A/");
}
?>
