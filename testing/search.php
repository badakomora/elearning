<?php
         require_once 'php/includes/config.php';
         if (isset($_POST['submit'])){

         $search = $_POST['search'];

         
        //code...
        $sql="SELECT * FROM products where (gender LIKE '%" . $_POST["search"] . "%') OR (productname LIKE '%" . $_POST["search"] . "%') OR (productinfo LIKE '%" . $_POST["search"] . "%')OR (price LIKE '%" . $_POST["search"] . "%') OR (wear LIKE '%" . $_POST["search"] . "%') ";
        $stmt = $DBH->prepare($sql);
        $stmt->execute();
        $total = $stmt->rowCount();
        
      }
      else{
        $sql="SELECT * FROM products ";
        $stmt = $DBH->prepare($sql);
        $stmt->execute();
        $total = $stmt->rowCount();
      }
      
    ?>