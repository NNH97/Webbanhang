<?php 
    $open = "DonHang";
    require_once __DIR__. "/../../autoload/autoload.php";

    //$dondathang = $db->fetchAll("dondathang");
    $chitietdondathang = $db->fetchAll("chitietdondathang");
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {

        $ngaydau= postInput('txtngaydau');
        $ngaycuoi= postInput('txtngaycuoi').' 23:59:59';

        $sqltimkiem = "SELECT * FROM dondathang WHERE ngayTao BETWEEN '$ngaydau' AND '$ngaycuoi' ";
        $timkiemdonhang=$db->fetchsql($sqltimkiem);
        
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
                        <li class="breadcrumb-item" >
                        <a href="<?php echo base_url()?>admin/modules/DonHang/">Đơn Hàng</a></li>
                        <li class="breadcrumb-item active">Tìm Kiếm</li>
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
           <p> </p>

           <form class="" action="timkiem.php" style="margin-top: 30px;margin-bottom: 30px" method="POST">
              <div class="input-group" >
                <p><b>Từ ngày :</b></p>
                <input style="width: 300px" type="date" name="txtngaydau" class="form-control">
                <p><b>Tới ngày :</b></p>
                <input style="width: 300px" type="date" name="txtngaycuoi" class="form-control">
                <div class="input-group-append">
                  <button  name="thongke" class="btn btn-primary" type="submit"><b>Tìm kiếm</b>
                  </button>
                </div>
              </div>
            </form>

            <div class="content-wrapper">
                <div class="container-fluid" >
                    <table class="table table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Mã đơn</th>
                            <th scope="col">Đơn hàng</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($timkiemdonhang as $item): ?>
                        <tr>
                            <th scope="row"><?php echo $item['maDonDatHang'] ?></th>
                            <td>
                                <ul>
                                    <li><b>Tên người nhận : </b><?php echo $item['tenNguoiNhan'] ?></li>
                                    <li><b>Số điện thoại người nhận : </b><?php echo $item['sdtNguoiNhan'] ?></li>
                                    <li><b>Email người nhận : </b><?php echo $item['emailNguoiNhan'] ?></li>
                                    <li><b>Địa Chỉ người nhận : </b><?php echo $item['diaChiNguoiNhan'] ?></li>
                                    <li><b>Mô tả : </b><?php echo $item['moTaDDH'] ?></li>
                                    <li><b>Ngày tạo đơn hàng : </b><?php echo $item['ngayTao'] ?></li>
                                </ul>
                            </td>
                            <td>
                                <a style="margin-top: 50px" href="xulydonhang.php?id=<?php echo $item['maDonDatHang'] ?>" class="btn btn-xs <?php echo $item['trangThai']==0 ? 'btn-danger' : ($item['trangThai']==1 ? 'btn-info' : 'btn-success') ?>"><?php echo $item['trangThai']==0 ? 'Chưa xử lý': ($item['trangThai']==1 ? 'Đã xử lý' : "Đã giao hàng") ?></a>
                            </td>
                            <td>
                                <a style="margin-top: 50px" class="btn btn-sm btn-danger" href="xoa.php?id=<?php echo $item['maDonDatHang'] ?>"> <i class="fa fa-times"></i> Xoá</a>
                                <a style="margin-top: 50px" class="btn btn-sm btn-info" href="xemchitiet.php?id=<?php echo $item['maDonDatHang'] ?>"> <i class=" fa fa-edit"></i> Xem Chi Tiết</a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                
            </div>
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>