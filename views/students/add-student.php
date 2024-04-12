<?php
require __DIR__. "/../layouts/header-top.php";

$firstname = null;
$lastname = null;
$birthDate = null;
$adress = null;
$phone = null;
$email = null;
$new_name = null;

//thumb image size
$img_width = '150';
$img_height = '80';

if (isset($_POST["add_student"])){
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

    //Validation image
    $upload_folder = __DIR__ . "/../../public/uploads/";
    $thumb_folder = __DIR__ . "/../../public/uploads/thumb/";
    if (isset($_FILES["image"]) && !empty($_FILES["image"])) {

        if(!is_dir($upload_folder)){
            mkdir($upload_folder);
        }
        $errors = [];
        $success = [];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_format_arr = explode('.', $_FILES['image']['name']);
        $file_ext = strtolower(end($file_format_arr));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Fayl formati JPEG yoki PNG bo`lishi kerak.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File hajmi 2 MB dan katta bo`lmasligi kerak';
        }
        $new_name = md5(time()).".$file_ext";

        $upload_dir = $upload_folder.$new_name;

        if (empty($errors) == true) {
           if (@move_uploaded_file($file_tmp, $upload_folder . $new_name)){
               /**
                * Метод для проверки ширину и высоту изображение
                * @param string $target путь к оригинальному файлу
                * @param string $dest путь сохранения обработанного файла
                * @param string $wmax максимальная ширина
                * @param string $hmax максимальная высота
                * @param string $ext расширение файла
                */
               $thumb_dir = $thumb_folder.$new_name;
               $resiz_img = resize($upload_dir, $thumb_dir, $img_width, $img_height, $file_ext);
               $success[] = "Fayl yuklandi";
           }


        }
    }


    $result = addStudent($firstname, $lastname, $birthDate, $adress, $phone, $email, $new_name);
    if ($result){
        redirect('student-list.php');
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

                <!--ALERT ERROR-->
                <?php if (isset( $errors) && !empty( $errors)) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        <?php
                        foreach ($errors as $error) {
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
                                <h3 class="card-title">Add student</h3>
                            </div>
                            <form method="post" id="quickForm" data-toggle="validator" enctype="multipart/form-data"> <!--role="form" novalidate="novalidate"-->
                                <div class="card-body">
                                    <div class="form-group has-feedback">
                                        <label for="firstName">First name</label>
                                        <input class="form-control" name="firstName" id="firstName" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="lastName">Last name</label>
                                        <input class="form-control" name="lastName" id="lastName" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="birthDate">Birth date</label>
                                        <input class="form-control datepicker-inline" name="birthDate" id="birthDate" type="date" data-target="#reservationdate" value="" required>
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
                                        <label for="phone">Image uplode: </label>
                                        <input class="btn btn-success" name="image" id="image" type="file" value="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success" name="add_student">Добавить</button>
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

