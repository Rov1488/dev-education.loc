<?php
//include_once __DIR__. '/../../config/init.php';
require __DIR__. '/../../config/config_db.php';
require __DIR__. '/../../libs/db_functions.php';
session_start();

//Errors massiv
$erorr_array = [];

//Forma polyalari
$username = null;
$password = null;
$remember = null;
$logout =null;
//data=logOut
if(isset($_GET['data']) && !empty($_GET["data"]) && $_GET["data"] == 'logOut'){
    $logout = $_GET['data'];
    if ($logout){
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        redirect('/views/admin/login.php');die();
    }
}
//Postdan kelgan ma'lumotlarni tekshirish
if (isset($_POST["sign"])){
    //Username tekshiruvi
    if (isset($_POST["username"]) && !empty($_POST["username"])){
        $_SESSION['username'] = trim(h($_POST["username"]));

    }else{
        //Polyani pustoy bo'sa Erros massivga xatoni yozish
        if (empty($_POST["username"])){
            $nameErr_1 = "Username majburi qator to'ldirish shart";
            $erorr_array['username'][] = $nameErr_1;
        }
    }
    //Password tekshiruvi
    if (isset($_POST["password"]) && !empty($_POST["password"])){
        $_SESSION['password'] = trim(h($_POST["password"]));

    }else{
        if (empty($_POST["password"])){
            $passwordErr_1 = "Password majburi qator to'ldirish shart";
            $erorr_array['password'][] = $passwordErr_1;
        }
    }
    //print_r($_SESSION);die();
    if (isset($_POST['remember']) && !empty($_POST['remember'])){
        $remember = $_POST['remember'];

    }
        $result = checkUser($_SESSION['username']);
//echo $_SESSION['password'] ."===/===". $result['password']."====/=====";
//    print_r($result); die();

        if (password_verify($_SESSION['password'], $result['password'])){
            if ($remember){
                $c_key = 'username';
                $c_val = $_SESSION['username'];
                setcookie($c_key, $c_val,  time() + 600);
            }

            redirect('/views/main/index.php');
            die();
        }else{
            unset($_SESSION['username']);
            unset($_SESSION['password']);
            $erorr_array['checkuserDB'][] = "Login yoki parolni noto'g'ri kiritilgan qaytadan kiriting";
        }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <?php require __DIR__. '/../../assets/headAssets.php'; ?>

</head>
<body class="hold-transition login-page">
<section class="hold-transition login-page">

<div class="login-box"> <!--hold-transition login-page-->
    <div class="login-logo">
        <a href="../../index.php"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <!--ALERT ERROR-->
            <?php if (isset( $erorr_array) && !empty( $erorr_array)) { ?>
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
            <?php   }    ?>
            <form method="post">
                <div class="input-group mb-3">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" value="1">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" name="sign" id="sign" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!--<div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>-->
            <!-- /.social-auth-links -->

            <p class="mb-1">
                <a href="forgot-password.php">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="signup.php" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
</section>
<!-- /.login-box -->
<?php
require __DIR__. "/../layouts/footer-end.php";
?>

