<?php include '../header.php'; ?>

        <!-- content -->
        <div class="area">
            <div class="container-fluid shadow-lg">
                <div class="top d-flex">
                    <div class="">
                        <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
                    </div>
                    <div class="logo text-primary">
                       <h1>Learn</h1> 
                    </div>
                </div>
            </div>

            <div class="container p-4">
                <?php 
                $limit = 5;  
                if (isset($_GET["page"])) {
                $page  = $_GET["page"]; 
                } 
                else{ 
                $page=1;
                };  
                $start_from = ($page-1) * $limit;
                include '../../includes/conn.php';
                $query1 = mysqli_query($con, "SELECT * FROM  questions ORDER BY id ASC LIMIT $start_from, $limit");
               ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Questions</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                   if(mysqli_num_rows($query1) > 0){
                    while($row2 = mysqli_fetch_array($query1)){ ?>
                    <tr>
                        <td><?php echo $row2['question']?></td>
                        <td>
                           <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $row2['id'];?>">
                            Edit
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop<?php echo $row2['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit question</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../../includes/editquestion.php" method="post">
                                    <div class="modal-body">
                                    <div class="mb-3">
                                            <input type="hidden" name="id" value="<?php echo $row2['id'];?>">
                                            <label for="recipient-name" class="col-form-label">Question:</label>
                                            <textarea name="question" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"><?php echo $row2['question']; ?></textarea>
                                            <label for="recipient-name" class="col-form-label">Option 1:</label>
                                            <input type="text" class="form-control" name="ch1" value="<?php echo $row2['choice1'];?>">
                                            <label for="recipient-name" class="col-form-label">Option 2:</label>
                                            <input type="text" class="form-control" name="ch2" value="<?php echo $row2['choice2'];?>">
                                            <label for="recipient-name" class="col-form-label">Option 3:</label>
                                            <input type="text" class="form-control" name="ch3" value="<?php echo $row2['choice3'];?>">
                                            <label for="recipient-name" class="col-form-label">Option 4:</label>
                                            <input type="text" class="form-control" name="ch4" value="<?php echo $row2['choice4'];?>">
                                            <label for="recipient-name" class="col-form-label">Correct Answer</label>
                                                <select class="form-select" aria-label="Default select example" name="answer">
                                                <option selected>Select Correct Answer</option>
                                                <option value="1">Option One</option>
                                                <option value="2">Option Two</option>
                                                <option value="3">Option Three</option>
                                                <option value="4">Option Four</option>
                                                </select>
                                            <div id="emailHelp" class="form-text">Please do not forget to add assessments.</div>
                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" name="admin" type="submit">Update</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                            
                        </td>
                        <td>
                            <form action="../../includes/deletequestion.php" method="post">
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
                                   
                                   $result_db = mysqli_query($con,"SELECT COUNT(*) FROM questions"); 
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
</body>
</html>