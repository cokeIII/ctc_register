<?php require_once "connect.php";
session_start();
$people_id = $_SESSION["people_id"];
$id = $_POST["id"];
$sql = "delete from register where student_id = '$id'";
$res = mysqli_query($conn, $sql);
if ($res) {
    header("location: list_register.php");
} else {
    echo $sql;
}
$sqlLog = "insert into log_data (people_id,student_id,pass) values('$people_id','$id','0')";
mysqli_query($conn, $sqlLog);
