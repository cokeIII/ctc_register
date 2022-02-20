<!doctype html>
<html lang="en" class="h-100">

<head>
    <?php require_once "setHead.php";
    require_once "connect.php"; ?>
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
        $sql = "select *,
        count(student_id) as totalS , 
        () as sumR1, 
        (select count(CASE WHEN level = 'ปวส.' THEN 1 END) from register inner join new_student on register.student_id = new_student.student_id ) as sumR2, 
        count(CASE WHEN level = 'ปวช.' THEN 1 END) as idTotal1, 
        count(CASE WHEN level = 'ปวส.' THEN 1 END) as idTotal2 
        from new_student 
        group by major
        ";
        $res = mysqli_query($conn, $sql);

        ?>
    </header>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <div class="card mt-5">
                <div class="card-body">
                    <?php //echo $sql; 
                    ?>
                    <!-- <button class="btn btn-primary m-3">เพิ่มรายชื่อ</button> -->
                    <table id="list_std" class="table">
                        <thead>
                            <tr>
                                <th>แผนกช่าง</th>
                                <th>จำนวนทั้งหมด</th>
                                <th>ปวช.(ทั้งหมด)</th>
                                <th>ปวส.(ทั้งหมด)</th>
                                <th>จำนวนที่ลงทะเบียน</th>
                                <th>ปวช.(ที่ลงทะเบียน)</th>
                                <th>ปวส.(ที่ลงทะเบียน)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($res)) {
                                $sumR1 = getRegis1($row["major"]);
                                $sumR2 = getRegis2($row["major"]);
                                $sum = $sum + $sumR1 + $sumR2;
                                $sum1 = $sum1 + $sumR1;
                                $sum2 = $sum2 + $sumR2 ;
                            ?>
                                <tr>
                                    <td><?php echo $row["major"]; ?></td>
                                    <td><?php echo $row["totalS"]; ?></td>
                                    <td><?php echo $row["idTotal1"]; ?></td>
                                    <td><?php echo $row["idTotal2"]; ?></td>
                                    <td><?php echo $sumR1 + $sumR2; ?></td>
                                    <td><?php echo $sumR1; ?></td>
                                    <td><?php echo $sumR2; ?></td>
                                    <td><a href="name_list_check.php">ดูรายชื่อ</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>รวม</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo $sum; ?></th>
                            <th><?php echo $sum1; ?></th>
                            <th><?php echo $sum2; ?></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php require_once "setFoot.php"; ?>

</body>

</html>
<script>
    $(document).ready(function() {})
</script>
<?php
function getRegis1($group)
{
    global $conn;
    $sql = "select count(student_id) as sum1 from register 
        inner join new_student on register.student_id = new_student.student_id
        where level = 'ปวช.' and major = '$group'
        ";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    return $row["sum1"];
}
function getRegis2($group)
{
    global $conn;
    $sql = "select count(student_id) as sum2 from register 
        inner join new_student on register.student_id = new_student.student_id
        where level = 'ปวส.' and major = '$group'
        ";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    return $row["sum2"];
}
?>