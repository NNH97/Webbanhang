<?php require_once __DIR__. "/autoload/autoload.php"; 

		if($_SERVER["REQUEST_METHOD"]=="GET")
		{
            $gia = getInput('gia');
			$keyword=getInput('txttimkiem');

            switch ($gia) {
                case '1':
                    $sql = "SELECT * FROM sanpham WHERE tenSanPham LIKE '%$keyword%' AND ((100-sale)*giaSanPham/100)<10000000";
                    break;
                case '2':
                    $sql = "SELECT * FROM sanpham WHERE tenSanPham LIKE '%$keyword%' AND ((100-sale)*giaSanPham/100)>20000000 AND ((100-sale)*giaSanPham/100)<30000000";
                    break;
                    case '3':
                    $sql = "SELECT * FROM sanpham WHERE tenSanPham LIKE '%$keyword%' AND ((100-sale)*giaSanPham/100)>20000000";
                    break;
                default:
                    $sql = "SELECT * FROM sanpham WHERE tenSanPham LIKE '%$keyword%'";
                    break;
            }
			// $sql = "SELECT * FROM sanpham WHERE tenSanPham LIKE '%$keyword%'";
			$sanphamtk = $db->fetchsql($sql);
            // $rows=mysqli_query(mysqli_connect("localhost","root","","websitedienthoai"),$sql);
            // $tong = mysqli_num_rows($rows);
            $tong = $db->countSql($sql);
            if ($tong<=0) {
                echo "<script>alert('Không tìm được sản phẩm nào !');location.href='index.php'</script>";
            }
			
		}


?>
    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">
            <section class="box-main1">
                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Tìm Kiếm </a> </h3>
				<div class="showitem clearfix">
                <?php foreach ($sanphamtk as $item): ?>
                            <div class="col-md-3 item-product bor">
                                <a href="chitietsanpham.php?id=<?php echo $item['maSanPham'] ?>">
                                    <img src="<?php echo uploads()?>sanpham/<?php echo $item['hinhAnhSanPham']?>" class="" width="100%" height="180">
                                </a>
                                <div class="info-item">
                                    <a href="chitietsanpham.php?id=<?php echo $item['maSanPham'] ?>"><?php echo $item['tenSanPham'] ?></a>
                                    <p> <b class="price"><?php echo number_format($item['giaSanPham']) ?></b></p>
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
    <?php require_once __DIR__. "/layouts/footer.php"; ?>