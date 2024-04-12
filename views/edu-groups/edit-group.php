<?php
require __DIR__. "/../layouts/header-top.php";


$groupName = null;
$course_id = null;
$room_id = null;
$s_time = null;
$e_time = null;
$s_date = null;
$e_date = null;
$countStudent = null;
$mentor_id = null;
$status = 0;
$group_day_id = null;

if(isset($_GET['id'])){
    $id = $_GET['id']; //id = 15;
}
//tablitsadan ma'lumot olish
$result = getById("edu_groups", $id);

if (isset($_POST["update_group"])){
    if (isset($_POST["groupName"]) && !empty($_POST["groupName"])){
        $groupName = $_POST["groupName"];
    }
    if (isset($_POST["course_id"]) && !empty($_POST["course_id"])){
        $course_id = $_POST["course_id"];
    }
    if (isset($_POST["room_id"]) && !empty($_POST["room_id"])){
        $room_id = $_POST["room_id"];
    }
    if (isset($_POST["s_time"]) && !empty($_POST["s_time"])){
        $s_time = $_POST["s_time"];
    }
    if (isset($_POST["e_time"]) && !empty($_POST["e_time"])){
        $e_time = $_POST["e_time"];
    }
    if (isset($_POST["s_date"]) && !empty($_POST["s_date"])){
        $s_date = $_POST["s_date"];
    }
    if (isset($_POST["e_date"]) && !empty($_POST["e_date"])){
        $e_date = $_POST["e_date"];
    }
    if (isset($_POST["countStudent"]) && !empty($_POST["countStudent"])){
        $countStudent = $_POST["countStudent"];
    }
    if (isset($_POST["mentor_id"]) && !empty($_POST["mentor_id"])){
        $mentor_id = $_POST["mentor_id"];
    }
    if (isset($_POST["status"]) && !empty($_POST["status"])){
        $status = $_POST["status"];
    }
    if (isset($_POST["group_day_id"]) && !empty($_POST["group_day_id"])){
        $group_day_id = $_POST["group_day_id"];
    }

    $result = updateGroups($id, $groupName, $course_id, $room_id, $s_time, $e_time, $s_date, $e_date, $countStudent, $mentor_id, $status, $group_day_id);

    if ($result){
        redirect('groups.php');
    }
}
?>
<!--content-->
<div class="wrapper">
    <!-- Preloader
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="adminlte/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>-->

    <!-- Navbar -->
    <?php
    require __DIR__. "/../layouts/header.php";
    ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php
    require __DIR__. "/../layouts/left-sidebar.php";
    ?>
    <!-- / Main Sidebar Container -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-1">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update group №<?=$result["id"]?></h3>
                            </div>
                            <form method="post" id="quickForm" data-toggle="validator"> <!--role="form" novalidate="novalidate"-->
                                <div class="card-body">
                                    <div class="form-group has-feedback">
                                        <label for="firstName">Group name</label>
                                        <input class="form-control" name="groupName" id="groupName" type="text" value="<?=$result["groupName"]?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group has-feedback col-sm-4">
                                            <label for="lastName">Course name</label>
                                            <select class="form-control " name="course_id" id="course_id" required>
                                                <?php foreach (getDataBYtable("course") as $item): ?>
                                                    <option value="<?=$item['id']?>"
                                                        <?php echo (isset($_GET['id']) && $item['id'] == $result["course_id"]) ? 'selected' : ""; ?>>
                                                        <?=$item['courseName']?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group has-feedback col-sm-4">
                                            <label for="lastName">Room number</label>
                                            <select class="form-control" name="room_id" id="room_id" required>
                                                <?php foreach (getDataBYtable("room_table") as $item): ?>
                                                    <option value="<?=$item['id']?>"
                                                        <?php echo (isset($_GET['id']) && $item['id'] == $result["room_id"]) ? 'selected' : ""; ?>
                                                    >floor <?=$item['floor']?> room №<?=$item['room_number']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group has-feedback col-sm-4">
                                            <label for="lastName">Mentor full name</label>
                                            <select class="form-control" name="mentor_id" id="mentor_id" required>
                                                <?php foreach (getDataBYtable("mentors") as $item): ?>
                                                    <option value="<?=$item['id']?>"
                                                        <?php echo (isset($_GET['id']) && $item['id'] == $result["mentor_id"]) ? 'selected' : ""; ?>
                                                    ><?=$item['mentorFirstName']?> <?=$item['mentorLastName']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3 col-md-3">
                                            <div class="form-group has-feedback">
                                                <label for="firstName">Start time</label>
                                                <input class="form-control" name="s_time" id="s_time" type="time" value="<?=$result["start_time"]?>" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="firstName">End time</label>
                                                <input class="form-control" name="e_time" id="e_time" type="time" value="<?=$result["end_time"]?>" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-3">
                                            <div class="form-group has-feedback">
                                                <label for="firstName">Start date</label>
                                                <input class="form-control tempusdominus-bootstrap-datetimepicker-widget-day-click" name="s_date" id="s_date" type="date" value="<?=$result["start_date"]?>" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="firstName">End date</label>
                                                <input class="form-control tempusdominus-bootstrap-datetimepicker-widget-day-click" name="e_date" id="e_date" type="date" value="<?=$result["end_date"]?>" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-md-3">
                                            <div class="form-group has-feedback">
                                                <label for="firstName">Total student</label>
                                                <input class="form-control" name="countStudent" id="countStudent" type="text" value="<?=$result["countStudent"]?>" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="lastName">Status</label>
                                                <select class="form-control" name="status" id="status" required>
                                                    <option value="0" <?php echo (isset($_GET['id']) && $result["status"] == 0) ? 'selected' : ""; ?>>
                                                        New GROUP
                                                    </option>
                                                    <option value="1" <?php echo (isset($_GET['id']) && $result["status"] == 1) ? 'selected' : ""; ?>>
                                                        Active GROUP
                                                    </option>
                                                    <option value="2" <?php echo (isset($_GET['id']) && $result["status"] == 2) ? 'selected' : ""; ?>>INACTIVE GROUP
                                                    </option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                        </div>
                                        <div class="form-group has-feedback col-sm-3">
                                            <label for="lastName">Group days</label>
                                            <select class="form-control" name="group_day_id" id="group_day_id" required>
                                                <?php foreach (getDataBYtable("group_days") as $item): ?>
                                                    <option value="<?=$item['id']?>"
                                                        <?php echo (isset($_GET['id']) && $item['id'] == $result["group_day_id"]) ? 'selected' : ""; ?>>
                                                        <?=$item['day_name']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                    </div><!--row end-->



                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success" name="update_group">Обновить</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <!-- /.content -->


    </div>
    <!-- /.content-wrapper -->
    <!-- /. Content Wrapper. Contains page content -->


    <?php
    require __DIR__. "/../layouts/footer.php";
    ?>

</div>
<!-- ./wrapper -->

<?php
require __DIR__. "/../layouts/footer-end.php";
?>


