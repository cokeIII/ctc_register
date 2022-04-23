<?php
require_once "connect.php";
session_start();
$student_id = $_POST["student_id"];

$sqlS = "select * from new_student where student_id = '$student_id' and status_std = '1'";
$resS = mysqli_query($conn, $sqlS);
$numRowS = mysqli_num_rows($resS);
if ($numRowS > 0) {
    $sqlC = "select * from register r
    left join new_student s on s.student_id = r.student_id
    where r.student_id = '$student_id'";

    $resC = mysqli_query($conn, $sqlC);
    $row = mysqli_fetch_array($resC);
    $numRow = mysqli_num_rows($resC);
    if ($numRow > 0) {
        $data = [];
        $data["student_id"] = $row["student_id"];
        $data["prefix"] = $row["prefix"];
        $data["fname"] = $row["fname"];
        $data["lname"] = $row["lname"];
        $data["major"] = $row["major"];
        $data["minor"] = $row["minor"];
        $data["system"] = $row["system"];
        $data["no"] = $row["no"];
        $data["level"] = $row["level"];
        $data["pass"] = "ผ่านขั้นตอน " . $row["pass"] . " เรียบร้อยแล้ว";
        $data["status_color"] = "text-success";
        $data["error"] = 0;
        echo json_encode($data);
    } else {
        if ($pass == 1) {
        } else {
            $sqlC = "select * from  new_student
    where student_id = '$student_id'";
            $resC = mysqli_query($conn, $sqlC);
            $row = mysqli_fetch_array($resC);
            $data = [];
            $data["student_id"] = $row["student_id"];
            $data["prefix"] = $row["prefix"];
            $data["fname"] = $row["fname"];
            $data["lname"] = $row["lname"];
            $data["major"] = $row["major"];
            $data["minor"] = $row["minor"];
            $data["system"] = $row["system"];
            $data["no"] = $row["no"];
            $data["level"] = $row["level"];
            $data["pass"] = "ขั้นตอนไม่ถูกต้อง ยังไม่ผ่านขั้นตอนที่1";
            $data["status_color"] = "text-warning";
            $data["error"] = 0;
            echo json_encode($data);
        }
    }
} else {
    $data = [];
    $data["error"] = "รหัสไม่มีอยู่ในระบบ";
    $data["status_color"] = "text-danger";
    echo json_encode($data);
}
