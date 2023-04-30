<?php

include 'functions.php';

$comment = " log out at ";
$id = $_SESSION["admin_id"];
$date = date("Y-m-d h:i:sa");
$log_query = mysqli_query($db, "INSERT INTO log (adminID,  time, logComment) VALUES ('$id', '$date', '$comment')");

session_start();
session_unset();
session_destroy();

header('location:login.php');

?>