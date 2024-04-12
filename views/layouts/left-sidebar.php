<?php
session_start();
require_once __DIR__. "/../../config/init.php";
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?php ROOT ?>/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php ROOT ?>/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Po'latov Rovshan</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/views/main/index.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/views/course/course.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Courses
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/views/edu-groups/groups.php" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Groups
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/views/group-days/group-day.php" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>

                            Group days
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Invoice
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/views/invoice/list-invoice.php" class="nav-link">
                                <i class="far fa-circle text-blue nav-icon"></i>
                                <p>List invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/views/invoice/add-invoice.php" class="nav-link">
                                <i class="far fa-circle text-success nav-icon"></i>
                                <p>Create invoice</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Mentors
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/views/mentors/mentors-list.php" class="nav-link">
                                <i class="far fa-circle text-success nav-icon"></i>
                                <p>Mentors</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/views/mentors/payment-list.php" class="nav-link">
                                <i class="nav-icon fas fa-hand-holding-usd"></i>
                                <p>Mentors payment</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Students
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/views/students/student-list.php" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Students list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/views/student-course/student-course.php" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Student course</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/views/student-payments/student-payments.php" class="nav-link">
                                <i class="nav-icon fas fa-hand-holding-usd"></i>
                                <p>Student payments</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Others
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/views/others/org-info.php" class="nav-link">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>Organition info</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/views/others/rooms.php" class="nav-link">
                                <i class="nav-icon fas fa-building"></i>
                                <p>Rooms</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/views/admin/users.php" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/views/products/products-list.php" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                           Products
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
