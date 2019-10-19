<?php 
    $open = "DonHang";
    require_once __DIR__. "/../../autoload/autoload.php";
    $tong=0;
    $id = intval(getInput('id'));
    $chitietdondathang = $db->fetchAll("chitietdondathang");
    $sql = "SELECT * FROM chitietdondathang LEFT JOIN sanpham ON chitietdondathang.maSanPham = sanpham.maSanPham join dondathang on chitietdondathang.maDonDatHang = dondathang.maDonDatHang WHERE chitietdondathang.maDonDatHang=$id";
    $chitietdondathang = $db->fetchsql($sql);
    

 ?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
            <div id="content-wrapper">
                <div class="container-fluid">
                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url()?>admin/index.php">Quản lý</a>
                        </li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>admin/modules/DonHang/">Đơn Hàng</a></li>
                        <li class="breadcrumb-item active">Xem Chi Tiết</li>
                    </ol>
            <div class="clearfix"></div>
           

            <div class="content-wrapper">
                <div class="container-fluid" >
                    <table class="table table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                        	<th scope="col">Mã Đơn Đặt Hàng</th>
                            <th scope="col">Tên Sản Phẩm</th>
                            <th scope="col">Số Lượng</th>
                            <th scope="col">Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($chitietdondathang as $item): ?>
                        <tr>
                            <th scope="row"><?php echo $item['maDonDatHang'] ?></th>
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

                        <?php if (isset($item['nguoiXuLy']) && $item['nguoiXuLy']!='Null'): ?>
                             <?php $nguoixuly=$item['nguoiXuLy'] ?>
                        <?php endif ?>
                       

                        <?php endforeach ?>
                        
                    </tbody>
                </table>
                <strong>
                       <p>Tổng giá trị của đơn hàng :<b style="margin-left: 20px"><?php echo number_format($tong*110/100); ?> </b>VND</p> 
                       <?php if (isset($nguoixuly)): ?>
                           <p>Người xử lý đơn hàng :<b style="margin-left: 20px;color: red"><?php echo $nguoixuly ?></b></p>
                       <?php endif ?>
                        
                </strong>
            </div>
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>