<?php
require_once "connect.php";
session_start();
$pic = $_POST["pic"];
$student_id = $_POST["student_id"];
$sql = "update register set pic = '$pic' where student_id ='$student_id'";
mysqli_query($conn, $sql);
