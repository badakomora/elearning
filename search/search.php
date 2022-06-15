<?php
if(isset($_GET['user'])){
$id = $_GET['user'];
}
include '../includes/conn.php';
$query=mysqli_query($con, "SELECT 
users.id, users.email,users.staff,
departments.id, departments.department,
mydepartment.d_id, mydepartment.user_id,
assessments.id, assessments.d_id, assessments.assessment,
results.a_id, results.marks, results.attempt
FROM users
INNER JOIN mydepartment on mydepartment.user_id = users.id
INNER JOIN departments on departments.id = mydepartment.d_id
INNER JOIN assessments on assessments.d_id = departments.id
INNER JOIN results on results.a_id = assessments.id where users.email = '$id'" );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</head>
<body>
  <div class="container p-5">
  <table class="table table-striped"> 
       <thead>
<tr>
    <td scope="col">Email</td>
    <td scope="col">Department</td>
    <td scope="col">Assessment</td>
    <td scope="col">score</td>
    <td scope="col">Attempts</td>
    <td scope="col">staff</td>
    <td scope="col">Action</td>
</tr>
       </thead>
        <tbody>
            <?php 
            if(mysqli_num_rows($query)){
                while($row = mysqli_fetch_array($query)){?>
<tr>
    <td><?php echo $row['email']?></td>
    <td><?php echo $row['department']?></td>
    <td><?php echo $row['assessment']?></td>
    <td><?php echo $row['marks']?></td>
    <td><?php echo $row['attempt']?></td>
    <td><?php echo $row['staff']?></td>
    <td>
        <form action="delete.php" method="post">
        <input type="text" name="" id="">
        <button class="btn btn-primary">Edit</button>
        </form>
        <form action="delete.php" method="post">
        <input type="text" name="" id="">
        <button class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
            <?php }}else{?>
          <tr>
          <p class="text-danger">No Data Found!</p>
          </tr>      
            <?php }?>
        </tbody>
    </table> 
  </div> 
</body>
</html>