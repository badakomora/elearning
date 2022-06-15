<?php include '../header.php'; ?>
<?php
$user = $_GET['user'];
include '../../includes/conn.php';
$query = mysqli_query($con, "SELECT users.id, users.email, users.staff, 
mydepartment.user_id, mydepartment.d_id, departments.department, departments.id as did
FROM mydepartment
INNER JOIN users on users.id = mydepartment.user_id 
INNER JOIN departments on departments.id = mydepartment.d_id 
where users.email = '$user'");
?>
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
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">User</th>
                        <th scope="col">Staff</th>
                        <th scope="col">Department</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                   if(mysqli_num_rows($query) > 0){
                    while($row = mysqli_fetch_array($query)){ ?>
                        <tr>
                            <td><?php echo $row['email']?></td>
                            <td>
                                <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id'];?>">
                            Edit
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $row['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">update user profile</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../../includes/edituser.php" method="post">
                                    <div class="modal-body">
                                         <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Staff</label>
                                            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                            <input type="text" name="staff" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['staff']; ?>">
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
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-Success" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $row['id'];?>">
                                Edit
                                </button>

                                <!-- Modal -->
                            
                                <div class="modal fade" id="staticBackdrop<?php echo $row['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">update user Department</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="p-3">
                                        <p><?php echo $row['department']?></p>
                                   
                                        <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select New User Department
                                        </button>
                                        <?php 
                                        $departments = mysqli_query($con, "SELECT * FROM departments");
                                        ?>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <?php while($row = mysqli_fetch_array($departments)){?>
                                            <li>
                                            <form action="../../includes/updateenrol.php" method="post">
                                                <input type="hidden" name="d_id" value="<?php echo $row['id']?>">
                                                    <button class="dropdown-item btn btn-light" id="id<?php echo $row['id']?>"><?php echo $row['department']?></button>
                                                </form>
                                                </li>
                                                <script>
                                                    $('#id<?php echo $row['id']?>').click(function(){
                                                    alert("You are about to enroll user to <?php echo $row['department']?>");
                                                    });
                                                </script>
                                        <?php }?>
                                            </ul>
                                        </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                     
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </td>
                            <td>
                                <form action="../../includes/deleteuser.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php } }else{
                        echo '<h6 class="alert alert-danger text-center mt-5">There is no data here.</h6>';  
                        }?>
                    </tbody>
                </table>
</div>

</div>
</body>
</html>