<?php 
    $open = "TinTuc";
    require_once __DIR__. "/../../autoload/autoload.php";

    $tintuc = $db->fetchAll("tintuc");
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $keyword=postInput('txttimkiem');
        $sql = "SELECT * FROM tintuc WHERE tieuDe LIKE '%$keyword%' OR noiDungNgan LIKE '%$keyword%' OR noiDung LIKE '%$keyword%' OR tacGia LIKE '%$keyword%'";
        $tintuctk=$db->fetchsql($sql);
    }

 ?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
            <div id="content-wrapper">
                <div class="container-fluid">
                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url()?>admin/index.php">Quản lý</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url()?>admin/modules/TinTuc/">Tin Tức</a>
                        </li>
                        <li class="breadcrumb-item active">Tìm Kiếm</li>
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

           
            <form class="" style="margin-bottom: 20px;width: 250px" action="timkiem.php" method="POST">
              <div class="input-group" >
                <input type="text" name="txttimkiem" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button  class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
            
            <div class="content-wrapper">
                <div class="container-fluid" >
                    <table class="table table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tiêu Đề</th>
                            <th scope="col">Nội Dung Ngắn</th>
                            <!-- <th scope="col">Mô Tả Sản Phẩm</th> -->
                            <th scope="col">Tác Giả</th>
                            <th scope="col">Hình Ảnh</th>
                            <th scope="col">Ngày Tạo</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt=1; foreach ($tintuctk as $item): ?>
                        <tr>
                            <th scope="row"><?php echo $stt ?></th>
                            <td><?php echo $item['tieuDe'] ?></td>
                            <td><?php echo $item['noiDungNgan'] ?></td>
                            <td><?php echo $item['tacGia'] ?></td>
                            <!-- <td><?php echo $item['moTaSanPham'] ?></td> -->
                            <td>
                                <img src="<?php echo uploads() ?>tintuc/<?php echo $item['hinhAnh'] ?>" width="80px" height="80px" >
                            </td>
                            <td><?php echo $item['ngayTao'] ?></td>
                            <td style="width: 200px">
                                <a class="btn btn-sm btn-info" href="sua.php?id=<?php echo $item['maTinTuc'] ?> "> <i class="fa fa-edit"></i> Sửa</a>
                                <a class="btn btn-sm btn-danger" href="xoa.php?id=<?php echo $item['maTinTuc'] ?>"> <i class="fa fa-times"></i> Xoá</a>
                            </td>
                        </tr>
                        <?php $stt++; endforeach ?>
                    </tbody>
                </table>
                </div>
                
            </div>
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>