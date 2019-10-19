<?php require_once __DIR__. "/autoload/autoload.php";
        
        $id = intval(getInput('id'));
        //lấy sản phẩm
        $sanpham = $db->fetchID("sanpham","maSanPham",$id);
        
        //Bình Luận
        $sqlBL="SELECT binhluansp.*,thanhvien.hoTen as hoten FROM binhluansp LEFT JOIN thanhvien on binhluansp.maTaiKhoan=thanhvien.maTaiKhoan WHERE binhluansp.maSanPham=$id AND view=0 ORDER BY maBinhLuan DESC";
        $binhluan=$db->fetchsql($sqlBL);
        
        //lấy mã danh mục
        $dmma=intval($sanpham['maDanhMuc_S']);
        $sql="SELECT * FROM sanpham WHERE maDanhMuc_S=$dmma ORDER BY maSanPham DESC LIMIT 4";
        $sanphamkemtheo=$db->fetchsql($sql);
        //lượt xem
        if (!isset($_SESSION['BO_DEM'])) {
            $_SESSION['BO_DEM'] = 1;
            // neu chua ton tai session bo dem moi them 1 lan xem nua
            $luotxem=$db->dem_lan_xem($id);
        }

?>
    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor" id="datasearch">
                <!-- Nội dung -->
            <section class="box-main1" >
                            <div class="col-md-6 text-center">
                                <img src="<?php echo uploads() ?>sanpham/<?php echo $sanpham['hinhAnhSanPham'] ?>" class="img-responsive bor" id="imgmain" width="100%" height="370" data-zoom-image="images/16-270x270.png">
                                   
                                </ul>
                            </div>
                            <div class="col-md-6 bor" style="margin-top: 20px;padding: 30px;">
                               <ul id="right">
                                    <li><h3> <?php echo $sanpham['tenSanPham'] ?></h3></li>
                                    <?php if($sanpham['sale']>0):?>
                                        <?php if ($sanpham['sale']>0): ?>
                                            <li><b>Khuyến mãi : </b><b style="color: red"><?php echo $sanpham['sale']."%"  ?> </b></li>
                                    <?php endif ?>
                                    
                                    <li><b>Giá  :</b><strike class="sale"><?php echo number_format($sanpham['giaSanPham'])?></strike> <b class="price"><?php echo formatpricesale($sanpham['giaSanPham'],$sanpham['sale']) ?> VND</b>
                                    <?php else:?>
                                        <li><p><b>Giá : </b><b class="price"><?php echo number_format($sanpham['giaSanPham'])?> VND</b></li>
                                    <?php endif?>

                                    <div class="fk-boxs" id="km-all" data-comt="False">
                                            <div id="km-detail">
                                                <p class="fk-tit">Khuyến mại đặc biệt (SL có hạn)</p>
                                                <div class="fk-main">
                                                     <div class="fk-sales">
                                                        <ul><li><i class="  fa fa-check-circle"></i> Tặng Balo Laptop</li></ul>
                                                        <ul><li><i class="  fa fa-check-circle"></i> Combo Sinh viên (Office 365 Personal + Lạc Việt) kèm Laptop chỉ còn 690,000đ</li></ul>
                                                        <ul><li><i class="  fa fa-check-circle"></i> Tặng PMH 600,000đ mua Windows</li></ul>
                                                        <ul><li><i class="  fa fa-check-circle"></i> Giảm 20% Combo bảo vệ Laptop (Combo MDMH và Phần mềm Diệt virus Eset) khi mua kèm máy</li></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>

                                    <li><a href="themgiohang.php?id=<?php echo $sanpham['maSanPham'] ?>" class="btn btn-default"> <i class="fa fa-shopping-basket"></i>Thêm Hàng Vào Giỏ</a></li>
                               </ul>
                            </div>

            </section>
                <div class="col-md-12" id="tabdetail">
                            <div class="row">
                                    
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Mô tả sản phẩm </a></li>
                                    <li><a data-toggle="tab" href="#menu1">Cấu hình chi tiết</a></li>
                                    
                                </ul>
                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                       
                                        <p><?php echo $sanpham['moTaSanPham'] ?></p>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <div id="home" class="tab-pane fade in active">
                                        <h2> Thông Số kỹ thuật </h2>
                                        <p><?php echo $sanpham['chiTietSanPham'] ?></p>
                                    </div>
                                    
                                </div>
                            </div>
                </div>

                <div class="col-lg-9">
                                    <form action="binhluansp.php?id=<?php echo $id ?>" method="POST">
                                    <!-- Comments Form -->
                                    <div class="well">
                                        <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                                        <form role="form">
                                            <div class="form-group">
                                                <textarea name="comment" class="form-control" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Gửi</button>
                                        </form>
                                    </div>
                                    </form>
                                    <hr>
                                   
                                    <!-- Posted Comments -->
                                    <?php foreach ($binhluan as $item): ?>
                                        
                                    
                                        <div class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="<?php echo uploads() ?>64x64.png" alt="">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><?php echo $item['hoten']; ?>
                                                <small><?php echo $item['thoiGian'] ?></small>
                                            </h4>
                                            <?php echo $item['comment'] ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Comment -->
                                    <?php endforeach ?>

                                </div>

                                
                <div class="col-md-12" style="margin-top: 40px">
                    <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Sản phẩm cùng loại </a> </h3>
                <?php foreach ($sanphamkemtheo as $item): ?>
                        
                
                        <div class="showitem">
                            <div class="col-md-3 item-product bor">
                                <a href="chitietsanpham.php?id=<?php echo $item['maSanPham'] ?>">
                                    <img src="<?php echo uploads()?>sanpham/<?php echo $item['hinhAnhSanPham']?>" class="" width="100%" height="180">
                                </a>
                                <div class="info-item">
                                    <a href="chitietsanpham.php?id=<?php echo $item['maSanPham'] ?>"><?php echo $item['tenSanPham'] ?></a>
                                   <?php if ($item['sale']>0): ?>
                                        <p><strike class="sale"><?php echo number_format($item['giaSanPham'])?></strike> <b class="price"><?php echo formatpricesale($item['giaSanPham'],$item['sale']) ?> VND</b></p></p>
                                    <?php else : ?>
                                        <p> <b class="price"><?php echo number_format($item['giaSanPham']) ?> VND</b></p></p>
                                    <?php endif ?>
                                </div>
                                <div class="hidenitem">
                                    <p><a href="chitietsanpham.php?id=<?php echo $item['maSanPham'] ?>"><i class="fa fa-search"></i></a></p>
                                </div>
                            </div>
                        </div>
                <?php endforeach ?>
                </div>
            </section>
        </div>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>