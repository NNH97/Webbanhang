<?php require_once __DIR__. "/autoload/autoload.php"; 
		$tong=0;
	    $id = intval(getInput('id'));
	    $chitietdondathang = $db->fetchAll("chitietdondathang");
	    $sql = "SELECT * FROM chitietdondathang ctddh JOIN sanpham sp ON ctddh.maSanPham=sp.maSanPham WHERE maDonDatHang=$id";
	    $chitietdondathang = $db->fetchsql($sql);

?>
    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">
            <section class="box-main1">
                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Chi Tiết Đơn Hàng </a> </h3>
                <div class="content-wrapper" style="margin-top: 50px">
                <div class="container-fluid" >
                    <table class="table table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                        	<th scope="col">STT</th>
                            <th scope="col">Tên Sản Phẩm</th>
                            <th scope="col">Số Lượng</th>
                            <th scope="col">Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt=1; foreach ($chitietdondathang as $item): ?>
                        <tr>
                            <th scope="row"><?php echo $stt; ?></th>
                            <td>
                                <?php echo $item['tenSanPham'] ?>
                            </td>
                            <td>
                                <?php echo $item['soLuong'] ?>
                            </td>
                            <td>
                                <?php echo number_format($sum=$item['soLuong']*((100-$item['sale'])*$item['giaSanPham']/100)) . " VND" ?>
                            </td>
                        </tr>
                        <?php $tong+=$sum ?>

                        <?php $stt++; endforeach ?>
                        
                    </tbody>
                </table>
                <strong>
                       <p>Tổng giá trị của đơn hàng :</p> <?php echo number_format($tong*110/100); ?> VND
                </strong>
            </div>
                
            </section>
        </div>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>