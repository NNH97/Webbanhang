<?php 
    $open = "DanhMuc";
    require_once __DIR__. "/../../autoload/autoload.php";

    $danhmuc = $db->fetchAll("danhmuc");
 ?>
 
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
            <div id="content-wrapper">
                <div class="container-fluid">
                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url()?>admin/index.php">Quản lý</a>
                        </li>
                        <li class="breadcrumb-item active">Danh mục</li>
                    </ol>
            <div class="clearfix"></div>

            <?php if(isset($_SESSION['success'])) :?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif ?>
            <?php if(isset($_SESSION['error'])) :?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif ?>

           <a href="them.php" class="btn btn-success">Thêm mới</a>
           <p> </p>

            <div class="content-wrapper">
                <div class="container-fluid" >
                    <table class="table table-hover table-sm" >
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên Danh Mục</th>
                            <th scope="col">Mô Tả Danh Mục</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt=1; foreach ($danhmuc as $item): ?>
                        <tr>
                            <th scope="row"><?php echo $stt ?></th>
                            <td><?php echo $item['tenDanhMuc'] ?></td>
                            <td><?php echo $item['moTaDanhMuc'] ?></td>
                            <td><img src="<?php echo uploads() ?>logo/<?php echo $item['logo'] ?>"></td>
                            <td>
                                <a class="btn btn-sm btn-info" href="sua.php?id=<?php echo $item['maDanhMuc'] ?> "> <i class="fa fa-edit"></i> Sửa</a>
                                <a class="btn btn-sm btn-danger" href="xoa.php?id=<?php echo $item['maDanhMuc'] ?>"> <i class="fa fa-times"></i> Xoá</a>
                            </td>
                        </tr>
                        <?php $stt++; endforeach ?>
                    </tbody>
                </table>
                    <div class="float-right">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                
            </div>
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>