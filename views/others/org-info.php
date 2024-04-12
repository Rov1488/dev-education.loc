<?php
require __DIR__. "/../layouts/header-top.php";

//PAGINATION options
$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
//Keyingi bet ikonka
$next_page = $page + 1;
//Oldingi bet ikonka
$previous_page = $page - 1;

//Bazadan ma'lumoti o'chirish
$id = null;
$del = null;
if(isset($_GET['id']) && isset($_GET["del"]) && !empty($_GET["del"]) == 'del-item'){
    $id = $_GET['id'];
    $del = $_GET["del"];
    $result = deleteData("organisetion_info", $id, $del);
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

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="btn-group">
                    <p> <a href="add-orginfo.php" class="left btn btn-block bg-gradient-success"><i class="fa fa-fw fa-plus"></i> </a></p>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Organisetion info</h3>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                        <thead>
                                        <tr>
                                            <th class="sorting sorting_asc">Name</th>
                                            <th class="sorting sorting_asc">Adress</th>
                                            <th class="sorting">Phone</th>
                                            <th class="sorting">Email</th>
                                            <th class="sorting">Bank account</th>
                                            <th class="sorting">Bank name</th>
                                            <th class="sorting">INN</th>
                                            <th class="sorting">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach (getList("organisetion_info", $page) as $item): ?>
                                            <tr class="odd">
                                                <td><?=$item['name_org'];?></td>
                                                <td><?=$item['adress'];?></td>
                                                <td><?=$item['phone'];?></td>
                                                <td><?=$item['email'];?></td>
                                                <td><?=$item['settlement_account'];?></td>
                                                <td><?=$item['bank_name'];?></td>
                                                <td><?=$item['inn'];?></td>
                                                <td>
                                                    <a href="edit-orginfo.php?id=<?=$item['id'];?>">
                                                        <i class="fas fa-edit"></i></a>
                                                    <a class="delete" name="del_item" href="org-info.php?id=<?=$item['id'];?>&del=del-item">
                                                        <i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <!--PAGINATION-->
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to <?=LIMIT." ";?> of <?php echo getCount("organisetion_info") ?> entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

                                        <ul class="pagination">
                                            <?php if ($previous_page > 0): ?>
                                                <li class="paginate_button page-item previous" id="example2_previous">
                                                    <a href="org-info.php?page=<?=$previous_page; ?>" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span></a>

                                                </li>
                                            <?php endif;?>
                                            <?php for ($i = 1; $i <= getPageCount("organisetion_info"); $i++): ?>
                                                <li class="paginate_button page-item <?php echo (isset($_GET["page"]) && $_GET["page"] == $i) ? 'active' : ''?>">
                                                    <a href="org-info.php?page=<?php echo $i ?>" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link"><?=$i;?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <?php if ($next_page <= getPageCount("organisetion_info")):?>
                                                <li class="paginate_button page-item next" id="example2_next">
                                                    <a href="org-info.php?page=<?=$next_page; ?>" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span></a>

                                                </li>
                                            <?php endif;?>
                                        </ul>

                                    </div>
                                </div>
                            </div>

                            <!--PAGINATION-->
                        </div>
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

