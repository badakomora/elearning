<?php
session_start();
header("location:../");
unset($_SESSION["email"]);
session_destroy($_SESSION["email"]);
?>