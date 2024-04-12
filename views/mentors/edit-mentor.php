<?php
require __DIR__. "/../layouts/header-top.php";

$firstname = null;
$lastname = null;
$birthDate = null;
$adress = null;
$phone = null;
$email = null;
$workExp = null;
$placeWork = null;
$id = null;

if(isset($_GET['id'])){
    $id = $_GET['id']; //id = 15;
}
//tablitsadan ma'lumot olish
$result = getById("mentors", $id);

if (isset($_POST["update_mentor"])){
    if (isset($_POST["firstName"]) && !empty($_POST["firstName"])){
        $firstname = $_POST["firstName"];
    }
    if (isset($_POST["lastName"]) && !empty($_POST["lastName"])){
        $lastname = $_POST["lastName"];
    }
    if (isset($_POST["birthDate"]) && !empty($_POST["birthDate"])){
        $birthDate = $_POST["birthDate"];
    }
    if (isset($_POST["adress"]) && !empty($_POST["adress"])){
        $adress = $_POST["adress"];
    }
    if (isset($_POST["phone"]) && !empty($_POST["phone"])){
        $phone = $_POST["phone"];
    }
    if (isset($_POST["email"]) && !empty($_POST["email"])){
        $email = $_POST["email"];
    }
    if (isset($_POST["work_experience"]) && !empty($_POST["work_experience"])){
        $workExp = $_POST["work_experience"];
    }
    if (isset($_POST["place_work"]) && !empty($_POST["place_work"])){
        $placeWork = $_POST["place_work"];
    }

    $result = updateMentor($id, $firstname, $lastname, $birthDate, $adress, $phone, $email, $workExp, $placeWork);
    if ($result){
        redirect('mentors-list.php');
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
                                <h3 class="card-title">Update mentor №<?=$result["id"]?></h3>
                            </div>
                            <form method="post" id="quickForm" data-toggle="validator"> <!--role="form" novalidate="novalidate"-->
                                <div class="card-body">
                                    <div class="form-group has-feedback">
                                        <label for="firstName">First name</label>
                                        <input class="form-control" name="firstName" id="firstName" type="text" value="<?=$result['mentorFirstName']?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="lastName">Last name</label>
                                        <input class="form-control" name="lastName" id="lastName" type="text" value="<?=$result['mentorLastName']?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="birthDate">Birth date</label>
                                        <input class="form-control datepicker-inline" name="birthDate" id="birthDate" type="date" data-target="#reservationdate" value="<?=$result['birthDate']?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="adress">Adress</label>
                                        <input class="form-control" name="adress" id="adress" type="text" value="<?=$result['adress']?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" name="phone" id="phone" type="text" value="<?=$result['phone']?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="email">Email</label>
                                        <input class="form-control" name="email" id="email" type="email" value="<?=$result['email']?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="work_experience">Work experience</label>
                                        <input class="form-control" name="work_experience" id="work_experience" type="text" value="<?=$result['work_experience']?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="place_work">Place work</label>
                                        <input class="form-control" name="place_work" id="place_work" type="text" value="<?=$result['placeWork']?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success" name="update_mentor">Обновить</button>
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

