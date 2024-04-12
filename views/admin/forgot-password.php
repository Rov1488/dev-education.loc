<?php
include_once __DIR__. '/../../config/init.php';
require __DIR__. '/../../config/config_db.php';
require __DIR__. '/../../libs/db_functions.php';


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
<div class="login-box"><!--hold-transition login-page-->
    <div class="login-logo">
        <a href="../../index.php"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

            <form action="recover-password.html" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="login.php">Login</a>
            </p>
            <p class="mb-0">
                <a href="signup.php" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
</section>
<?php
require __DIR__. "/../layouts/footer-end.php";
?>

