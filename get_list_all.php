<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";
$datalist = array();
$sqlShow = "select * from new_student";
$resShow = mysqli_query($conn, $sqlShow);

$i = 0;
$datalist["data"][$i]["no"] = "ไม่มีข้อมูล";
$datalist["data"][$i]["student_id"] = "";
$datalist["data"][$i]["flname"] = "";
$datalist["data"][$i]["level"] = "";
$datalist["data"][$i]["major"] = "";
$datalist["data"][$i]["minor"] = "";

while ($row = mysqli_fetch_array($resShow)) {
    $datalist["data"][$i]["no"] = $i + 1;
    $datalist["data"][$i]["student_id"] = $row["student_id"];
    $datalist["data"][$i]["flname"] = $row["prefix"] . $row["fname"] . " " . $row["lname"];
    $datalist["data"][$i]["level"] = $row["level"] . (empty($row["system"]) ? "" : "(" . $row["system"] . ")");
    $datalist["data"][$i]["major"] = $row["major"];
    $datalist["data"][$i]["minor"] = $row["minor"];
    $i++;
}
echo json_encode($datalist, JSON_UNESCAPED_UNICODE);
