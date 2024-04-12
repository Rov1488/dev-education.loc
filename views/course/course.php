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
$sort = null;
$order = null;

if(isset($_GET['id']) && isset($_GET["del"]) && !empty($_GET["del"]) == 'del-item'){
    $id = $_GET['id'];
    $del = $_GET["del"];
    $result = deleteData("course", $id, $del);
    if ($result){
        redirect('course.php');
    }
}

//Sorting by title
if (isset($_GET['sort']) && !empty($_GET['sort'])){
    $sort = $_GET['sort'];
    $s_elements = explode(',', $sort);
    $s_title = $s_elements[0];
    $s_type = $s_elements[1];
    $order = $s_title ." ". $s_type;

}

?>

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
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
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
                    <p> <a href="add-course.php" class="left btn btn-block bg-gradient-success"><i class="fa fa-fw fa-plus"></i> </a></p>
                </div>

      <div class="card">
        <div class="card-header">
        <h3 class="card-title">Courses list</h3>
        </div>
    <div class="card-body">
    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
        <div class="row">
            <div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
    <thead>
    <tr>
        <th>Course name
            <?php if (!empty($s_type) &&  $s_type == 'asc'): ?>
            <a href="course.php?sort=courseName,desc">
                    <i class="fas fa-sort-alpha-down-alt"></i>
            </a>
            <?php elseif (!empty($s_type) &&  $s_type == 'desc'): ?>
            <a href="course.php?sort=courseName,asc">
                <i class="fas fa-sort-alpha-up-alt"></i>
          </a>
            <?php else:?>
            <a href="course.php?sort=courseName,asc">
                <i class="fas fa-sort-alpha-down-alt"></i>
            </a>
            <?php endif; ?>

        </th>
        <th>Price
            <?php if (!empty($s_type) &&  $s_type == 'asc'): ?>
                <a href="course.php?sort=price_course,desc">
                    <i class="fas fa-sort-alpha-down-alt"></i>
                </a>
            <?php elseif (!empty($s_type) &&  $s_type == 'desc'): ?>
                <a href="course.php?sort=price_course,asc">
                    <i class="fas fa-sort-alpha-up-alt"></i>
                </a>
            <?php else:?>
                <a href="course.php?sort=price_course,asc">
                    <i class="fas fa-sort-alpha-down-alt"></i>
                </a>
            <?php endif; ?>
        </th>
        <th >Action</th>
    </tr>
    </thead>
        <tbody>
        <?php foreach (getListSort("course", $page, $order) as $item): ?>
            <tr class="odd">
            <td class="dtr-control sorting_1" tabindex="0"><?=$item['courseName'];?></td>
            <td><?=$item['price_course'];?></td>
            <td>
                <a href="edit-course.php?id=<?=$item['id'];?>">
                    <i class="fas fa-edit"></i></a>
                <a class="delete" name="del_item" href="course.php?id=<?=$item['id'];?>&del=del-item">
                    <i class="fas fa-trash"></i></a>
            </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table></div>
        </div>

        <!--PAGINATION-->
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to <?=LIMIT." ";?> of <?php echo getCount("course") ?> entries</div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

                    <ul class="pagination">
                        <?php if ($previous_page > 0): ?>
                        <li class="paginate_button page-item previous" id="example2_previous">
                            <a href="course.php?page=<?=$previous_page; ?>" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span></a>

                        </li>
                        <?php endif;?>
                        <?php for ($i = 1; $i <= getPageCount("course"); $i++): $val_sort = $i; ?>
                        <?php if(!is_null($order)){
                                $val_sort = $i."&"."sort=".$sort;
                            } ?>
                            <li class="paginate_button page-item <?php echo (isset($_GET["page"]) && $_GET["page"] == $i) ? 'active' : ''?>">
                                <a href="course.php?page=<?=$val_sort;?>" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link"><?=$i;?></a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($next_page <= getPageCount("course")):?>
                        <li class="paginate_button page-item next" id="example2_next">
                            <a href="course.php?page=<?=$next_page; ?>" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link" aria-label="Next">
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

