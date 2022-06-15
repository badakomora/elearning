<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Learn </title>

</head>
<body>
  

<?php
session_start();
include 'conn.php';
if(isset($_POST['submit'])){

    $ans = $_POST['answer'];

    $user_id = $_SESSION['user_id'];
    $id = $_POST['id'];


    $correct = 0;
    $wrong = 0;
    $i = 1;   



//insert user results into results table
// $query = mysqli_query($con, "SELECT * FROM results where user_id = $user_id");
// if(mysqli_num_rows($query) > 0){
//   echo 'You have already done the exercise!';
// }else{


//work out user results
        if(isset($_POST['answer'])){
            for($i=1; $i<=sizeof($_POST['answer']); $i++){
            $res = mysqli_query($con, " SELECT 
            assessments.id as aid, 
            questions.answer, questions.a_id, 
            departments.id
            FROM departments 
            INNER JOIN assessments on departments.id = assessments.d_id
            INNER JOIN questions on assessments.id = questions.a_id where questions.a_id= $id");
            while($row = mysqli_fetch_array($res)){

                if(isset($_POST['answer'][$i])){
                    if($row['answer'] == $_POST['answer'][$i]){
                        $correct++;
                    }else{
                        $wrong++;
                    }
                }else{
                    $wrong++;
                }
                $i++;
              }    
            }
          }     
         
$count = 0;
$res = mysqli_query($con,"SELECT 
assessments.id as aid, 
questions.answer, questions.a_id, 
departments.id
FROM departments 
INNER JOIN assessments on departments.id = assessments.d_id
INNER JOIN questions on assessments.id = questions.a_id where questions.a_id= $id");
$count = mysqli_num_rows($res);
$wrong = $count - $correct;
$score = 0;
$score = ($correct/$count)*100;
?>

<div class="container p-5">
<h1 class=""> Results </h1>
<table class="table table-striped">
  <thead>
    <tr>
      <td scope="col">All questions</td>
      <td scope="col">Score</td>
      <td scope="col">Percentage</td>
      <td scope="col">Remarks</td>
      <!-- <td scope="col">wrong Answers</td> -->
    </tr>
  </thead>
  <tbody>
    <tr> 
      <td><?php echo $count;?></td>
      <td><?php echo $correct;?></td>
      <td><?php echo $score;?></td>
      <td><?php if($score >= 70){
  echo '<P class="text-success">EXCELLENT</P>';
}elseif($score >= 50){
  echo '<P class="text-success">GOOD</p>';
}else{
    echo '<P class="text-danger">TRIAL</p>';
}?></td>
      <!-- <td><?php echo $wrong;?></td> -->
    </tr>
  </tbody>
</table>
  <div class="d-flex">
    <a href="../progress/" class="btn btn-success">Finish</a>
  </div>
</div>

      


<?php
//insert user results into results table
mysqli_query($con, "UPDATE results SET marks = '$score', attempt = '2' WHERE a_id = '$id'");

}

// }


?>
 <!-- ======= Footer ======= -->
 <?php include '../includes/footer.php';?>
</body>
</html>





</body>
</html>