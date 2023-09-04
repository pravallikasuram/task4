<?php

include('bootstrap.php');

session_start();

include('db.php');

$connection = mysqli_connect('localhost','root','','task3');



session_destroy();
header("Location: index.php");
exit();
?>
