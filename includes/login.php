
    <?php
    session_start();
    if (isset($_POST['submit'])) {
   
    include 'conn.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = mysqli_query($con, "SELECT * FROM users where email='$email' and password='$password'");
    $row  = mysqli_fetch_array($sql);
    if (is_array($row)) {
        $_SESSION["email"] = $row['email'];
        $_SESSION["Fname"] = $row['Fname'];
        $_SESSION["Lname"] = $row['Lname'];
        $_SESSION["name"] = $row['name'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['staff'] = $row['staff'];

        //comment for future reference
        
        $row['staff'] == 0 ? 
        header("Refresh: 0, ../faculty/"):header("Refresh: 0, ../view/");
        $msg = "Access Granted!";
        echo "<script type='text/javascript'>alert('$msg');</script>";


    } else {
        $msg2 = "Invalid Credentials! Please Try Again.";
        echo "<script type='text/javascript'>alert('$msg2');</script>";
        header("Refresh: 0, ../");
    }
}

?>