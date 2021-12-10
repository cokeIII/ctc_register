<?php
require_once "connect.php";
session_start();
$username = $_POST["username"];
$password = $_POST["password"];
header('Content-Type: text/html; charset=UTF-8');
// checkStd($username);
if ($password == "level1") {
    $sql = "select * from people where people_id = '$username'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $row = mysqli_fetch_array($res);
        $_SESSION['people_id'] = $row["people_id"];
        $_SESSION["status"] = "level1";
        header("location: level1.php");
    } else {
        header("location: errPage.php?textErr=ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง กรุณาเข้าสู่ระบบใหม่อีกครั้ง <a href='index.php'>เข้าสู่ระบบ<a/>");
    }
} else if ($password == "level2") {
    $sql = "select * from people where people_id = '$username'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $row = mysqli_fetch_array($res);
        $_SESSION['people_id'] = $row["people_id"];
        $_SESSION["status"] = "level2";
        header("location: level2.php");
    } else {
        header("location: errPage.php?textErr=ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง กรุณาเข้าสู่ระบบใหม่อีกครั้ง <a href='index.php'>เข้าสู่ระบบ<a/>");
    }
} else if ($password == "level3") {
    $sql = "select * from people where people_id = '$username'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $row = mysqli_fetch_array($res);
        $_SESSION['people_id'] = $row["people_id"];
        $_SESSION["status"] = "level3";
        header("location: level3.php");
    } else {
        header("location: errPage.php?textErr=ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง กรุณาเข้าสู่ระบบใหม่อีกครั้ง <a href='index.php'>เข้าสู่ระบบ<a/>");
    }
} else if ($password == "level4") {
    $sql = "select * from people where people_id = '$username'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $row = mysqli_fetch_array($res);
        $_SESSION['people_id'] = $row["people_id"];
        $_SESSION["status"] = "level4";
        header("location: level4.php");
    } else {
        header("location: errPage.php?textErr=ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง กรุณาเข้าสู่ระบบใหม่อีกครั้ง <a href='index.php'>เข้าสู่ระบบ<a/>");
    }
} else if ($password == "level5") {
    $sql = "select * from people where people_id = '$username'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $row = mysqli_fetch_array($res);
        $_SESSION['people_id'] = $row["people_id"];
        $_SESSION["status"] = "level5";
        header("location: level5.php");
    } else {
        header("location: errPage.php?textErr=ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง กรุณาเข้าสู่ระบบใหม่อีกครั้ง <a href='index.php'>เข้าสู่ระบบ<a/>");
    }
} else {
    header("location: errPage.php?textErr=ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง กรุณาเข้าสู่ระบบใหม่อีกครั้ง <a href='index.php'>เข้าสู่ระบบ<a/>");
}
