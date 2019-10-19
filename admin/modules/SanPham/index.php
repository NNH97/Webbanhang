<?php 
    $open = "SanPham";
    require_once __DIR__. "/../../autoload/autoload.php";

    $sanpham = $db->fetchAll("sanpham");

    if (isset($_GET['page'])) 
   {
     $p = $_GET['page'];
   }
   else
   {
    $p=1;
   }
   $sql = "SELECT sanpham.*,danhmuc.tenDanhmuc as tendm  FROM sanpham LEFT JOIN danhmuc on danhmuc.maDanhMuc=sanpham.maDanhMuc_S";
   $sanpham=$db->fetchJone('sanpham',$sql,$p,4,true,"maSanPham");

   if (isset($sanpham['page'])) 
   {
     $sotrang = $sanpham['page'];
     unset($sanpham['page']);
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
                        <li class="breadcrumb-item active">Sản Phẩm</li>
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
                            <th scope="col">Tên Sản Phẩm</th>
                            <th scope="col">Giá Sản Phẩm</th>
                            <!-- <th scope="col">Mô Tả Sản Phẩm</th> -->
                            <th scope="col">Hình Ảnh Sản Phẩm</th>
                            <th scope="col">Danh Mục</th>
                            <th scope="col">View</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt=1; foreach ($sanpham as $item): ?>
                        <tr>
                            <th scope="row"><?php echo $stt ?></th>
                            <td><?php echo $item['tenSanPham'] ?></td>
                            <td>
                                <ul>
                                <li>Giá chưa sale:<?php echo number_format($item['giaSanPham'])." VND" ?> </li>
                                <li>Giá đã sale: <?php echo formatpricesale($item['giaSanPham'],$item['sale'])." VND" ?></li> 
                                <li>Số lượng sản phẩm: <?php echo $item['soLuongSanPham'] ." Sản Phẩm"?> </li>
                                <?php if ($item['sale']>0): ?>
                                     <li>Sale: <?php echo $item['sale'] ."%"?></li>
                                 <?php endif ?> 
                                
                                </ul>   
                            </td>
                            <!-- <td><?php echo $item['moTaSanPham'] ?></td> -->
                            <td>
                                <img src="<?php echo uploads() ?>sanpham/<?php echo $item['hinhAnhSanPham'] ?>" width="80px" height="80px" >
                            </td>
                            <td><?php echo $item['tendm'] ?></td>
                            <td>
                                <a href="view.php?id=<?php echo $item['maSanPham'] ?>" class="btn btn-xs <?php echo $item['view']==0?'btn-info':'btn-danger'?>"><?php echo $item['view']==0?'Hiển thị':'Ẩn'?></a>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-info" href="sua.php?id=<?php echo $item['maSanPham'] ?> "> <i class="fa fa-edit"></i> Sửa</a>
                                <a class="btn btn-sm btn-danger" href="xoa.php?id=<?php echo $item['maSanPham'] ?>"> <i class="fa fa-times"></i> Xoá</a>
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