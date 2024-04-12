<?php
require __DIR__. "/../layouts/header-top.php";

$username = null;
$password = null;
$email = null;
$role = null;
$status = null;
//Errors massiv
$erorr_array = [];

if (isset($_POST["add_user"]) && !empty($_POST)){

    //Username tekshiruvi
    if (isset($_POST["username"]) && !empty($_POST["username"])){
        $username = trim(h($_POST["username"]));
        $leng_username = strlen($username);

        //Polyani sonlar kiritilgan bo'sa Erros massivga xatoni yozish
        if (!preg_match("/^[a-я0-9A-Я0-9][-a-z0-9A-Z0-9]*$/",$username)){
            $nameErr_1 = "Username Lotin yoki kiril harflardan tashkil topgan bo'lishi shart";
            $erorr_array['username'][] = $nameErr_1;
        }
        //Polyada 3 ta harfdan kam bo'sa Erros massivga xatoni yozish
        if ($leng_username < 3){
            $nameErr_2 = "Username kamida 3 ta harfdan tashkil topgan bo'lsin";
            $erorr_array['username'][] = $nameErr_2;
        }
        foreach (getDataBYtable("users") as $item){
            if ($username == $item['username']){
                $emailErr_2 = "Ushbu username bilan ro'yhatdan o'tilgan iltimos boshqa username kirining";
                $erorr_array['username'][] = $emailErr_2;
            }
        }

    }else{
        //Polyani pustoy bo'sa Erros massivga xatoni yozish
        if (empty($_POST["username"])){
            $nameErr_3 = "Username majburi qator to'ldirish shart";
            $erorr_array['username'][] = $nameErr_3;
        }
    }
    //Password tekshiruvi
    if (isset($_POST["password"]) && !empty($_POST["password"])){
        $password = trim(h($_POST["password"]));
        $length_pass = strlen($password);
        $last_val = mb_substr($password, -2, 2);
        $last = $last_val;
        if ($length_pass < 8){
            $passwordErr_1 = "Password qator kammida 8 simvol bo'lishi kerak Siz {$length_pass} simvol kiritdingiz";
            $erorr_array['password'][] = $passwordErr_1;
        }
        if (is_numeric($last_val)){
            $passwordErr_2 = "Kiritilgan paroli oxirgi 2 ta simvoli <b>{$last}</b> son bo'lishi kerak";
            $erorr_array['password'][] = $passwordErr_2;
        }

    }else{
        if (empty($_POST["password"])){
            $passwordErr_3 = "Password majburi qator to'ldirish shart";
            $erorr_array['password'][] = $passwordErr_3;
        }
    }

    //Email tekshiruvi
    if (isset($_POST["email"]) && !empty($_POST["email"])){
        $email = trim(h($_POST["email"]));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr_1 = "Elektrin pochta manzili formati no to'g'ri";
            $erorr_array['email'][] = $emailErr_1;
        }
        foreach (getDataBYtable("users") as $item){
            if ($email == $item['email']){
                $emailErr_2 = "Ushbu elektrin pochta manzili bilan ro'yhatdan o'tilgan iltimos boshqa elektron pochta manzilini kirining";
                $erorr_array['email'][] = $emailErr_2;
            }
        }
    }else{
        if (empty($_POST["email"])){
            $emailErr_3 = "Email majburi qator to'ldirish shart";
            $erorr_array['email'][] = $emailErr_3;
        }
    }

    //role
    if (isset($_POST["role"]) && !empty($_POST["role"])){
        $role = $_POST["role"];
    }
    //status
    if (isset($_POST["status"]) && !empty($_POST["status"])){
        $status = $_POST["status"];
    }

    $result = addUser($username, $password, $email, $role, $status);

    if ($result){
        redirect('users.php');
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
                <?php if (isset($erorr_array) && !empty($erorr_array)){ ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-default">
                            <div class="card-body">

                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        <?php
                        foreach ($erorr_array as $error) {
                            echo "<ul>";
                            foreach ($error as $value) {
                                echo "<li>". $value . "</li>";
                            }
                            echo "</ul>";
                            unset($error[$value]);
                        }

                        ?>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
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
                                <h3 class="card-title">Add user</h3>

                            </div>
                            <form method="post" id="quickForm"  data-toggle="validator">  <!--role="form" novalidate="novalidate"-->
                                <div class="card-body col-sm-6">
                                    <div class="form-group has-feedback">
                                        <label for="firstName">Username</label>
                                        <input class="form-control" name="username" id="username" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="firstName">Password</label>
                                        <input class="form-control" name="password" id="password" type="password" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="firstName">Email</label>
                                        <input class="form-control" name="email" id="email" type="email" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback col-sm-6">
                                        <label for="lastName">Role</label>
                                        <select class="form-control" name="role" id="role">
                                                <option value="user" selected>User</option>
                                                <option value="admin">Admin</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback col-sm-6">
                                        <label for="lastName">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="9" selected>INACTIVE</option>
                                            <option value="10">ACTIVE</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success" name="add_user">Добавить</button>
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


