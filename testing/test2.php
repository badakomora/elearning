<?php  
$servername='localhost';
$username='root';
$password='';
$dbname = "poam";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
$limit = 1;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $limit;  
$result = mysqli_query($conn,"SELECT * FROM users ORDER BY id ASC LIMIT $start_from, $limit");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<table class="table table-bordered table-striped">  
<thead>  
<tr>  
<th>userid</th>  
<th>First name</th>
<th>Last name</th>
 <th>City name</th>
<th>email</th> 
</tr>  
<thead>  
<tbody>  
<?php  
while ($row = mysqli_fetch_array($result)) {  
?>  
            <tr>  
				<td><?php echo $row["id"]; ?></td>  
				<td><?php echo $row["Fname"]; ?></td>
				<td><?php echo $row["Lname"]; ?></td>
				<td><?php echo $row["name"]; ?></td>
				<td><?php echo $row["email"]; ?></td>			
            </tr>  
<?php  
};  
?>  
</tbody>  
</table>  
<?php  

$result_db = mysqli_query($conn,"SELECT COUNT(id) FROM users "); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?page=".$i."'>".$i."</a></li>";	
}
echo $pagLink . "</ul>";  
?>

</body>
</html>





                         <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add assessment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="../includes/addassessment.php" method="post">
                                    <div class="modal-body">
                                   
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Add</button>
                                    </div>
                            </form>
                            </div>
                          </div>
                          </div>







                          <div class="container">
                                          <a type="button" class="text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $row2['id'].' '. $row2['id'];?>"><?php echo $row2['department']?></a>
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
                                           <div class="modal fade" id="staticBackdrop<?php echo $row2['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Add assessment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="../includes/addassessment.php" method="post">
                                                        <div class="modal-body">
                                                    
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" type="submit">Add</button>
                                                        </div>
                                                </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>






















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