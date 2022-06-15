<?php
if(isset($_GET['user'])){
$id = $_GET['user'];
}
include '../includes/conn.php';
$query=mysqli_query($con, "SELECT 
users.id, users.email,
assessments.id, assessments.assessment, 
results.a_id, results.marks, results.attempt 
FROM results 
INNER JOIN assessments on assessments.id = results.a_id 
INNER JOIN users on results.user_id = users.id where users.email = '$id'" );
?>
<?php 
session_start();?>
<?php
if (!isset($_SESSION['email'])) {
    header('location:../');
}
?>
<style>
  body{
    font-size: smaller;
  }
</style>
<!DOCTYPE html>
<html>
<title>Learn | Faculty</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<style>
    @import url(//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);
    @import url(https://fonts.googleapis.com/css?family=Titillium+Web:300);
</style>
<body>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-left p-1" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()"> &times; Close</button>
  <hr>
  <a href="./"class="w3-bar-item w3-button"><i class="fa fa-home"></i> Home</a>
  <a href="assessments/" class="w3-bar-item w3-button"><i class="fa fa-book"></i> Assessments</a>
  <a href="q&A/" class="w3-bar-item w3-button"><i class="fa fa-folder-open"></i> Q & A</a>
  <a href="../includes/logout.php" class="w3-bar-item w3-button"><i class="fa fa-power-off"></i> Logout</a>
</div>


<div id="main">

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "15%";
  document.getElementById("mySidebar").style.width = "15%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>
  <!-- content -->
  <div class="area">
            <div class="container-fluid shadow-lg">
                <div class="d-flex justify-content-between">
                    <div class="m-2">  
                        <div class="d-flex">
                            <div class="">
                                <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
                            </div>
                            <div class="logo text-primary">
                                <h1>Learn</h1> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

  <div class="container p-5">
  <table class="table table-striped"> 
       <thead>
<tr>
    <td scope="col">Email</td>
    <td scope="col">Assessment</td>
    <td scope="col">score</td>
    <td scope="col">Attempts</td>
    <td scope="col">Action</td>
</tr>
       </thead>
        <tbody>
            <?php 
            if(mysqli_num_rows($query)){
                while($row = mysqli_fetch_array($query)){?>
<tr>
    <td><?php echo $row['email']?></td>
    <td><?php echo $row['assessment']?></td>
    <td><?php echo $row['marks']?>%</td>
    <form action="update.php" method="post">
        <td>
          
          <!-- <input type="text" name="id" value="<?php echo $row['attempt']?>"> -->

          <div class="form-group col-md-4">
            <select name="id" class="form-control">
              <option selected><?php echo $row['attempt']?></option>
              <option value="1">Retake - 1</option>
              <option value="2">Complete - 2</option>
            </select>
          </div>
      
        </td>
        <td class="d-flex">
            <input type="hidden" name="user" value="<?php echo $id;?>">
            <input type="hidden" name="aid" value="<?php echo $row['a_id']; ?>">
            <button class="btn btn-primary" type="submit" name="submit">Update</button>
        </td>
    </form>
</tr>
            <?php }}else{?>
          <tr>
          <div class="alert alert-danger">No Data Found!</div>
          </tr>      
            <?php }?>
        </tbody>
    </table> 
  </div> 
  </div>
  <?php include '../includes/footer.php';?>
</body>
</html>







    




















<!-- 
<div class="form-group col-md-4">
      <select id="inputState" class="form-control">
        <option selected>Attempt Status...</option>
        <option value="1">Retake</option>
        <option value="2">Complete</option>
      </select>
    </div>

$query=mysqli_query($con, "SELECT 
users.id as uid, users.email,users.staff,
departments.id, departments.department,
mydepartment.d_id, mydepartment.user_id,
assessments.id, assessments.d_id, assessments.assessment,
results.a_id, results.marks, results.attempt
FROM users
INNER JOIN mydepartment on mydepartment.user_id = users.id
INNER JOIN departments on departments.id = mydepartment.d_id
INNER JOIN assessments on assessments.d_id = departments.id
INNER JOIN results on results.a_id = assessments.id where users.email = '$id'" ); -->