<?php 
    $open = "SanPham";
    require_once __DIR__. "/../../autoload/autoload.php";
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $keyword=postInput('txttimkiem');
        $sql = "SELECT sanpham.*,danhmuc.tenDanhmuc as tendm  FROM sanpham LEFT JOIN danhmuc on danhmuc.maDanhMuc=sanpham.maDanhMuc_S WHERE sanpham.tenSanPham LIKE '%$keyword%'";
        $sanphamtk=$db->fetchsql($sql);
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
                        <li class="breadcrumb-item" >
                        <a href="<?php echo base_url()?>admin/modules/SanPham/">Sản Phẩm</a></li>
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
                        <?php $stt=1; foreach ($sanphamtk as $item): ?>
                        <tr>
                            <th scope="row"><?php echo $stt ?></th>
                            <td><?php echo $item['tenSanPham'] ?></td>
                            <td>
                                <ul>
                                <li>Giá sản phẩm: <?php echo number_format($item['giaSanPham'])." VND" ?></li> 
                                <li>Số lượng sản phẩm: <?php echo $item['soLuongSanPham'] ?> </li> 
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
                </div>
                
            </div>
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>