<html>  
<body>  
   <form action="" method="post" enctype="multipart/form-data">  
   <div style="width:200px;border-radius:6px;margin:0px auto">  
<table border="1">  
   <tr>  
      <td colspan="2">Select Technolgy:</td>  
   </tr>  
   <tr>  
      <td>PHP</td>  
      <td><input type="checkbox" name="techno[]" value="PHP"></td>  
   </tr>  
   <tr>  
      <td>.Net</td>  
      <td><input type="checkbox" name="techno[]" value=".Net"></td>  
   </tr>  
   <tr>  
      <td>Java</td>  
      <td><input type="checkbox" name="techno[]" value="Java"></td>  
   </tr>  
   <tr>  
      <td>Javascript</td>  
      <td><input type="checkbox" name="techno[]" value="javascript"></td>  
   </tr>  
   <tr>  
      <td colspan="2" align="center"><input type="submit" value="submit" name="sub"></td>  
   </tr>  
</table>  
</div>  
</form>  
<?php  
if(isset($_POST['sub']))  
{  
$host="localhost";//host name  
$username="root"; //database username  
$word="";//database word  
$db_name="testing_db";//database name  
$tbl_name="request_quote"; //table name  
$con=mysqli_connect("$host", "$username", "$word","$db_name")or die("cannot connect");//connection string  

$checkbox1=$_POST['techno'];  
$chk="";  
foreach($checkbox1 as $chk1)  
   {  
      $chk .= $chk1.",";  
   }  
$in_ch=mysqli_query($con,"insert into boxes(box) values ('$chk')");  
if($in_ch==1)  
   {  
      echo'<script>alert("Inserted Successfully")</script>';  
   }  
else  
   {  
      echo'<script>alert("Failed To Insert")</script>';  
   }  
}  
?>  
</body>  
</html>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html>
<head>

<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
  <meta charset="utf-8">
  <title>JS Bin</title>
</head>
<body>

  <div style="width:300px;height:400px" <table id="dataTbl">
            <tr>
                <td><input type='checkbox' id='chkVerify' name='chkVerify' value='Item1'></td>
                <td>Item 1</td>
            </tr>
            <tr>
                <td><input type='checkbox' id='chkVerify' name='chkVerify' value='Item2'></td>
                <td>Item 2</td>
            </tr>
            <tr>
                <td><input type='checkbox' id='chkVerify' name='chkVerify' value='Item3'></td>
                <td>Item 3</td>
            </tr>
        </table>
        <button type="button" class="deletebutton" name="delete_video" title="Show Selected Value" onclick="DelRow();">Show Selected Value</button>

  
</body>
</html> 



<script>
    

 function DelRow(){
                var checkboxValArry=[];
                var $chkbox_checked    = $('input[type="checkbox"]:checked');
                 if($chkbox_checked.length === 0){
                    alert("No Row Selected");
                 }

                 else{
                   
                   var checkboxValArry = $chkbox_checked.map(function(){
                       return this.value;
                   }).get();;
                    console.log(checkboxValArry); 
                 }

            }

$(function() {
   
  
  
});
</script>
</body>
</html>