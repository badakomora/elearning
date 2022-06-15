<?php session_start();?>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box
}

body {
    background-color: white;
}

.container {
    /* background: #1977cc; */
    color: black;
    border-radius: 10px;
    padding: 20px;
    font-family: 'Montserrat', sans-serif;
    max-width: 700px
}

.container>p {
    font-size: 32px
}

.question {
    width: 75%
}

.options {
    position: relative;
    padding-left: 40px
}

#options label {
    display: block;
    margin-bottom: 15px;
    font-size: 14px;
    cursor: pointer
}

.options input {
    opacity: 0
}

.checkmark {
    position: absolute;
    top: -1px;
    left: 0;
    height: 25px;
    width: 25px;
    /* background-color:#1977cc; */
    background:white;
    border: 2px solid #ddd;
    border-radius: 50%
}

.options input:checked~.checkmark:after {
    display: block
}

.options .checkmark:after {
    content: "";
    width: 10px;
    height: 10px;
    display: block;
    /* background: #1977cc; */
    background:black;
    position: absolute;
    top: 50%;
    left: 50%;
    border-radius: 50%;
    transform: translate(-50%, -50%) scale(0);
    transition: 300ms ease-in-out 0s
}

.options input[type="radio"]:checked~.checkmark {
    background: white;
    transition: 300ms ease-in-out 0s
}

.options input[type="radio"]:checked~.checkmark:after {
    transform: translate(-50%, -50%) scale(1)
}
@media(max-width:576px) {
    .question {
        width: 100%;
        word-spacing: 2px
    }
}
</style>
  <html>
    <body>
        <?php 
        include '../includes/conn.php';
        $id = $_GET['d'];
        $limit = 1;  
        if (isset($_GET["page"])) {
        $page  = $_GET["page"]; 
        } 
        else{ 
        $page=1;
        };  
        $start_from = ($page-1) * $limit; 
        $question = mysqli_query($con, "SELECT 
        assessments.id as aid, assessments.assessment,
        questions.id as qid, questions.question, questions.a_id, 
        answers.id as ans_id, answers.q_id, answers.answer1,answers.answer2,answers.answer3,answers.answer4,
        departments.id, departments.department 
        
        FROM departments 
        INNER JOIN assessments on departments.id = assessments.d_id
        INNER JOIN questions on assessments.id = questions.a_id 
        INNER JOIN answers on questions.id = answers.q_id where questions.a_id = $id LIMIT $start_from, $limit
        "); ?>
                      <?php 
                      $num = mysqli_num_rows($question);
                      if($num> 0){
                      while($quest = mysqli_fetch_array($question)){
                        
                          ?>
                   <div class="container-fluid" style="font-family:georgia;">
                       <div class="jumbotron p-5">
                            <div class="container mt-sm-5 my-1 shadow-lg bg-white rounded">
                                <div class="question ml-sm-5 pl-sm-5 pt-2">
                                    <div class="py-2 h5"><b>Q <?php echo $quest['qid']?>. <?php echo $quest['question']?></b></div>
                                    <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3" id="options">   
                                    <form action="../includes/sessionanswer.php?ansid=<?php echo $quest['ans_id']?>" method="post">
                                            <input type="hidden" name="id" value="<?php echo $quest['aid']?>">
                                            <label class="options"><?php echo $quest['answer1']?> <input type="radio" name="answer<?php echo $quest['ans_id'];?>" id="answer" value="<?php echo $quest['answer1']?>" > <span class="checkmark"></span> </label> 
                                            <label class="options"><?php echo $quest['answer2']?> <input type="radio" name="answer<?php echo $quest['ans_id'];?>" id="answer" value="<?php echo $quest['answer2']?>" > <span class="checkmark"></span> </label> 
                                            <label class="options"><?php echo $quest['answer3']?> <input type="radio" name="answer<?php echo $quest['ans_id'];?>" id="answer" value="<?php echo $quest['answer3']?>" > <span class="checkmark"></span> </label> 
                                            <label class="options"><?php echo $quest['answer4']?> <input type="radio" name="answer<?php echo $quest['ans_id'];?>" id="answer" value="<?php echo $quest['answer4']?>" > <span class="checkmark"></span> </label>
                                            <button class="btn btn-primary mt-2" id="<?php echo $id; ?>" name="submit" type="submit">Submit</button>
                                    </form>
                                    </div>
                                </div>
                                <hr>
                                <!-- pagination -->
                                <?php

                                   $result_db = mysqli_query($con,"SELECT COUNT($id) FROM questions where questions.a_id = $id "); 
                                   $row_db = mysqli_fetch_row($result_db);  
                                   $total_records = $row_db[0];  
                                   $total_pages = ceil($total_records / $limit); 
                                   /* echo  $total_pages; */
                                   $pagLink = "<ul class='pagination'>";  
                                   for ($i=1; $i<=$total_pages; $i++) {
                                                $pagLink .= "<li class='page-item'><a class='page-link' href='./?d=".$id."&page=".$i."'>".$i."</a></li>";	
                                   }
                                   echo $pagLink . "</ul>";  
                                ?>
                                <!-- end pagination -->
                            </div> 
                       </div>
                   </div>
                   <?php } }else{
                  echo '<h6 class="alert alert-danger text-center mt-5">There is no current assessment to assess.</h6>';  
                }
                ?>
            
  <!-- ======= Footer ======= -->
  <?php include '../includes/footer.php';?>


      </body>
  </html> 
