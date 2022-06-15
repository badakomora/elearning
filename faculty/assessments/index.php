<?php include '../header.php'; ?>
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

                    <div class="assessment mt-2 p-1">
                        Hello, <?php echo $_SESSION['name']?> 
                        
                        <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add assessment</button>
                                           
                        <?php  
                                    include '../../includes/conn.php';
                                    $query1 = mysqli_query($con, "SELECT 
                                    users.id, 
                                    departments.id as did, departments.department, 
                                    mydepartment.id ,mydepartment.d_id, mydepartment.user_id
                                    FROM mydepartment 
                                    INNER JOIN users on users.id = mydepartment.user_id 
                                    INNER JOIN departments on departments.id = mydepartment.d_id where mydepartment.user_id = '".$_SESSION['user_id']."'");
                                    while($row1 = mysqli_fetch_array($query1)){
                                    ?>


                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Add assessment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="../../includes/addassessment.php" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                        <div class="mb-3">
                                                            <input type="hidden" name="id" value="<?php echo $row1['did'];?>">
                                                            <label for="exampleInputEmail1" class="form-label">Assessment Title</label>
                                                            <input type="text" name="assessment" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            <label for="exampleInputEmail1" class="form-label">Assessment Notes</label>
                                                            <input type="file" name="notes" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            
                                                            <div id="emailHelp" class="form-text">Please do not forget to add questions on the assessment.</div>
                                                        </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" type="submit" name="faculty">Add</button>
                                                        </div>
                                                </form>
                                                </div>
                                            </div>
                                            </div>            
                    </div>
                </div>
            </div>






<div class="container">
                        <div class="">

                        
                        <?php 

                        $limit = 6;  
                        if (isset($_GET["page"])) {
                        $page  = $_GET["page"]; 
                        } 
                        else{ 
                        $page=1;
                        };  
                        $start_from = ($page-1) * $limit;
                        $results = mysqli_query($con, "SELECT 
                        departments.id as did, departments.department, 
                        assessments.id as aid, assessments.assessment, assessments.d_id 
                        FROM assessments
                        INNER JOIN departments on departments.id = assessments.d_id where assessments.d_id ='".$row1['did']."'  ORDER BY aid ASC LIMIT $start_from, $limit")
                        ?>

                            <table class="table table-striped">
                            <h3>Assessments</h3>
                            <hr>
                            <thead>
                            <tr>
                                <th scope="col">Assessments</th>
                                <th scope="col">Add Questions</th>
                                <th scope="col">Action</th>
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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row2['aid'];?>">
                                    Add Questions
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $row2['aid'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $row2['assessment']?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="../../includes/addquestions.php" method="post">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                <h6 class="text-danger">Note: You Can Add Upto 15 questions Only</h6>
                                                    <input type="hidden" name="id" id="" value="<?php echo $row2['aid']; ?>">
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
                                                <button type="submit" class="btn btn-primary" name="faculty">Submit</button>
                                            </div> 
                                            </div>
                                            </form>
                                        </div>
                                        </div>

                                            </td>
                                            <td> 

                                                <form action="../../includes/deleteassessment.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $row2['aid'];?>">
                                                <button class="btn btn-danger" name="faculty" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        
                                        </tr>
                                        <?php } } else{
                                        echo '<h6 class="alert alert-danger text-center mt-5">There is no data here.</h6>';  
                                        }
                                    ?>



        
                                    </tbody>
                                </table>


                                

                                <div class="container">
                                                <!-- pagination -->
                                                <?php
                                                
                                                $result_db = mysqli_query($con,"SELECT COUNT(*) FROM assessments where assessments.d_id ='".$row1['did']."' "); 
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
            

        <?php }?>
 
         
</div>
</div>















 <!-- ======= Footer ======= -->
 <?php include '../../includes/footer.php';?>

</body>
</html>