<?php
require_once "connect.php";
session_start();
$people_id = $_SESSION["people_id"];
if (!empty($_POST["pass"]) && !empty($_POST["student_id"])) {
    $pass = $_POST["pass"];
    $student_id = $_POST["student_id"];
    $sqlC = "select * from register r
    left join new_student s on s.student_id = r.student_id
    where r.student_id = '$student_id'";

    $resC = mysqli_query($conn, $sqlC);
    $row = mysqli_fetch_array($resC);
    $numRow = mysqli_num_rows($resC);
    if ($numRow > 0) {
        if ($row["pass"] == 1 && $_POST["pass"] == 2) {
            insert_data($pass, $student_id);
        } else if ($row["pass"] == 2 && $_POST["pass"] == 3) {
            insert_data($pass, $student_id);
        } else if ($row["pass"] == 3 && $_POST["pass"] == 4) {
            insert_data($pass, $student_id);
        } else if ($row["pass"] == 4 && $_POST["pass"] == 5) {
            insert_data($pass, $student_id);
        } else if ($row["pass"] == $_POST["pass"]) {
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
            $data["pass"] = "ขั้นตอนไม่ถูกต้อง ขั้นตอนที่ผ่านล่าสุดขั้นตอนที่ " . $row["pass"] . "";
            $data["status_color"] = "text-warning";
            $data["error"] = 0;
            echo json_encode($data);
        }
    } else {
        if ($pass == 1) {
            insert_data1($pass, $student_id);
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
    $data["error"] = "เกิดข้อผิดพลาดของระบบ";
    $data["status_color"] = "text-danger";
    echo json_encode($data);
}
function insert_data1($pass, $student_id)
{
    $data = [];
    global $conn, $people_id;
    $sql = "insert into register (student_id,pass) values('$student_id','$pass')";
    $res = mysqli_query($conn, $sql);
    $sqlLog = "insert into log_data (people_id,student_id,pass) values('$people_id','$student_id','$pass')";
    $resLog = mysqli_query($conn, $sqlLog);
    if ($res && $resLog) {
        $sqlShow = "select * from register r
        left join new_student s on s.student_id = r.student_id
        where r.student_id = '$student_id'";
        $resShow = mysqli_query($conn, $sqlShow);
        $rowShow = mysqli_fetch_array($resShow);
        $data["student_id"] = $rowShow["student_id"];
        $data["prefix"] = $rowShow["prefix"];
        $data["fname"] = $rowShow["fname"];
        $data["lname"] = $rowShow["lname"];
        $data["major"] = $rowShow["major"];
        $data["minor"] = $rowShow["minor"];
        $data["system"] = $rowShow["system"];
        $data["no"] = $rowShow["no"];
        $data["level"] = $rowShow["level"];
        $data["pass"] = "ผ่านขั้นตอนที่ " . $rowShow["pass"] . " เรียบร้อย";
        $data["status_color"] = "text-success";
        $data["error"] = 0;

        echo json_encode($data);
    }
}
function insert_data($pass, $student_id)
{
    $data = [];
    global $conn, $people_id;
    $sql = "update register set pass = '$pass' where student_id ='$student_id'";
    $res = mysqli_query($conn, $sql);
    $sqlLog = "insert into log_data (people_id,student_id,pass) values('$people_id','$student_id','$pass')";
    $resLog = mysqli_query($conn, $sqlLog);
    if ($res && $resLog) {
        $sqlShow = "select * from register r
        left join new_student s on s.student_id = r.student_id
        where r.student_id = '$student_id'";
        $resShow = mysqli_query($conn, $sqlShow);
        $rowShow = mysqli_fetch_array($resShow);
        $data["student_id"] = $rowShow["student_id"];
        $data["prefix"] = $rowShow["prefix"];
        $data["fname"] = $rowShow["fname"];
        $data["lname"] = $rowShow["lname"];
        $data["major"] = $rowShow["major"];
        $data["minor"] = $rowShow["minor"];
        $data["system"] = $rowShow["system"];
        $data["no"] = $rowShow["no"];
        $data["level"] = $rowShow["level"];
        $data["pass"] = "ผ่านขั้นตอนที่ " . $rowShow["pass"] . " เรียบร้อย";
        $data["status_color"] = "text-success";
        $data["error"] = 0;

        echo json_encode($data);
    }
}
