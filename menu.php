<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <div>ระบบรายงานตัว นักเรียน/นักศึกษา วิทยาลัยเทคนิคชลบุรี</div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <!-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li> -->

                <?php 
                if (!empty($_SESSION["status"])) {
                    if ($_SESSION["status"] == "level1") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="level1.php">ขั้นตอน 1</a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION["status"] == "level2") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="level2.php">ขั้นตอน 2</a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION["status"] == "level3") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="level3.php">ขั้นตอน 3</a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION["status"] == "level4") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="level4.php">ขั้นตอน 4</a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION["status"] == "level5") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="level5.php">ขั้นตอน 5</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link " href="list_all.php">รายชื่อทั้งหมด</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="list_register.php">รายการที่ลงทะเบียนแล้ว</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="logout.php">ออกจากระบบ</a>
                    </li>

                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link " href="index.php">เข้าสู่ระบบ</a>
                    </li>
                <?php } ?>
            </ul>
            <!-- <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>
    </div>
</nav>