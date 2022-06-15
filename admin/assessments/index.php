<?php include '../header.php'; ?>

  <!-- content -->
  <div class="area">
            <div class="container-fluid shadow-lg">
                <div class="top d-flex justify-content-between">
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
                   
                    <div class="assessment mt-2 p-1">
                    Hello, <?php echo $_SESSION['staff']?> 
                        <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add assessment</button>
                        <!-- departments modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Departments</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="../../includes/addassessment.php" method="post">
                                    <div class="modal-body">
                                    <?php  
                                    include '../../includes/conn.php';
                                    $query1 = mysqli_query($con, "SELECT * FROM  departments");
                                    while($row1 = mysqli_fetch_array($query1)){
                                    ?>
                                         <!-- add assessment modal that is inside the departments modal -->
                                         <div class="container mb-2">
                                          <a type="button" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $row1['id'];?>"><?php echo $row1['id'].'. '.$row1['department']?></a>
                                           
                                           <div class="modal fade" id="staticBackdrop<?php echo $row1['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Add assessment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="../../includes/addassessment.php" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                        <div class="mb-3">
                                                            <input type="hidden" name="id" value="<?php echo $row1['id'];?>">
                                                            <label for="exampleInputEmail1" class="form-label">Assessment Title</label>
                                                            <input type="text" name="assessment" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            <label for="exampleInputEmail1" class="form-label">Assessment Notes</label>
                                                            <input type="file" name="notes" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            
                                                            <div id="emailHelp" class="form-text">Please do not forget to add questions on the assessment.</div>
                                                        </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" type="submit" name="admin">Add</button>
                                                        </div>
                                                </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                    <?php }?>
                                    </div>
                            </form>
                            </div>
                          </div>
                          </div>
                    </div>
                </div>
            </div>

            <div class="container p-3">
                <?php 
                $limit = 6;  
                if (isset($_GET["page"])) {
                $page  = $_GET["page"]; 
                } 
                else{ 
                $page=1;
                };  
                $start_from = ($page-1) * $limit;
                $results = mysqli_query($con, "SELECT * FROM assessments ORDER BY id ASC LIMIT $start_from, $limit")
                ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Assessments</th>
                        <th scope="col">Add Questions</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if(mysqli_num_rows($results)> 0){
                    while ($row2 = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td><?php echo $row2['assessment']?></td>
                        <td>
                         <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row2['id'];?>">
                            Add Questions
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $row2['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $row2['assessment']?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../../includes/addquestions.php" method="post">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                        <h6>Note: You Can Add Upto 15 questions Only</h6>
                                            <input type="hidden" name="id" id="" value="<?php echo $row2['id']; ?>">
                                            <textarea name="question" cols="63" rows="2" placeholder="Enter question here"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Option 1:</label>
                                            <input type="text" name="answer1" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Option 2:</label>
                                            <input type="text" name="answer2" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Option 3:</label>
                                            <input type="text" name="answer3" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Option 4:</label>
                                            <input type="text" name="answer4" class="form-control" id="recipient-name">
                                        </div>

                                        <label for="recipient-name" class="col-form-label">Correct Answer</label>
                                                <select class="form-select" aria-label="Default select example" name="answer">
                                                <option selected>Select Correct Answer</option>
                                                <option value="1">Option One</option>
                                                <option value="2">Option Two</option>
                                                <option value="3">Option Three</option>
                                                <option value="4">Option Four</option>
                                                </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="admin">Submit</button>
                                    </div> 
                                   </div>
                                </form>
                                </div>
                            </div>
                            </div>
                         
                        </td>
                        <td>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-Success" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $row2['id'];?>">
                                Edit
                                </button>

                                <!-- Modal -->
                            
                                <div class="modal fade" id="staticBackdrop<?php echo $row2['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Assessment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="../../includes/editassessment.php" method="POST">
                                    <div class="modal-body">
                                    <input type="hidden" name="id" value="<?php echo $row2['id'];?>">
                                    <input type="text" class="form-control" name="assessment" value="<?php echo $row2['assessment']?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                                </div>

                        </td>
                        <td>
                            <form action="../../includes/deleteassessment.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row2['id'];?>">
                                <button class="btn btn-danger" name="admin" type="submit">Delete</button>
                            </form>
                        </td>
                    <?php } }else{
                        echo '<h6 class="alert alert-danger text-center mt-5">There is no data here.</h6>';  
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>

                <div class="container">
                                <!-- pagination -->
                                <?php
                                   
                                   $result_db = mysqli_query($con,"SELECT COUNT(*) FROM assessments"); 
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
        </div>

</div>

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

</body>
</html>
