<?php 
    require_once __DIR__. "/autoload/autoload.php";
    unset($_SESSION['BO_DEM']);
    $sqlViewCate="SELECT * FROM sanpham WHERE view = 0";
    $sanphamView=$db->fetchsql($sqlViewCate);
    $sqlbanner="SELECT * FROM banner WHERE banneractive=1";
    $banner=$db->fetchsql($sqlbanner);
    $sqlactive="SELECT * FROM banner WHERE banneractive=0";
    $banneractive=$db->fetchsql($sqlactive);
    // unset($_SESSION['giohang']);
    if(isset($_GET['p']))
        {
            $p = $_GET['p'];
        }
        else {
            $p = 1;
        }

    $sql="SELECT * FROM sanpham ";
    $total=count($sanphamView);
    $sanpham=$db->fetchJones("sanpham",$sql,$total,$p,16,true);
    $sotrang=$sanpham['page'];
    unset($sanpham['page']);
    $path=$_SERVER['SCRIPT_NAME'];

 ?>
    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">
            <section id="slide"  >
                <!-- slider -->
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                
                                    
                                
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <?php foreach ($banneractive as $item1): ?>
                                    <div class="item active">
                                        <img class="slide-image" src="<?php echo uploads()?>banner/<?php echo $item1['anhBanner'] ?>" alt="" style="width: 900px;height: 300px">
                                    </div>
                                    <?php endforeach ?>
                                    <?php foreach ($banner as $item): ?>
                                        <div class="item">
                                        <img class="slide-image" src="<?php echo uploads()?>banner/<?php echo $item['anhBanner']?>" alt="" style="width: 900px;height: 300px">
                                        </div>
                                    <?php endforeach ?>
                                    
                                    <!-- <div class="item">
                                        <img class="slide-image" src="<?php echo base_url()?>public/frontend/images/slide/636935371432149781.png" alt="" style="width: 900px;height: 300px">
                                    </div> -->
                                    
                                </div>
                                
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                    <!-- end slide -->

                <!-- <img src="<?php echo base_url()?>public/frontend/images/slide/636923513074321043_H1.jpg" class="img-thumbnail"> -->
            </section>

            <section class="box-main1">
                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"><img style="width: 40px;height: 40px" src="<?php echo uploads() ?>unnamed.jpg"> Tất cả sản phẩm </a> </h3>
                <?php foreach ($sanpham as $item): ?>
                        <div class="showitem">
                            <div class="col-md-3 item-product bor">
                                <a href="chitietsanpham.php?id=<?php echo $item['maSanPham'] ?>">
                                    <img src="<?php echo uploads()?>sanpham/<?php echo $item['hinhAnhSanPham']?>" class="" width="100%" height="180">
                                    <?php if ($item['sale']>0): ?>
                                        <span class="product-tren">- <?php echo $item['sale'] ?> %</span>
                                    <?php endif ?>
                                    
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
                                    <p><a href="themgiohang.php?id=<?php echo $item['maSanPham'] ?>"><i class="fa fa-shopping-basket"></i></a></p>
                                </div>
                            </div>
                            <?php endforeach ?>
                    </div>
            </section>
        </div>
        <div class="showpage">
            <nav class="text-center">
                        <ul class="pagination">
                          <?php for ($i=1; $i <= $sotrang ; $i++): ?>
                                <li class="page-item <?php echo isset($_GET['p']) && $_GET['p'] == $i ? 'active' : '' ?>"><a class="page-link" href="<?php echo $path ?>?p=<?php echo $i ?>"><?php echo $i; ?></a></li>
                          <?php endfor; ?>
                          
                        </ul>
                    </nav>
        </div>
        

                
    <?php require_once __DIR__. "/layouts/footer.php"; ?>
                

                