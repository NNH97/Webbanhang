<?php 
    $open = "TinTuc";
    require_once __DIR__. "/../../autoload/autoload.php";

    $tintuc = $db->fetchAll("tintuc");

    if (isset($_GET['page'])) 
   {
     $p = $_GET['page'];
   }
   else
   {
    $p=1;
   }
   $sql = "SELECT * FROM tintuc WHERE 1";
   $tintuc=$db->fetchJone('tintuc',$sql,$p,4,true,"maTinTuc");

   if (isset($tintuc['page'])) 
   {
     $sotrang = $tintuc['page'];
     unset($tintuc['page']);
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
                        <li class="breadcrumb-item active">Tin Tức</li>
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
                        <?php $stt=1; foreach ($tintuc as $item): ?>
                        <tr>
                            <th scope="row"><?php echo $stt ?></th>
                            <td width="200"><?php echo $item['tieuDe'] ?></td>
                            <td width="300"><?php echo $item['noiDungNgan'] ?></td>
                            <td><?php echo $item['tacGia'] ?></td>
                            <!-- <td><?php echo $item['moTaSanPham'] ?></td> -->
                            <td>
                                <img src="<?php echo uploads() ?>tintuc/<?php echo $item['hinhAnh'] ?>" width="80px" height="80px" >
                            </td>
                            <td width="200"><?php echo $item['ngayTao'] ?></td>
                            <td style="width: 200px">
                                <a class="btn btn-sm btn-info" href="sua.php?id=<?php echo $item['maTinTuc'] ?> "> <i class="fa fa-edit"></i> Sửa</a>
                                <a class="btn btn-sm btn-danger" href="xoa.php?id=<?php echo $item['maTinTuc'] ?>"> <i class="fa fa-times"></i> Xoá</a>
                            </td>
                        </tr>
                        <?php $stt++; endforeach ?>
                    </tbody>
                </table>
                    <div class="float-right">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <!-- <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    </a> -->
                                </li>
                                <?php for ($i=1; $i <= $sotrang ; $i++):?>
                                    <?php 
                                    if (isset($_GET['page'])) 
                                    {
                                      $p =$_GET['page'];
                                    }
                                    else
                                    { 
                                        $p=1;
                                    }
                                    ?>
                                <li class="page-item <?php echo ($i==$p)? 'active':''?>"><a class="page-link" href="?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                                <?php endfor; ?>
                                
                                <li class="page-item">
                                    <!-- <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    </a> -->
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                
            </div>
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>