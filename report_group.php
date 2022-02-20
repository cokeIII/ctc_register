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
        $sql = "select *,count(CASE WHEN n.level = 'ปวช.' THEN 1 END) as idTotal1, count(CASE WHEN n.level = 'ปวส.' THEN 1 END) as idTotal2 from register r 
        inner join new_student n on r.student_id = n.student_id
        where DATE(r.time_stamp) >= '2022-02-20' group by n.major
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
                                <th>จำนวนที่ลงทะเบียน</th>
                                <th>ปวช.</th>
                                <th>ปวส.</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($res)) {
                                $sum = $sum + $row["idTotal1"] + $row["idTotal2"];
                                $sum1 = $sum1 + $row["idTotal1"];
                                $sum2 = $sum2 + $row["idTotal2"];
                            ?>
                                <tr>
                                    <td><?php echo $row["major"]; ?></td>
                                    <td><?php echo $row["idTotal1"] + $row["idTotal2"]; ?></td>
                                    <td><?php echo $row["idTotal1"]; ?></td>
                                    <td><?php echo $row["idTotal2"]; ?></td>
                                    <td><a href="name_list_check.php">ดูรายชื่อ</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>รวม</th>
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