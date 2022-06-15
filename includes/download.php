<?php
if (!empty($_GET['file'])) {


    $filename = basename($_GET['file']);
    $filepath =  "slides/" . $filename;

    if (!empty($filename) && file_exists($filepath)) {

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename =' . basename($filename));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        ob_clean();
        flush();
        readfile($filename);
        exit;
    }
}else{
    $msg2 = "No Data Found!";
    echo "<script type='text/javascript'>alert('$msg2');</script>";
    header("Refresh: 0, ../view/");
}
