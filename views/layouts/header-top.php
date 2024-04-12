<?php
include_once __DIR__. '/../../config/init.php';
require __DIR__. '/../../config/config_db.php';
require __DIR__. '/../../libs/db_functions.php';

//Session open
session_start();
//Cheking users authentication and authorization
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])){
    unset($_SESSION);
    redirect('/views/admin/login.php');
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>O'quv markaz | Dashboard</title>
    <?php require __DIR__. '/../../assets/headAssets.php'; ?>
</head>
<body class="hold-transition layout-navbar-fixed layout-fixed layout-footer-fixed" style="height: auto;">
<!--hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed-->

