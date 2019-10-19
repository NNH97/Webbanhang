<?php 
    $open = "ThongKe";
    require_once __DIR__. "/../../autoload/autoload.php";
    $doanhthu = 0;
    $tongddh = 0;
    $tongsp = 0;
    $sanpham = $db->fetchAll("sanpham");
    $chitietddh = $db->fetchAll("chitietdondathang");
    // foreach ($dondathang as $item) {
    //     $date = $item['ngayTao'];
    // }
    // // _debug($dondathang);
    // echo date("Y-m-d", strtotime($date));
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {

        $ngaydau= postInput('txtngaydau');
        $ngaycuoi= postInput('txtngaycuoi').' 23:59:59';

        $sql = "SELECT dondathang.*,chitietdondathang.tenSanPham as tensp,SUM(chitietdondathang.soLuong) as soluong,sanpham.sale,sanpham.maSanPham,sanpham.giaSanPham FROM dondathang LEFT JOIN chitietdondathang ON dondathang.maDonDatHang = chitietdondathang.maDonDatHang LEFT JOIN sanpham ON chitietdondathang.maSanPham = sanpham.maSanPham WHERE ngayTao BETWEEN '$ngaydau' AND '$ngaycuoi' AND dondathang.maDonDatHang=chitietdondathang.maDonDatHang AND dondathang.trangthai = 2 GROUP BY chitietdondathang.tenSanPham";
        $sql2="SELECT * FROM dondathang WHERE ngayTao BETWEEN '$ngaydau' AND '$ngaycuoi' AND trangthai = 2";

        $tongddh = $db->countSql($sql2);

        $dondathang = $db->fetchsql($sql);
        foreach ($dondathang as $item) {
            $doanhthu += $item['soluong']*((100-$item['sale'])*$item['giaSanPham']/100);
        }
        
        
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
                        <li class="breadcrumb-item active">Thống kê</li>
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
           
            <form class="" action="" style="margin-top: 30px;margin-bottom: 30px" method="POST">
              <div class="input-group" >
                <p><b>Từ ngày :</b></p>
                <input style="width: 300px" type="date" name="txtngaydau" class="form-control">
                <p><b>Tới ngày :</b></p>
                <input style="width: 300px" type="date" name="txtngaycuoi" class="form-control">
                <div class="input-group-append">
                  <button  name="thongke" class="btn btn-primary" type="submit"><b>Thống Kê</b>
                  </button>
                </div>
              </div>
            </form>
            
            <div class="content-wrapper">
                <div class="container-fluid" >
                    <table class="table table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <!-- <th scope="col">Đơn Đặt Hàng</th>
                            <th scope="col">Doanh Thu</th> -->
                            <th scope="col">Sản Phẩm</th>
                            <th scope="col">Số lượng bán được</th>
                            <th scope="col">Giá </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($dondathang)): ?>
                            
                        
                        <?php foreach ($dondathang as $item): ?>
                        <tr>
                            <!-- <td><?php echo $tongddh; ?></td>
                            <td><?php echo $doanhthu; ?></td> -->
                            
                                <td><?php echo $item['tensp'] ?></td>
                                <td><?php echo $item['soluong']  ?></td>
                                <td><?php echo number_format($item['soluong']*((100-$item['sale'])*$item['giaSanPham']/100)) .' VND' ?></td>
                        </tr>
                        <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if (isset($_POST['thongke'])): ?>
                    
                
                    <strong>
                           Tổng doanh thu từ <?php echo $ngaydau ?> đến <?php echo $ngaycuoi ?> :<b style="color: red"> <?php echo number_format($doanhthu*110/100); ?> VND</b>
                    </strong>
                    <strong>
                           <p>Tổng đơn đặt hàng từ <?php echo $ngaydau ?> đến <?php echo $ngaycuoi ?> :<b style="color: red"> <?php echo $tongddh ?> Đơn</b></p>
                    </strong>
                 <?php endif ?>
                </div>
                
            </div>
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>