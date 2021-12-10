<!doctype html>
<html lang="en" class="h-100">
<?php
session_start();
$people_id = $_SESSION["people_id"];
if (empty($people_id)) {
    header("location: logout.php");
}
?>

<head>
    <?php require_once "setHead.php"; ?>
</head>

<body class="d-flex flex-column h-100">

    <header>
        <!-- Fixed navbar -->
        <?php require_once "menu.php"; ?>
    </header>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <div class="card mt-5">
                <div class="card-body">
                    <table id="list_std" class="table">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>รหัส</th>
                                <th>ชื่อ - สกุล</th>
                                <th>ระดับ</th>
                                <th>สาขางาน</th>
                                <th>สาขาวิชา</th>
                                <th>ลงทะเบียน</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

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
        $(document).on('click', '.delItem', function() {
            let id = $(this).attr("idItem")
            if (confirm("ต้องการลบรายการใช่หรือไม่ ?")) {
                $.redirect("delList.php", {
                    id: id
                });
            }
        })
        $("#list_std").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "bDestroy": true,
            "responsive": true,
            "autoWidth": false,
            "pageLength": 30,
            "ajax": {
                "url": "get_list_register.php",
                "type": "POST",
                "data": function(d) {
                    d.std = true
                }
            },
            'processing': true,
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "student_id"
                },
                {
                    "data": "flname"
                },
                {
                    "data": "level"
                },
                {
                    "data": "major"
                },
                {
                    "data": "minor"
                },
                {
                    "data": "regis"
                },
                {
                    "data": "del"
                }
            ],
            "language": {
                'processing': '<img src="img/tenor.gif" width="80">',
                "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
                "zeroRecords": "ไม่มีข้อมูล",
                "info": "กำลังแสดงข้อมูล _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "search": "ค้นหา:",
                "infoEmpty": "ไม่มีข้อมูลแสดง",
                "infoFiltered": "(ค้นหาจาก _MAX_ total records)",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "หน้าต่อไป",
                    "previous": "หน้าก่อน"
                }
            },
            responsive: true,
            "scrollX": true
        });
    })
</script>