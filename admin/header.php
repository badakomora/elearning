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
  <a href="../departments/" class="w3-bar-item w3-button"><i class="fa fa-list"></i> Departments</a>
  <a href="../assessments/" class="w3-bar-item w3-button"><i class="fa fa-book"></i> Assessments</a>
  <a href="../q&A/" class="w3-bar-item w3-button"><i class="fa fa-folder-open"></i> Q & A</a>
  <a href="../results/" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> Results</a>
  <a href="../users/" class="w3-bar-item w3-button"><i class="fa fa-user"></i> Staffs</a>
  <a href="../../includes/logout.php" class="w3-bar-item w3-button"><i class="fa fa-power-off"></i> Logout</a>
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