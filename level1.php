<!doctype html>
<html lang="en" class="h-100">

<head>
  <?php
  require_once "setHead.php";
  ?>
</head>
<?php
$people_id = $_SESSION["people_id"];
if (empty($people_id)) {
  header("location: logout.php");
}
?>
<style>
  #my_camera {
    width: 320px;
    height: 240px;
    border: 1px solid black;
  }
</style>

<body class="d-flex flex-column h-100">

  <header>
    <!-- Fixed navbar -->
    <?php require_once "menu.php"; ?>
  </header>

  <!-- Begin page content -->
  <main class="flex-shrink-0">
    <div class="container">
      <div class="card mt-5">
        <div class="card-body text-center">
          <h2>ขั้นตอนที่ 1 ATK แสดงผลการฉีดวัคซีน</h2>
          <hr>
          <div class="input-group mb-3">
            <span class="input-group-text">รหัสนักเรียน</span>
            <input type="text" class="form-control" name="student_id_input" id="student_id_input" placeholder="รหัสนักเรียน">
          </div>
          <hr>
          <div class="text-content">
            <div>รหัสนักเรียน : <span id="student_id"></span></div>
            <div>ชื่อ : <span id="fl_name"></span></div>
            <div>ระดับชั้น : <span id="level"></span></div>
            <div>แผนกวิชา : <span id="department"></span></div>
            <div>สถานะ : <span id="status"></span></div>
            <hr>
            <div class="row justify-content-center">
              <div class="col-md-4 align-self-center">
                <div id="my_camera">
                </div>
                <div>รูป :</div>
                <div id="results"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php require_once "setFoot.php"; ?>

</body>

</html>
<script language="JavaScript">
  $(document).ready(function() {
    $("#student_id_input").focus()

    $(document).on('keypress', '#student_id_input', function(e) {
      if (e.which == 13) {
        take_snapshot();
        saveSnap();
        $.ajax({
          url: "insertData.php",
          type: "POST",
          dataType: "json",
          data: {
            "student_id": $("#student_id_input").val(),
            "pass": 1,
          },
          success: function(data) {
            $("#student_id_input").val("")
            if (data.error == 0) {
              $("#student_id").html(data.student_id)
              $("#fl_name").html(data.fname + " " + data.lname)
              $("#level").html(data.level)
              $("#department").html(data.major + "" + data.system + "")
              $("#status").html("<span class='" + data.status_color + "'>" + data.pass + "</span>")
            } else {
              $("#student_id").html("")
              $("#fl_name").html("")
              $("#level").html("")
              $("#department").html("")
              $("#status").html("<span class='" + data.status_color + "'>" + data.error + "</span>")
            }
          },
          error: function(error) {
            console.log("Error:");
            console.log(error);
          }
        });
      }
    });
  })
</script>
<!-- Webcam.min.js -->
<script type="text/javascript" src="webcamjs/webcam.min.js"></script>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
  Webcam.set({
    width: 320,
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 90
  });
  Webcam.attach('#my_camera');
</script>
<!-- A button for taking snaps -->

<!-- Code to handle taking the snapshot and displaying it locally -->
<script language="JavaScript">
  function take_snapshot() {

    // take snapshot and get image data
    Webcam.snap(function(data_uri) {
      // display results in page
      document.getElementById('results').innerHTML =
        '<img id="imageprev" src="' + data_uri + '"/>';
    });
  }

  function saveSnap() {
    // Get base64 value from <img id='imageprev'> source
    var base64image = document.getElementById("imageprev").src;
    Webcam.upload(base64image, 'upload.php', function(code, text) {
      console.log(text)
      $.ajax({
        url: "updatePic.php",
        type: "POST",
        dataType: "json",
        data: {
          "student_id": $("#student_id_input").val(),
          "pic": text,
        },
        success: function(data) {

        },
        error: function(error) {
          console.log("Error:");
          console.log(error);
        }
      });

    });
  }
</script>