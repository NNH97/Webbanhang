<?php 
    $open = "ThanhVien";
    require_once __DIR__. "/../../autoload/autoload.php";

    $thanhvien = $db->fetchAll("thanhvien");
    $quyen = $db->fetchAll("quyen");

    if (isset($_GET['page'])) 
   {
     $p = $_GET['page'];
   }
   else
   {
    $p=1;
   }
   $sql = "SELECT thanhvien.*,quyen.tenQuyen as tenq FROM thanhvien LEFT JOIN quyen on thanhvien.maQuyen_S=quyen.maQuyen order by thanhvien.maTaiKhoan desc";
   $thanhvien=$db->fetchJone('thanhvien',$sql,$p,5,true,"maTaiKhoan");

   if (isset($thanhvien['page'])) 
   {
     $sotrang = $thanhvien['page'];
     unset($thanhvien['page']);
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
                        <li class="breadcrumb-item active">Thành Viên</li>
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
                            <th scope="col">Tài Khoản</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Địa Chỉ</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Quyền</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt=1; foreach ($thanhvien as $item): ?>
                        <tr>
                            <th scope="row"><?php echo $stt ?></th>
                            <td><?php echo $item['taiKhoan'] ?></td>
                            <td><?php echo $item['hoTen'] ?></td>
                            <td><?php echo $item['email'] ?></td>
                            <td><?php echo $item['diaChi'] ?></td>
                            <td><?php echo $item['soDienThoai'] ?></td>
                            <td><?php echo $item['tenq'] ?></td>
                            <td>
                                <a class="btn btn-sm btn-info" href="sua.php?id=<?php echo $item['maTaiKhoan'] ?> "> <i class="fa fa-edit"></i> Sửa</a>
                                <a class="btn btn-sm btn-danger" href="xoa.php?id=<?php echo $item['maTaiKhoan'] ?>"> <i class="fa fa-times"></i> Xoá</a>
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