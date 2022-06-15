<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$q = $_GET['q'];

$con = mysqli_connect('localhost','root','','poam');
$sql="SELECT * FROM users WHERE id = $q";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) { ?>

<input type="text" style="padding: 10px; width: 280px;" name="fname" value="<?php echo $row['Fname']?>">
<input type="text" style="padding: 10px; width: 280px;" name="lname" value="<?php echo $row['Lname']?>">
<input type="text" style="padding: 10px; width: 280px;" name="email" value="<?php echo $row['email']?>">
<input type="text" style="padding: 10px; width: 280px;" name="position" value="<?php echo $row['position']?>">
<textarea name="msg" id="" cols="40" rows="10" placeholder=" Type Your query..."></textarea>
<button type="submit" class="btn">SEND</button>

<?php }?>
</body>
</html>