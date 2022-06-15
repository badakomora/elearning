<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- JavaScript plugins -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- jquery pligin -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <form action="../includes/addslides.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file[]" multiple>
        <input type="submit" name="submit">
    </form>


   



    <div class="container">
                                        <?php
                                        include '../includes/conn.php';
                                        $posts = mysqli_query($con, "SELECT id as pid, box FROM boxes");
                                        if (mysqli_num_rows($posts) > 0) {
                                        while ($row = mysqli_fetch_assoc($posts)) {?>
    <div class="card-body">
    <div class="carousel slide" id="carouselExampleIndicators<?php echo $row['pid']?>" data-bs-ride="carousel" data-bs-interval="false">                                           
    <div class="carousel-indicators">
    <?php
    $img = $row['box'];
    $images = explode(",", $img);
    
        $counter = 0;
        $contin = 1;
        foreach($images as $val){
    ?>
            <button type="button" data-bs-target="#carouselExampleIndicators<?php echo $row['pid']?>" data-bs-slide-to="<?= $counter ?>" <?php if ($counter==0){ ?>class="active"<?php } ?> aria-label="Slide <?= $contin ?>"></button>
        
                                            
    <?php
            $counter++;
            $contin++;
        }
    ?> 
    </div>
                                            
    <div class="carousel-inner">
                                                                                        <?php
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
                                                                                                    <iframe src="../includes/<?php echo $val; ?>" width="1000" height="1000" ></iframe>
                                                                                            </div>
                                                                                        <?php
                                                                                        $count++;
                                                                                        }
                                                                                        ?>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators<?php echo $row['pid']?>" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators<?php echo $row['pid']?>" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>

</div>


<div class="card-footer text-dark">
    <?php
foreach($images as $val){?>
<button class="btn btn-primary">Open <i class="fa fa-open"></i></button>   
<?php }?>
</div>
 </div>
 <?php }
            } else {
                echo "<center><h2 class='text-primary'>No slides</h3></center>";
            }
                ?>
</div>

</body>
</html>
