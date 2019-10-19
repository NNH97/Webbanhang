
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  

  <title>SB Admin - Dashboard</title>

 <!-- Custom fonts for this template-->
        <script  src="<?php echo base_url() ?>public/frontend/ckeditor/ckeditor.js"></script>
        <link href="<?php echo base_url() ?>public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <!-- Page level plugin CSS-->
        <link href="<?php echo base_url() ?>public/admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="<?php echo base_url() ?>public/admin/css/sb-admin.css" rel="stylesheet">
         <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>public/upload/logolt.ico ?>"/>

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="<?php echo base_url()?>admin/index.php">Trang Quản Trị</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i><?php echo $_SESSION['ten_tv'] ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
         <!--  <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a> -->
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/../websitebandienthoai/admin/login/dangxuat.php">Đăng Xuất</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url()?>admin/index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Trang Chủ</span>
        </a>
      </li>
      
      <li class="nav-item <?php echo isset($open) && $open == 'DanhMuc' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo modules("DanhMuc") ?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Quản Lý Danh Mục</span></a>
      </li>
      <li class="nav-item <?php echo isset($open) && $open == 'SanPham' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo modules("SanPham") ?>">
          <i class="fab fa-dropbox"></i>
          <span>Quản Sản Phẩm</span></a>
      </li>
      <li class="nav-item <?php echo isset($open) && $open == 'ThanhVien' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo modules("ThanhVien") ?>">
          <i class="fas fa-users"></i>
          <span>Quản Thành Viên</span></a>
      </li>
      <li class="nav-item <?php echo isset($open) && $open == 'DonHang' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo modules("DonHang") ?>">
          <i class="fas fa-tasks"></i>
          <span>Quản Đơn hàng</span></a>
      </li>
      <li class="nav-item <?php echo isset($open) && $open == 'TinTuc' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo modules("TinTuc") ?>">
          <i class="far fa-newspaper"></i>
          <span>Quản Tin Tức</span></a>
      </li>
      <li class="nav-item <?php echo isset($open) && $open == 'BinhLuanSP' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo modules("BinhLuanSP") ?>">
          <i class="fas fa-comments"></i>
          <span>Quản Bình Luận</span></a>
      </li>
      <li class="nav-item <?php echo isset($open) && $open == 'Banner' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo modules("Banner") ?>">
          <i class="fas fa-dice-d6"></i>
          <span>Quản lý Banner</span></a>
      </li>
      <li class="nav-item <?php echo isset($open) && $open == 'ThongKe' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo modules("ThongKe") ?>">
          <i class="fas fa-chart-line"></i>
          <span>Thống Kê</span></a>
      </li>
      
    </ul>

    
      <!-- /.container-fluid -->