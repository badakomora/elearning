<?php
                                        include '../includes/conn.php';
                                        $posts = mysqli_query($con, "SELECT id as pid, box FROM boxes");
                                        if (mysqli_num_rows($posts) > 0) {
                                        while ($row = mysqli_fetch_assoc($posts)) {?>
<br/><br/>
<iframe src="../includes/<?php echo $row['box'] ?>" width="100%" height="100%">
</iframe>
<?php }}
?>