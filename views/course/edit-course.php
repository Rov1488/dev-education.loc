<?php
require __DIR__. "/../layouts/header-top.php";

$id = null;
if(isset($_GET['id'])){
    $id = $_GET['id']; //id = 15;
}
//$sql = "select * from course where id = :id";
//$st = $conn->prepare($sql);
//$st->bindParam(":id",$id);
//$st->execute();
$result = getById("course", $id);

if (isset($_POST["update_course"])){

    if (isset($_POST["course_name"]) && !empty($_POST["course_name"])){
        $title = $_POST["course_name"];
    }
    if (isset($_POST["price_course"]) && !empty($_POST["price_course"])) {
        $price = $_POST["price_course"];
    }

    $result1 = updateCourse($id, $title, $price);
    if ($result1){
        redirect('course.php');
    }
}
?>

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
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
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
        </section>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="box-title">Update course №<?=$result["id"]?></h3>
                            </div>
                            <form method="post" role="form" data-toggle="validator">
                                <div class="card-body">
                                    <div class="form-group has-feedback">
                                        <label for="login">Course name</label>
                                        <input class="form-control" name="course_name" id="course_name" type="text" data-error="You must write course name" value="<?=$result['courseName']?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="login">Price</label>
                                        <input class="form-control" name="price_course" id="price_course" type="text" value="<?=$result['price_course']?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" name="update_course">Обновить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->


    </div>
    <!-- /.content-wrapper -->
    <!-- /. Content Wrapper. Contains page content -->
    <!-- ./wrapper -->
    <?php
    require __DIR__. "/../layouts/footer.php";
    ?>

</div>

<?php
require __DIR__. "/../layouts/footer-end.php";
?>


