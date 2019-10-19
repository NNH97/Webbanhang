<?php 
    $open = "Banner";
    require_once __DIR__. "/../../autoload/autoload.php";

    $banner = $db->fetchAll("banner");

    
 ?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
            <div id="content-wrapper">
                <div class="container-fluid">
                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url()?>admin/index.php">Quản lý</a>
                        </li>
                        <li class="breadcrumb-item active">Banner</li>
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
                    <table class="table table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên Baner</th>
                            <th scope="col">Hình Ảnh Baner</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt=1; foreach ($banner as $item): ?>
                        <tr>
                            <th scope="row"><?php echo $stt ?></th>
                            <td><?php echo $item['tenBanner'] ?></td>
                            <td>
                                <img src="<?php echo uploads() ?>banner/<?php echo $item['anhBanner'] ?>" width="400px" height="150px" >
                            </td>
                            <td>
                                <a class="btn btn-sm btn-info" href="sua.php?id=<?php echo $item['maBanner'] ?> "> <i class="fa fa-edit"></i> Sửa</a>
                                <a class="btn btn-sm btn-danger" href="xoa.php?id=<?php echo $item['maBanner'] ?>"> <i class="fa fa-times"></i> Xoá</a>
                            </td>
                        </tr>
                        <?php $stt++; endforeach ?>
                    </tbody>
                </table>
                </div>
                
            </div>
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>