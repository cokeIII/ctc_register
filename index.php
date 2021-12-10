<!doctype html>
<html lang="en" class="h-100">

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
          <div class="row justify-content-center">
            <div class="col-md-6">
              <form id="login-form" class="form" action="login.php" method="post">
                <h3 class="text-center ">เข้าสู่ระบบ</h3>
                <div class="form-group">
                  <label for="username" class="fw-bold">ชื่อผู้ใช้งาน :</label><br>
                  <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="password" class="fw-bold">รหัสผ่าน :</label><br>
                  <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group mt-3 text-center">
                  <input type="submit" name="submit" class="btn btn-primary btn-md" value="เข้าสู่ระบบ">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php require_once "setFoot.php"; ?>

</body>

</html>