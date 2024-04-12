<?php
require __DIR__. "/../layouts/header-top.php";

$title = null;
$category_id = null;
$content = null;
$keyword = null;
$description = null;
$price = null;
$old_price = null;
$nameSpecif = null;
$valueSpecif =null;

if (isset($_POST["add_product"])){

    if (isset($_POST["title"]) && !empty($_POST["title"])){
        $title = $_POST["title"];
    }
    if (isset($_POST["category_id"]) && !empty($_POST["category_id"])) {
        $category_id = $_POST["category_id"];
    }
    if (isset($_POST["content"]) && !empty($_POST["content"])) {
        $content = $_POST["content"];
    }
    if (isset($_POST["keyword"]) && !empty($_POST["keyword"])) {
        $keyword = $_POST["keyword"];
    }
    if (isset($_POST["description"]) && !empty($_POST["description"])) {
        $description = $_POST["description"];
    }
    if (isset($_POST["price"]) && !empty($_POST["price"])) {
        $price = $_POST["price"];
    }
    if (isset($_POST["oldPrice"]) && !empty($_POST["oldPrice"])) {
        $old_price = $_POST["oldPrice"];
    }
    if (isset($_POST["nameSpecif"]) && !empty($_POST["nameSpecif"])) {
        $nameSpecif = $_POST["nameSpecif"];
    }
    if (isset($_POST["valueSpecif"]) && !empty($_POST["valueSpecif"])) {
        $valueSpecif = $_POST["valueSpecif"];
    }
    $name_s_m = explode(',', $nameSpecif);
    $value_s_m = explode(':', $valueSpecif);

    $value_s_m_1 = [];

    for ($i = 0; $i < count($value_s_m); $i++){
        $value_s_m_1[] = explode(',', $value_s_m[$i]);
    }
    $new_array = array_combine($name_s_m, $value_s_m_1);
    $json_array = json_encode($new_array);

   $result = addProduct($title, $category_id, $content, $keyword, $description, $price, $old_price, $json_array);

    if ($result){
        redirect('products-list.php');
    }
}
?>
//content
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
        <div class="col-md-6">
            <!--<pre>-->
           <?php
           /*print_r($name_s_m);
            print_r($value_s_m_1);
            print_r($json_array);*/
            ?>
        <!--</pre>-->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add course</h3>
                            </div>
                            <form method="post" role="form" data-toggle="validator">
                                <div class="card-body">
                                    <div class="form-group has-feedback">
                                        <label for="login">Title</label>
                                        <input class="form-control" name="title" id="title" type="text" data-error="You must write course name" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback col-sm-6">
                                        <label for="lastName">Category_id</label>
                                        <select class="form-control" name="category_id" id="category_id">
                                            <?php foreach (getDataBYtable("productLines") as $item): ?>
                                                <option value="<?=$item['id']?>"><?=$item['title']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-7 has-feedback">
                                        <label for="login">Content</label>
                                        <textarea class="form-control" name="content" id="content" rows="3" cols="15" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3">
                                    <div class="form-group has-feedback">
                                        <label for="login">Keyword</label>
                                        <input class="form-control" name="keyword" id="keyword" type="text" value="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="login">Description</label>
                                        <input class="form-control" name="description" id="description" type="text" value="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                        </div>
                                            <div class="col-sm-3 col-md-3">
                                    <div class="form-group has-feedback">
                                        <label for="login">Price</label>
                                        <input class="form-control" name="price" id="price" type="text" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="login">Old Price</label>
                                        <input class="form-control" name="oldPrice" id="oldPrice" type="text" value="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                     </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-5">
                                            <div class="form-group has-feedback">
                                                <label for="login">Name Specification massive</label>
                                                <textarea class="form-control" name="nameSpecif" id="nameSpecif" rows="3" cols="25" required></textarea>
                                                <i class="placeholder">Example: generalCharact,connection,memory&core,power,camer,display,....</i>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            </div>
                                        <div class="col-sm-3 col-md-5">
                                            <div class="form-group has-feedback">
                                                <label for="login">Value Specification massive</label>
                                                <textarea class="form-control" name="valueSpecif" id="valueSpecif" rows="3" cols="25" placeholder=""  required></textarea>
                                                <i class="placeholder">Example: green,Android 13,plactic,2 Nano Sim,186 g:NFC,Bluetooth 5.2,GSM 850/900/1800/1900,....</i>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" name="add_product">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
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


