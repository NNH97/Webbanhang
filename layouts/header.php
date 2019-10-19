<!DOCTYPE html>
<html>
    <head>
        <title>Chuyên đề website</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/frontend/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/frontend/css/bootstrap.min.css">
        
        <script  src="<?php echo base_url()?>public/frontend/js/jquery-3.2.1.min.js"></script>
        <script  src="<?php echo base_url()?>public/frontend/js/bootstrap.min.js"></script>
        <!---->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/frontend/css/slick.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/frontend/css/slick-theme.css"/>
        <!--slide-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/frontend/css/style.css">
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>public/upload/logolt.ico ?>"/>
    </head>
    <body>
        <div id="wrapper">
            <!---->
            <!--HEADER-->
            <div id="header">
                <div id="header-top">
                    <div class="container">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <nav id="header-nav-top">
                                    <ul class="list-inline pull-right" id="headermenu">
                                        <?php if(isset($_SESSION['ten_tv'])):?>
                                            <li style="color: blue">Xin chào:<?php echo $_SESSION['ten_tv']?></li>

                                        <li>
                                            <a href=""><i class="fa fa-user"></i> My Account <i class="fa fa-caret-down"></i></a>
                                            <ul id="header-submenu">
                                                <li><a href="thongtin.php?id=<?php echo $_SESSION['ma_tv'] ?>">Thông tin</a></li>
                                                <li><a href="lichsumuahang.php">Lịch sử mua hàng</a></li>
                                                <li><a href="giohang.php">Giỏ hàng</a></li>
                                                <li><a href="thoat.php"><i class="fa fa-share-square-o"></i> Thoát</a></li>
                                            </ul>
                                        </li>
                                        
                                        <?php else:?>
                                            <li>
                                            <a href="dangnhap.php"><i class="fa fa-unlock"></i> Đăng Nhập</a>
                                        </li>

                                        <li>
                                            <a href="dangky.php"><i class="fa fa-user"></i> Đăng Ký</a>
                                        </li>
                                    <?php endif;?>
                                        
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    $gia1=1;
                    $gia2=2;
                    $gia3=3;
                 ?>
                
                <div class="container">
                    <div class="row" id="header-main">
                        <div class="col-md-5">
                            <form class="form-inline" action="timkiem.php?id=<?php echo $gia1 ?>" method="GET">
                                <div class="form-group">
                                    <label>
                                        <select name="gia" class="form-control">
                                            <option> Tất Cả Sản Phẩm</option>
                                            <option value="<?php echo $gia1 ?>">Giá nhỏ hơn 10Tr</option>
                                            <option value="<?php echo $gia2 ?>">Giá từ 20Tr đến 30Tr</option>
                                            <option value="<?php echo $gia3 ?>">Giá lớn hơn 20Tr</option>
                                        </select>
                                    </label>
                                    <input type="text" name="txttimkiem" placeholder="Nhập Tên Sản Phẩm" class="form-control">
                                    <button type="submit" id="btntimkiem" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <a href="">
                                <img src="<?php echo base_url() ?>/public/upload/logolt.png">
                            </a>
                        </div>
                        <div class="col-md-3" id="header-right">
                            <div class="pull-right">
                                <div class="pull-left">
                                    <i class="glyphicon glyphicon-phone-alt"></i>
                                </div>
                                <div class="pull-right">
                                    <p id="hotline">HOTLINE</p>
                                    <p>0914470465 ( Ân )​</p><br/>
                                </div>
 
                            </div>
                        </div>
                        
                        <div class="col-md-3" id="header-right">
                            <div class="pull-right">
                                <div class="pull-left">
                                    <i class="glyphicon glyphicon-map-marker"></i>
                                </div>
                                <div class="pull-right">
                                    <p id="hotline">Địa Chỉ</p>
                                    <p>02 Phù Đổng - Nha Trang</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END HEADER-->


            <!--MENUNAV-->
            <div id="menunav">
                <div class="container" class="active">
                    <nav>
                        <div class="home pull-left">

                            <a href="index.php"><img style="width: 30px;height: 30px" src="<?php echo uploads() ?>thumbnail_house-xxl.png">Trang chủ</a>
                        </div>
                        <!--menu main-->
                            <ul id="menu-main" >
                            <li>
                                <a href="tintuc.php">Tin Tức</a>
                            </li>
                            <li>
                                <a href="gioithieu.php">Giới thiệu</a>
                            </li>
                        </ul>
                        
                        <!-- end menu main-->

                        <!--Shopping-->
                        <ul class="pull-right" id="main-shopping">
                            <li>
                                <a href="giohang.php"><i class="fa fa-shopping-basket"></i> Giỏ Hàng </a>
                            </li>
                        </ul>
                        <!--end Shopping-->
                    </nav>
                </div>
            </div>
            <!--ENDMENUNAV-->
            
            <div id="maincontent">
                <div class="container">
                    <div class="col-md-3  fixside" >
                        <div class="box-left box-menu" >
                            <h3 class="box-title"><i class="fa fa-list"></i>  Danh mục</h3>
                            
                            <ul>
                                <?php foreach ($danhmuc as $item): ?>
                                    <li> <a href="danhmucsanpham.php?id=<?php echo $item['maDanhMuc'] ?>"><img src="<?php echo uploads() ?>logo/<?php echo $item['logo'] ?>"></a></li>
                                
                                <?php endforeach ?>
                            </ul>
                        </div>

                        <div class="box-left box-menu">
                            <h3 class="box-title"><i class="fa fa-bolt"></i>  Sản phẩm mới </h3>
                           <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul>
                                
                                <?php foreach ($sanphamNew as $item): ?>
                                    <li class="clearfix">
                                    <a href="chitietsanpham.php?id=<?php echo $item['maSanPham'] ?>">
                                        <img src="<?php echo uploads()?>sanpham/<?php echo $item['hinhAnhSanPham']?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name" style="width: 120px"><b> <?php echo $item['tenSanPham'] ?></b></p >
                                            <?php if ($item['sale']>0): ?>
                                                <p><strike class="sale"><?php echo number_format($item['giaSanPham'])?> VND</strike></br> <b class="price"><?php echo formatpricesale($item['giaSanPham'],$item['sale']) ?> VND</b></p></p>
                                            <?php else : ?>
                                                <p> <b class="price"><?php echo number_format($item['giaSanPham']) ?> VND</b></p></p>
                                            <?php endif ?>
                                            <span class="view"><i class="fa fa-eye"></i> <?php echo $item['luotxem'] ?> </span>
                                            
                                                <span class="view" style="margin-left: 20px"><i class="fa fa-commenting"></i> <?php echo $item['luotbl'] ?> </span>
                                            
                                            <?php endforeach ?>
                                        </div>
                                    </a>
                                </li>
                                
                           
                            </ul>
                            <!-- </marquee> -->
                        </div>

                        <div class="box-left box-menu">
                            <h3 class="box-title"><i class="fa fa-bolt"></i>  Sản Phẩm Bán Chạy </h3>
                           <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul>
                                
                                <?php foreach ($sanphamPay as $item): ?>
                                    <li class="clearfix">
                                    <a href="chitietsanpham.php?id=<?php echo $item['maSanPham'] ?>">
                                        <img src="<?php echo uploads()?>sanpham/<?php echo $item['hinhAnhSanPham']?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"><b> <?php echo $item['tenSanPham'] ?></b></p >
                                            <?php if ($item['sale']>0): ?>
                                                <p><strike class="sale"><?php echo number_format($item['giaSanPham'])?> VND</strike></br> <b class="price"><?php echo formatpricesale($item['giaSanPham'],$item['sale']) ?> VND</b></p></p>
                                            <?php else : ?>
                                                <p> <b class="price"><?php echo number_format($item['giaSanPham']) ?> VND</b></p></p>
                                            <?php endif ?>
                                            <span class="view"><i class="fa fa-eye"></i> <?php echo $item['luotxem'] ?> </span>
                                            
                                           <span class="view" style="margin-left: 20px"><i class="fa fa-commenting"></i> <?php echo $item['luotbl'] ?> </span>
                                           <?php endforeach ?>
                                        </div>
                                    </a>
                                </li>
                                
                               
                            </ul>
                            <!-- </marquee> -->
                        </div>
                    </div>