<?php
require __DIR__. "/../layouts/header-top.php";

$name = null;
$adress = null;
$phone = null;
$email = null;
$setAccount = null;
$bankName = null;
$mfo = null;
$inn = null;
$oked = null;
$regCode = null;

if (isset($_POST["add_org"])){
    if (isset($_POST["orgName"]) && !empty($_POST["orgName"])){
        $name = $_POST["orgName"];
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
    if (isset($_POST["setAccount"]) && !empty($_POST["setAccount"])){
        $setAccount = $_POST["setAccount"];
    }
    if (isset($_POST["bankName"]) && !empty($_POST["bankName"])){
        $bankName = $_POST["bankName"];
    }
    if (isset($_POST["mfo"]) && !empty($_POST["mfo"])){
        $mfo = $_POST["mfo"];
    }
    if (isset($_POST["inn"]) && !empty($_POST["inn"])){
        $inn = $_POST["inn"];
    }
    if (isset($_POST["oked"]) && !empty($_POST["oked"])){
        $oked = $_POST["oked"];
    }
    if (isset($_POST["regCod"]) && !empty($_POST["regCod"])){
        $regCode = $_POST["regCod"];
    }

    $result = addOrgInfo($name, $adress, $phone, $email, $setAccount, $bankName, $mfo, $inn, $oked, $regCode);
    if ($result){
        redirect('org-info.php');
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
                                <h3 class="card-title">Add org-info</h3>
                            </div>
                            <form method="post" id="quickForm" data-toggle="validator"> <!--role="form" novalidate="novalidate"-->
                                <div class="card-body">
                                    <div class="form-group has-feedback">
                                        <label for="firstName">Organisetion name</label>
                                        <input class="form-control" name="orgName" id="orgName" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="adress">Adress</label>
                                        <input class="form-control" name="adress" id="adress" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" name="phone" id="phone" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="email">Email</label>
                                        <input class="form-control" name="email" id="email" type="email" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="email">Settlement account</label>
                                        <input class="form-control" name="setAccount" id="setAccount" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="email">Bank name</label>
                                        <input class="form-control" name="bankName" id="bankName" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="email">MFO</label>
                                        <input class="form-control" name="mfo" id="mfo" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="email">INN</label>
                                        <input class="form-control" name="inn" id="inn" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="email">OKED</label>
                                        <input class="form-control" name="oked" id="oked" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="email">Reg_cod_nds</label>
                                        <input class="form-control" name="regCod" id="regCod" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success" name="add_org">Добавить</button>
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


