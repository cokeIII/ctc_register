<!doctype html>
<html lang="en" class="h-100">

<head>
    <?php require_once "setHead.php"; ?>
</head>
<?php
$people_id = $_SESSION["people_id"];
if (empty($people_id)) {
    header("location: logout.php");
}
?>

<body class="d-flex flex-column h-100">

    <header>
        <!-- Fixed navbar -->
        <?php
        require_once "menu.php";
        require_once "connect.php";
        $g = $_GET["g"];
        $l = $_GET["l"];
        $sql = "select * from new_student where major = '$g' and status_std = '1'";
        $res = mysqli_query($conn, $sql);

        ?>
    </header>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <div class="card mt-5">
                <div class="card-body">
                    <!-- <button class="btn btn-primary m-3">เพิ่มรายชื่อ</button> -->
                    <table id="list_std" class="table">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>รหัส</th>
                                <th>ชื่อ - สกุล</th>
                                <th>ระดับ</th>
                                <th>สาขางาน</th>
                                <th>สาขาวิชา</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            while ($row = mysqli_fetch_array($res)) { ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $row["student_id"]; ?></td>
                                    <td><?php echo $row["prefix"] . $row["fname"] . " " . $row["lname"]; ?></td>
                                    <td><?php echo $row["level"]; ?></td>
                                    <td><?php echo $row["major"]; ?></td>
                                    <td><?php echo $row["minor"]; ?></td>
                                    <td><?php echo checkRegis($row["student_id"]); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php require_once "setFoot.php"; ?>

</body>

</html>
<script>
    $(document).ready(function() {

    })
</script>

<?php
function checkRegis($id){
    global $conn;
    $sql="select * from register where student_id = '$id' ";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_num_rows($res);
    $data = mysqli_fetch_array($res);
    return ($row > 0?'<span class="text-success">ลงทะเบียนแล้ว ขั้นที่ '.$data["pass"].'</span>':'<span class="text-danger">ยังไม่ลงทะเบียน</span>');
}
?>