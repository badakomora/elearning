<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Learn || staff e-learning</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  

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
          <li><a class="nav-link scrollto active">Hello, <?php echo $_SESSION["name"]; ?></a></li>
          <li><a class="nav-link scrollto active text-decoration-none">Enrol</a></li>
          <li class="dropdown"><a href="#" class="text-decoration-none"><span>Departments</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <?php 
              include '../includes/conn.php';
              $departments = mysqli_query($con, "SELECT * FROM departments");
              ?>
              <li><a href="#">Departments</a></li><hr>
              <?php while($row = mysqli_fetch_array($departments)){?>
              <li><a href="../updates/?d=<?php echo $row['id']; ?>" class="text-decoration-none"><?php echo $row['department'];?></a></li>
              <?php }?>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="../includes/logout.php" class="appointment-btn scrollto text-decoration-none">Sign Out</a>

    </div>
  </header><!-- End Header -->

<!-- Modal -->




<?php 
include '../includes/conn.php';
$results = mysqli_query($con, "SELECT 
users.id, 
departments.id, departments.department, 
mydepartment.id,mydepartment.d_id, mydepartment.user_id, 
assessments.id as aid, assessments.assessment, assessments.d_id 
FROM mydepartment 
INNER JOIN users on users.id = mydepartment.user_id 
INNER JOIN departments on departments.id = mydepartment.d_id 
INNER JOIN assessments on assessments.d_id = departments.id where mydepartment.user_id ='".$_SESSION['user_id']."'
")
?>



<div class="p-4 mt-5">
      <div class="container">
        <h2>Assessments</h2>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Assessment</th>
                <th scope="col">View</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            if (mysqli_num_rows($results) > 0) {
              while ($assess = mysqli_fetch_array($results)) { 
                $id = $assess['aid']; ?>
           
              <tr>
                <td><?php echo $assess['assessment']?></td>
                <td>
                  <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $id;?>">Assess</a> 
             
                    <script>
                      function openModal() {
                              $(document).ready(function(){
                                $("#staticBackdrop<?php echo $id;?>").modal();
                              });
                          }

                      function closeModal () {
                              $(document).ready(function(){
                                $("#staticBackdrop<?php echo $id;?>").modal('hide');
                              });  
                          }
                    </script>


                      <?php 
                      $limit = 1;  
                      if (isset($_GET["page"])) {
                        $page  = $_GET["page"]; 
                        } 
                        else{ 
                        $page=1;
                        };  
                      $start_from = ($page-1) * $limit; 
                      $question = mysqli_query($con, "SELECT 
                      assessments.id, assessments.assessment,
                      questions.id, questions.question, questions.a_id, 
                      departments.id, departments.department 
                      FROM departments 
                      INNER JOIN assessments on departments.id = assessments.d_id
                      INNER JOIN questions on assessments.id = questions.a_id where questions.a_id = $id ORDER BY $id ASC LIMIT $start_from, $limit
                                      "); ?>
                      <?php 
                          while($quest = mysqli_fetch_array($question)){ ?>

                        <div class="modal fade" id="staticBackdrop<?php echo $id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"><?php echo $quest['assessment']?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <P><?php echo $quest['question']?></P>  
                              </div>
                              <div class="modal-footer">
                              <ul class="pagination">
                    <?php 
					if(!empty($total_pages)){
						for($i=1; $i<=$total_pages; $i++){
								if($i == 1){
									?>
								<li class="pageitem active" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" data-id="<?php echo $i;?>" class="page-link" ><?php echo $i;?></a></li>
															
								<?php 
								}
								else{
									?>
								<li class="pageitem" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i;?>"><?php echo $i;?></a></li>
								<?php
								}
						}
					}
								?>
					</ul>

          <script>
              $(document).ready(function() {
                $("#staticBackdrop<?php echo $id;?>").load("pagination.php?page=1");
                $(".page-link").click(function(){
                  var id = $(this).attr("data-id");
                  var select_id = $(this).parent().attr("id");
                  $.ajax({
                    url: "pagination.php",
                    type: "GET",
                    data: {
                      page : id
                    },
                    cache: false,
                    success: function(dataResult){
                      $("#staticBackdrop<?php echo $id;?>").html(dataResult);
                      $(".pageitem").removeClass("active");
                      $("#"+select_id).addClass("active");
                      
                    }
                  });
                });
                });
</script>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>
                
                <?php } }else{
                  echo '<h6 class="alert alert-danger">There is no current evalution. check your department for more information.</h6>';  
                }
                ?>
                    </td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>





 
  <!-- ======= Footer ======= -->
  <?php include '../includes/footer.php';?>