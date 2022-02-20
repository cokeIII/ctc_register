<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";
$datalist = array();
$sqlShow = "select * from register r
        left join new_student s on s.student_id = r.student_id where DATE(time_stamp) >= '2022-02-20'";
$resShow = mysqli_query($conn, $sqlShow);

$i = 0;
$datalist["data"][$i]["no"] = "ไม่มีข้อมูล";
$datalist["data"][$i]["student_id"] = "";
$datalist["data"][$i]["flname"] = "";
$datalist["data"][$i]["level"] = "";
$datalist["data"][$i]["major"] = "";
$datalist["data"][$i]["minor"] = "";
$datalist["data"][$i]["dates"] = "";
$datalist["data"][$i]["regis"] = "";
$datalist["data"][$i]["pic"] = "";
$datalist["data"][$i]["del"] = "";

while ($row = mysqli_fetch_array($resShow)) {
    $datalist["data"][$i]["no"] = $i + 1;
    $datalist["data"][$i]["student_id"] = $row["student_id"];
    $datalist["data"][$i]["flname"] = $row["prefix"] . $row["fname"] . " " . $row["lname"];
    $datalist["data"][$i]["level"] = $row["level"] . (empty($row["system"]) ? "" : "(" . $row["system"] . ")");
    $datalist["data"][$i]["major"] = $row["major"];
    $datalist["data"][$i]["minor"] = $row["minor"];
    $datalist["data"][$i]["dates"] = $row["time_stamp"];
    $datalist["data"][$i]["regis"] = (empty($row["pass"])?"":"ขั้นตอนที่ ".$row["pass"]);
    $datalist["data"][$i]["pic"] = "<a href='upload/".$row['pic']."' target='blank'>รูปภาพ</a>";
    $datalist["data"][$i]["del"] = '<button class="btn btn-danger delItem" idItem="' . $row["student_id"] . '">ลบ</button>';

    $i++;
}
echo json_encode($datalist, JSON_UNESCAPED_UNICODE);
