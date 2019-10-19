<?php require_once __DIR__. "/autoload/autoload.php"; 

        $id = intval(getInput('id'));
        $suadanhmuc = $db->fetchID("danhmuc","maDanhMuc",$id);

        if(isset($_GET['p']))
        {
            $p = $_GET['p'];
        }
        else {
            $p = 1;
        }

        $sql="SELECT * FROM sanpham WHERE maDanhMuc_S=$id ";
        $total=count($db->fetchsql($sql));
        $sanpham=$db->fetchJones("sanpham",$sql,$total,$p,8,true);
        $sotrang=$sanpham['page'];
        unset($sanpham['page']);

        $path=$_SERVER['SCRIPT_NAME'];


?>
    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">

            <section class="box-main1">
                <h3 class="title-main" style="text-align: center;"> <img src="<?php echo uploads() ?>logo/<?php echo $suadanhmuc['logo'] ?>"></h3>
                <div class="showitem clearfix">
                    <?php foreach ($sanpham as $item): ?>
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
                                    <p><a href="themgiohang.php?id=<?php echo $item['maSanPham'] ?>"><i class="fa fa-shopping-basket"></i></a></p>
                                </div>
                            </div>
                        <?php endforeach ?>
                </div>
                <nav class="text-center">
                        <ul class="pagination">
                          <?php for ($i=1; $i <= $sotrang ; $i++): ?>
                                <li class="page-item <?php echo isset($_GET['p']) && $_GET['p'] == $i ? 'active' : '' ?>"><a class="page-link" href="<?php echo $path ?>?id=<?php echo $id ?>&&p=<?php echo $i ?>"><?php echo $i; ?></a></li>
                          <?php endfor; ?>
                          
                        </ul>
                    </nav>
            </div>
                <!-- Nội dung -->
            </section>
        </div>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>