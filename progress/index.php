<?php 
session_start();
include '../includes/sessions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Learn || staff e-learning</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!--Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
    
<header id="" class="fixed-top bg-white">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="./" class="text-decoration-none">Learn</a></h1>
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto">Hello, <?php echo $_SESSION["name"]; ?></a></li>
          <li><a href="../view/" class="nav-link">Dashboard</a></li>
          <li><a href="../progress/" class="nav-link active">Progress</a></li>
          <li class="dropdown"><a href="#" class="text-decoration-none"><span>Departments</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <?php 
              include '../includes/conn.php';
              $departments = mysqli_query($con, "SELECT * FROM departments");
              ?>
              <li><a href="#">Departments</a></li><hr>
              <?php while($row = mysqli_fetch_array($departments)){?>
              <li>
                <form action="../includes/enrol.php" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $row['id']?>">
                  <button class="btn" type="submit" id="id<?php echo $row['id']?>" style="background-color: white;"><?php echo $row['department'];?></button>
                </form>
              </li>
              <script>
                $('#id<?php echo $row['id']?>').click(function(){
                  alert("You are about to be enrolled to <?php echo $row['department']?>");
                });
              </script>
              <?php }?>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="../includes/logout.php" class="appointment-btn scrollto text-decoration-none">Sign Out</a>

    </div>
  </header><!-- End Header -->





<?php 
include '../includes/conn.php';
$results = mysqli_query($con, "SELECT users.id,
assessments.id, assessments.assessment,
results.user_id, results.a_id, results.marks
FROM users
INNER JOIN results on users.id = results.user_id
INNER join assessments on assessments.id = results.a_id
where assessments.id = results.a_id and users.id = '".$_SESSION['user_id']."'
")
?>
    <div class="p-5 mt-5">
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Assessments</th>
                        <th>Results</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        if(mysqli_num_rows($results)){
                        while($row = mysqli_fetch_array($results)){
                        ?>
                    <tr>
                        
                        <td><?php echo $row['assessment']?></td>
                        <td><?php echo $row['marks']?>%</td>
                       
                    </tr>
                    <?php } }else{
                        echo '<h6 class="alert alert-danger text-center mt-5">Please attempt assessments first to see your progress.</h6>';  
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
  <!-- ======= Footer ======= -->
  <?php include '../includes/footer.php';?>
</body>
</html>