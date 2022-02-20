<?php
require_once "connect.php";
session_start();
$student_id = $_POST["student_id"];

$sqlShow = "select * from new_student 
        where student_id = '$student_id'";
$resShow = mysqli_query($conn, $sqlShow);
$rowShow = mysqli_fetch_array($resShow);
$numRow = mysqli_num_rows($resShow);
if ($numRow > 0) {
    echo $rowShow["student_id"]." ".$rowShow["prefix"] . $rowShow["fname"] . " " . $rowShow["lname"];
} else {
    echo "รหัสนักเรียนไม่ถูกต้อง";
}
