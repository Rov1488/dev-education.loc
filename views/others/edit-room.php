<?php
require __DIR__. "/../layouts/header-top.php";

$room = null;
$roomNumber = null;

if(isset($_GET['id'])){
    $id = $_GET['id']; //id = 15;
}
//tablitsadan ma'lumot olish
$result = getById("room_table", $id);

if (isset($_POST["update_room"])){
    if (isset($_POST["floor"]) && !empty($_POST["floor"])){
        $room = $_POST["floor"];
    }
    if (isset($_POST["roomNumber"]) && !empty($_POST["roomNumber"])){
        $roomNumber = $_POST["roomNumber"];
    }

    $result = updateRoom($id, $room, $roomNumber);
    if ($result){
        redirect('rooms.php');
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
                                <h3 class="card-title">Update student №<?=$result["id"]?></h3>
                            </div>
                            <form method="post" id="quickForm" data-toggle="validator"> <!--role="form" novalidate="novalidate"-->
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group has-feedback">
                                            <label for="firstName">Floor</label>
                                            <input class="form-control" name="floor" id="floor" type="text" value="<?=$result["floor"]?>" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="lastName">Room number</label>
                                            <input class="form-control" name="roomNumber" id="roomNumber" type="text" value="<?=$result["room_number"]?>" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success" name="update_room">Обновить</button>
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

