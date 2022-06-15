<?php include '../header.php'; ?>


        <!-- content -->
        <div class="area">
            <div class="d-flex justify-content-between bg-white shadow-lg p-3">

                <div>
                    <div class="container d-flex">
                        <div class="close">
                            <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
                        </div>
                        <div class="logo text-primary">
                            <h1>Learn</h1> 
                        </div>
                    </div>
                </div>
                
                <div class="mt-2">
                    <div class="departments">
                        Hello, <?php echo $_SESSION['staff']?> 
                        <button class="btn btn-primary "  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Department</button>
                        <!-- departments modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Departments</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="../../includes/adddepartment.php" method="post">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Department name</label>
                                            <input type="text" name="department" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                             <div id="emailHelp" class="form-text">Please do not forget to add assessments.</div>
                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Add</button>
                                    </div>
                            </form>
                            </div>
                          </div>
                          </div>
                    </div>
                </div>
            </div>

            <div class="container p-4">
                <?php 
                $limit = 6;  
                if (isset($_GET["page"])) {
                $page  = $_GET["page"]; 
                } 
                else{ 
                $page=1;
                };  
                $start_from = ($page-1) * $limit;
                include '../../includes/conn.php';
                $query1 = mysqli_query($con, "SELECT * FROM  departments ORDER BY id ASC LIMIT $start_from, $limit");
               ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Departments</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                   if(mysqli_num_rows($query1) > 0){
                    while($row2 = mysqli_fetch_array($query1)){ ?>
                    <tr>
                        <td><?php echo $row2['department']?></td>
                        <td>
                           <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row2['id'];?>">
                            Edit
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $row2['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $row2['department']?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../../includes/editdepartment.php" method="post">
                                    <div class="modal-body">
                                         <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Department name</label>
                                            <input type="hidden" name="id" value="<?php echo $row2['id'];?>">
                                            <input type="text" name="department" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row2['department']; ?>">
                                            <div id="emailHelp" class="form-text">Please do not forget to add assessments.</div>
                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                            
                        </td>
                        <td>
                            <form action="../../includes/deletedepartment.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row2['id'];?>">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            
                        </td>
                    <?php } }else{
                        echo '<h6 class="alert alert-danger text-center mt-5">There is no Data here!.</h6>';  
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>

                <div class="container">
                                <!-- pagination -->
                                <?php
                                   
                                   $result_db = mysqli_query($con,"SELECT COUNT(*) FROM departments"); 
                                   $row_db = mysqli_fetch_row($result_db);  
                                   $total_records = $row_db[0];  
                                   $total_pages = ceil($total_records / $limit); 
                                   /* echo  $total_pages; */
                                   $pagLink = "<ul class='pagination'>";  
                                   for ($i=1; $i<=$total_pages; $i++) {
                                                $pagLink .= "<li class='page-item'><a class='page-link' href='./?page=".$i."'>".$i."</a></li>";	
                                   }
                                   echo $pagLink . "</ul>";  
                                ?>
                                <!-- end pagination -->
                </div>
            </div>


           <!-- ======= Footer ======= -->
           <?php include '../../includes/footer.php';?>





           
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
</div>
</body>
</html>