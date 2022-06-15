<?php include '../header.php';?>
<?php include '../includes/sessions.php';?>
<div class="container-fluid"><br>
         <?php include '../includes/feedback.php';?>
         <div class="row">
        
            <!-- spacing -->
            <div class="col-lg-1">
           
            </div>
            <!-- Post section
            ===================================================================== -->
           <?php
                                        
                                        $posts = mysqli_query($con, "SELECT posts.id as pid, posts.title, posts.text, posts.image, posts.file, posts.posted , posts.user_id, 
                                        users.Fname as FnameF, users.Lname as LnameL, users.profile as pro, users.position as pos, users.id, users.assembly as asse
                                        FROM users 
                                        inner join  posts on users.id =  posts.user_id order by posts.id desc
                                        ");
                                        $t = 0;
                                        if (mysqli_num_rows($posts) > 0) {
                                        while ($row = mysqli_fetch_assoc($posts)) {
                                            $t++;?>
                            <?php if ($t == 1){?>
                            <div class="col-lg-7">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <div class=".profile" style="display: flex;">
                                                        <img class="m-2" src="../profiles/<?php echo $row['pro'] ?>" height="45" width="43" alt="" style="border-radius: 50%;">
                                                        <P class="m-2"><b><?php echo $row['FnameF']; ?> <?php echo $row['LnameL']; ?> </b><br> <?php echo $row['pos']; ?>, <?php echo $row['asse']; ?></P>
                                            <i class="bars"></i>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="carousel slide" id="carouselExampleIndicators" data-bs-ride="carousel" data-bs-interval="false">                        
                                            <div class="carousel-inner">
                                                                                        <?php
                                                                                        $img = $row['image'];
                                                                                        $images = explode(",", $img);
                                                                                        $count = 0;
                                                                                        foreach($images as $val){
                                                                                        ?>
                                                                                            <div class="carousel-item <?php 
                                                                                                if($count==0){
                                                                                                echo "active";  
                                                                                                }
                                                                                                else{
                                                                                                    echo "";
                                                                                                }
                                                                                            ?>">
                                                                                                    <embed class="card-img-top" src="../includes/<?php echo $val; ?>" scrolling="no" autoplay="false" autostart="false" muted preload="metadata" controls></embed>
                                                                                            </div>
                                                                                        <?php
                                                                                        $count++;
                                                                                        }
                                                                                        ?>
                                                                                         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
                                            </div>
                                            </div>
                                                <h2 class="card-title text-primary"><?php echo $row['title']; ?></h2>
                                                <p class="show-read-more"><?php echo $row['text']; ?></p>

                                                <button class="btn btn-danger" id="commentbtn<?php echo $row['pid'] ?>">comment <i class="fa fa-comment"></i></button>
                                                <a href="../includes/download.php?file=<?php echo $row['file'] ?>" class="btn btn-primary">Download <i class="fa fa-download"></i></a>   
                                                <script>
                                                $(document).ready(function() {
                                                    var maxLength = 100;
                                                    $(".show-read-more").each(function() {
                                                        var myStr = $(this).text();
                                                        if ($.trim(myStr).length > maxLength) {
                                                            var newStr = myStr.substring(0, maxLength);
                                                            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                                                            $(this).empty().html(newStr);
                                                            $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
                                                            $(this).append('<span class="more-text">' + removedStr + '</span>');
                                                        }
                                                    });
                                                    $(".read-more").click(function() {
                                                        $(this).siblings(".more-text").contents().unwrap();
                                                        $(this).remove();
                                                    });
                                                });
                                                </script>
                                        </div>
                                    </div>
                                    <div class="card-footer text-dark">
                                        Posted on  <?php echo $row['posted']; ?>
                                    </div>
                                    
                                    
                                    <!-- End of posts section
                                    ===================================================================== -->
                                    <style>
                                        .show-read-more .more-text{
                                            display: none;
                                        }
                                        @media (max-width: 600px) {
                                          .chat .container .card{
                                          position:relative;
                                          }
                                        }
                                        @media (max-width: 600px) {
                                          .card-img-top{
                                            display:block;
                                          }
                                        }
                                    </style>
                                    <script>
                                                $(document).ready(function() {
                                                    $("#comments<?php echo $row['pid'] ?>").hide();
                                                    $("#commentbtn<?php echo $row['pid'] ?>").click(function() {
                                                        $("#comments<?php echo $row['pid'] ?>").toggle();
                                                    });
                                                });
                                    </script>


                                    <!-- comment section
                                    ===================================================================== -->
                                    <div class="container p-2" id="comments<?php echo $row['pid'] ?>">
                                            <div class="head pt-1">
                                                <h2 class="p-2 text-black">comments</h2>
                                            </div>
                                            <?php
                                            $pid = $row['pid'];
                                            $comments = mysqli_query($con, "SELECT comments.id, comments.post_id, comments.user_id, comments.comment, comments.posted as poste, users.Fname as Fnamef,  users.Lname as Lnamel, users.profile as prof, users.position as posi, users.assembly as assem
                                            FROM users 
                                            inner join  comments on users.id =  comments.user_id where $pid = comments.post_id
                                            ");
                                            ?>
                                            <div class="container pb-3">
                                                <form action="../includes/comments.php" method="POST">
                                                    <div class="commentdiv" style="display: flex; padding-bottom:3px">
                                                        <input type="hidden" name="id" value="<?php echo $pid ?>">
                                                        <img src="../profiles/<?php echo  $_SESSION['profile'];?>" height="45" width="40" alt="" style="border-radius: 50%; margin:1px">
                                                        <input type="text" name="comment" placeholder="Add a Comment" style="margin:1px; width:200px"><br>
                                                        <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
                                                    </div>
                                                </form>
                                                <?php while ($row1 = mysqli_fetch_array($comments)) { ?>

                                        <!-- comments Below
                                        ===================================================================== -->

                                                    <div class="container p-2" id="comments<?php echo $row1['post_id']; ?>">
                                                        <div class="container p-2">
                                                            <div class="profile" style="display: flex;">
                                                                <img src="../profiles/<?php echo $row1['prof'] ?>" height="45" width="40" alt="" style="border-radius: 50%;">
                                                                <P class="m-2"><b><?php echo $row1['Fnamef']; ?> <?php echo $row1['Lnamel']; ?> </b><br> <?php echo $row1['posi']; ?>, <?php echo $row1['assem']; ?></P>
                                                            </div>
                                                            <p><?php echo $row1['comment']; ?><br> Posted on <?php echo $row1['poste']; ?> </p>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                        </div>    
                                        <?php
                        $t == 0;
                    } else {
                        ?>

                                    <div class="card mt-2">
                                        <div class="card-header bg-light">
                                            <div class="profile" style="display: flex;">
                                                        <img class="m-2" src="../profiles/<?php echo $row['pro'] ?>" height="45" width="43" alt="" style="border-radius: 50%;">
                                                        <P class="m-2"><b><?php echo $row['FnameF']; ?> <?php echo $row['LnameL']; ?> </b><br> <?php echo $row['pos']; ?>, <?php echo $row['asse']; ?></P>
                                            <i class="bars"></i>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="carousel slide" id="carouselExampleIndicators" data-bs-ride="carousel" data-bs-interval="false">                        
                                            <div class="carousel-inner">
                                                                                        <?php
                                                                                        $img = $row['image'];
                                                                                        $images = explode(",", $img);
                                                                                        $count = 0;
                                                                                        foreach($images as $val){
                                                                                        ?>
                                                                                            <div class="carousel-item <?php 
                                                                                                if($count==0){
                                                                                                echo "active";  
                                                                                                }
                                                                                                else{
                                                                                                    echo "";
                                                                                                }
                                                                                            ?>">
                                                                                                    <embed class="card-img-top" src="../includes/<?php echo $val; ?>" scrolling="no" autoplay="false" autostart="false" muted preload="metadata" controls></embed>
                                                                                            </div>
                                                                                        <?php
                                                                                        $count++;
                                                                                        }
                                                                                        ?>
                                                                                         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>       
                                            </div>
                                            </div>
                                                <h2 class="card-title text-primary"><?php echo $row['title']; ?></h2>
                                                <p class="show-read-more"><?php echo $row['text']; ?></p>

                                                <button class="btn btn-danger" id="commentbtn<?php echo $row['pid'] ?>">comment <i class="fa fa-comment"></i></button>
                                                <a href="../includes/download.php?file=<?php echo $row['file'] ?>" class="btn btn-primary">Download <i class="fa fa-download"></i></a>   
                                        </div>
                                    </div>
                                    <div class="card-footer text-dark">
                                        Posted on  <?php echo $row['posted']; ?>
                                    </div>
                                    
                                    
                                    <!-- End of posts section
                                    ===================================================================== -->
                                    
                                    <script>
                                                $(document).ready(function() {
                                                    $("#comments<?php echo $row['pid'] ?>").hide();
                                                    $("#commentbtn<?php echo $row['pid'] ?>").click(function() {
                                                        $("#comments<?php echo $row['pid'] ?>").toggle();
                                                    });
                                                });
                                    </script>


                                    <!-- comment section
                                    ===================================================================== -->
                                    <div class="container p-2" id="comments<?php echo $row['pid'] ?>">
                                            <div class="head pt-1">
                                                <h2 class="p-2 text-black">comments</h2>
                                            </div>
                                            <?php
                                            $pid = $row['pid'];
                                            $comments = mysqli_query($con, "SELECT comments.id, comments.post_id, comments.user_id, comments.comment, comments.posted as poste, users.Fname as Fnamef,  users.Lname as Lnamel, users.profile as prof, users.position as posi, users.assembly as assem
                                            FROM users 
                                            inner join  comments on users.id =  comments.user_id where $pid = comments.post_id
                                            ");
                                            ?>
                                            <div class="container pb-3">
                                                <form action="../includes/comments.php" method="POST">
                                                    <div class="commentdiv" style="display: flex; padding-bottom:3px">
                                                        <input type="hidden" name="id" value="<?php echo $pid ?>">
                                                        <img src="../profiles/<?php echo  $_SESSION['profile'];?>" height="45" width="40" alt="" style="border-radius: 50%; margin:1px">
                                                        <input type="text" name="comment" placeholder="Add a Comment" style="margin:1px; width:200px"><br>
                                                        <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
                                                    </div>
                                                </form>
                                                <?php while ($row1 = mysqli_fetch_array($comments)) { ?>

                                        <!-- comments Below
                                        ===================================================================== -->

                                                    <div class="container p-2" id="comments<?php echo $row1['post_id']; ?>">
                                                        <div class="container p-2">
                                                            <div class="profile" style="display: flex;">
                                                                <img src="../profiles/<?php echo $row1['prof'] ?>" height="45" width="40" alt="" style="border-radius: 50%;">
                                                                <P class="m-2"><b><?php echo $row1['Fnamef']; ?> <?php echo $row1['Lnamel']; ?> </b><br> <?php echo $row1['posi']; ?>, <?php echo $row1['assem']; ?></P>
                                                            </div>
                                                            <p><?php echo $row1['comment']; ?><br> Posted on <?php echo $row1['poste']; ?> </p>
                                                        </div>  
                                                    </div>
                                                    <?php } ?>
                                            </div>
                                    </div>
                                   
                                    <?php
                    }
                }
                if ($t < 1) {
                        ?>    
                        
                        
                    </div>


                    <?php }
            } else {
                echo "<center><h2 class='text-primary'>No News Updates</h3></center>";
            }
                ?>
                         
                        
         </div>
         <div class="col-lg-4 chat">
            <div class="container position-relative">
            <div class="card position-fixed">
                    <div class="card-header">
                        <p class="text-center">Join Public Chat</p>
                    </div>
                    <div class="card-body">
                        <div class="container">
                        <?php include'../chat/index.php'; ?>
                        </div>
                    
                    </div>
                </div>
            </div>   
        </div>
        <?php include '../includes/footer.php'; ?>

    </div>
</body>
</html>