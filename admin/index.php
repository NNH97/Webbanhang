<?php 
    $open = "TrangChu";
    require_once __DIR__. "/autoload/autoload.php";
    if(!isset($_SESSION['ma_tv'])||$_SESSION['quyen']==2)
    {
      header("location:/websitebanlaptop/admin/login/login.php");
    }

    $danhmuc = $db->fetchAll("danhmuc");
    $countcomment=$db->countTable('maBinhLuan','binhluansp');
    $countsanpham=$db->countTable('maSanPham','sanpham');
    $countddh=$db->countTable('maDonDatHang','dondathang');
    $countthanhvien=$db->countTable('maTaiKhoan','thanhvien');
 ?>


<?php require_once __DIR__. "/layouts/header.php"; ?>
        <div id="content-wrapper">

        <!-- <div class="container-fluid">

        
        </div> -->
            <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url()?>admin/index.php">Trang chủ</a>
          </li>
          <li class="breadcrumb-item active">Tổng hợp</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5"><b>Có tổng <?php echo $countcomment; ?> bình luận .</b></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="modules/BinhLuanSP/">
                <span class="float-left">Xem Chi Tiết</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5"><b>Có tổng <?php echo $countsanpham ?> sản phẩm .</b></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="modules/SanPham/">
                <span class="float-left">Xem Chi Tiết</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5"><b>Có tổng <?php echo $countddh ?> đơn đặt hàng .</b></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="modules/DonHang/">
                <span class="float-left">Xem Chi Tiết</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5"><b>Có tổng <?php echo $countthanhvien ?> thành viên .</b></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="modules/ThanhVien/">
                <span class="float-left">Xem Chi Tiết</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        

<?php require_once __DIR__. "/layouts/footer.php"; ?>