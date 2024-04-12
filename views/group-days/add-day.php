<?php
require __DIR__. "/../layouts/header-top.php";

$dayName = null;
$group_id = null;

if (isset($_POST["add_day"])){
    if (isset($_POST["dayName"]) && !empty($_POST["dayName"])){
        $dayName = $_POST["dayName"];
    }
    if (isset($_POST["group_id"]) && !empty($_POST["group_id"])){
        $group_id = $_POST["group_id"];
    }
    $result = addGroupDay($dayName, $group_id);

    if ($result){
        redirect('group-day.php');
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
                                <h3 class="card-title">Add group day</h3>
                            </div>
                            <form method="post" id="quickForm" data-toggle="validator"> <!--role="form" novalidate="novalidate"-->
                                <div class="card-body">
                                    <div class="form-group has-feedback">
                                        <label for="firstName">Group day name</label>
                                        <input class="form-control" name="dayName" id="dayName" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback col-sm-6">
                                        <label for="lastName">Group number</label>
                                        <select class="form-control" name="group_id" id="group_id">
                                            <?php foreach (getDataBYtable("edu_groups") as $item): ?>
                                            <option value="<?=$item['id']?>"><?=$item['groupName']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success" name="add_day">Добавить</button>
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

