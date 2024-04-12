<?php
session_start();
include_once __DIR__. '/../../config/init.php';
require __DIR__. '/../../config/config_db.php';
require __DIR__. '/../../libs/db_functions.php';


//Errors massiv
$erorr_array = [];

//Forma polyalari
$username = null;
$password = null;
$conf_password = null;
$email = null;
$role = 'user';
$status = 9;

//Postdan kelgan ma'lumotlarni tekshirish
if (isset($_POST["register"])){
    //Username tekshiruvi
    if (isset($_POST["username"]) && !empty($_POST["username"])){
        $username = trim(h($_POST["username"]));
        $leng_firstname = strlen($username);

        //Polyani sonlar kiritilgan bo'sa Erros massivga xatoni yozish
        if (!preg_match("/^[a-я0-9A-Я0-9][-a-z0-9A-Z0-9]*$/",$username)){
            $nameErr_1 = "Username Lotin yoki kiril harflardan tashkil topgan bo'lishi shart";
            $erorr_array['username'][] = $nameErr_1;
        }

        //Polyada 3 ta harfdan kam bo'sa Erros massivga xatoni yozish
        if ($leng_firstname < 3){
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
            $emailErr_2 = "Email majburi qator to'ldirish shart";
            $erorr_array['email'][] = $emailErr_2;
        }
    }


    //Password tekshiruvi
    if (isset($_POST["password"]) && !empty($_POST["password"])){
        $password = trim(h($_POST["password"]));
        $length_pass = mb_strlen($password);
        $last_val = mb_substr($password, -2, 2);
        $last = $last_val;
        if ($length_pass < 8){
            $passwordErr_1 = "Password qator kammida 8 simvol bo'lishi kerak Siz {$length_pass} simvol kiritdingiz";
            $erorr_array['password'][] = $passwordErr_1;
        }
        if (!is_numeric($last_val)){
            $passwordErr_2 = "Kiritilgan paroli oxirgi 2 ta simvoli <b>{$last}</b> son bo'lishi kerak";
            $erorr_array['password'][] = $passwordErr_2;
        }

    }else{
        if (empty($_POST["password"])){
            $passwordErr_3 = "Password majburi qator to'ldirish shart";
            $erorr_array['password'][] = $passwordErr_3;
        }
    }
    //Confir_password
    if (isset($_POST["confir_password"]) && !empty($_POST["confir_password"])){
        $conf_password = trim(h($_POST["confir_password"]));
        $length_pass_confir = mb_strlen($password);
        if ($length_pass_confir < 8){
            $conf_pass_Err_1 = "Confir_password qator kammida 8 simvol bo'lishi kerak Siz {$length_pass_confir} simvol kiritdingiz";
            $erorr_array['confir_password'][] = $conf_pass_Err_1;
        }

        if ($password !== $conf_password){
            $conf_pass_Err_2 = "Password va Confir_password bir biriga to'g'ri kelmadi tekshirib qaytadan tekshirib kiriting";
            $erorr_array['confir_password'][] = $conf_pass_Err_2;
        }
    }else{
        if (empty($_POST["confir_password"])){
            $conf_pass_Err_3 = "Confir_password majburi qator to'ldirish shart";
            $erorr_array['confir_password'][] = $conf_pass_Err_3;
        }
    }

        if (empty($erorr_array)){
            $result = addUser($username, $password, $email, $role, $status);
            if ($result){
                redirect('/views/admin/login.php');
            }
        }else{
            //ALERT ERROR
             if (isset($erorr_array) && !empty($erorr_array)){
           echo '<div class="alert alert-danger alert-dismissible">';
                 echo '  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                 echo ' <h5><i class="icon fas fa-ban"></i> Alert!</h5>';
                  foreach ($erorr_array as $error) {
                    echo "<ul>";
                    foreach ($error as $value) {
                        echo "<li>". $value . "</li>";
                    }
                    echo "</ul>";
                    unset($error[$value]);
                }
                 echo '</div>';
               }
        }

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page</title>

    <?php require __DIR__. '/../../assets/headAssets.php'; ?>

</head>
<body class="hold-transition register-page">
<section class="hold-transition register-page">
<div class="register-box"><!--hold-transition register-page-->
    <div class="register-logo">
        <a href="../../index.php"><b>Admin</b>LTE</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new user</p>

            <form method="post"><!--data-toggle="validator"-->
                <div class="input-group mb-3 has-feedback">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                    <div class="help-block with-errors"></div>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3 has-feedback">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                    <div class="help-block with-errors"></div>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3 has-feedback">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <div class="help-block with-errors"></div>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3 has-feedback">
                    <input type="password" name="confir_password" id="confir_password" class="form-control" placeholder="Retype password" required>
                    <div class="help-block with-errors"></div>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="re" value="agree">
                            <label for="agreeTerms">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div>-->
                    <!-- /.col -->
                    <div class="col-4 pos-right">
                        <button type="submit" name="register" id="register" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

<!--            <div class="social-auth-links text-center">-->
<!--                <p>- OR -</p>-->
<!--                <a href="#" class="btn btn-block btn-primary">-->
<!--                    <i class="fab fa-facebook mr-2"></i>-->
<!--                    Sign up using Facebook-->
<!--                </a>-->
<!--                <a href="#" class="btn btn-block btn-danger">-->
<!--                    <i class="fab fa-google-plus mr-2"></i>-->
<!--                    Sign up using Google+-->
<!--                </a>-->
<!--            </div>-->

            <a href="login.php" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->
</section>
<?php
require __DIR__. "/../layouts/footer-end.php";
?>

