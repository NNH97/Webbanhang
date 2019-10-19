<?php require_once __DIR__. "/autoload/autoload.php";

    $thanhvien=$db->fetchID("thanhvien","maTaiKhoan",intval($_SESSION['ma_tv']));
    $error = [];
    if($_SERVER["REQUEST_METHOD"]== "POST")
    {

        $data=
        [ 
            'maTaiKhoan'  =>$_SESSION['ma_tv'],
            'tenNguoiNhan'=>postInput('hoTen'),
            'emailNguoiNhan'  =>postInput('email'),
            'sdtNguoiNhan'  =>postInput('sdt'),
            'diaChiNguoiNhan'  =>postInput('diaChi'),
            'moTaDDH'  =>postInput('motaddh')
        ];
        if (postInput('hoTen') == '' )
        {
            $error['hoTen'] = "Mời bạn nhập họ tên";
        }
        if (postInput('email') == '' )
        {
            $error['email'] = "Mời bạn nhập email";
        }
        if (postInput('sdt') == '' )
        {
            $error['sdt'] = "Mời bạn nhập số điện thoại";
        }
        if (postInput('diaChi') == '' )
        {
            $error['diaChi'] = "Mời bạn nhập địa chỉ";
        }

        if (empty($error)) {
            $idtran=$db->insert("dondathang",$data);

            if ($idtran>0) 
            {
                foreach ($_SESSION['giohang'] as $key => $value) 
                {
                    $data2=
                    [
                        'maDonDatHang' =>$idtran,
                        'maSanPham'    =>$value['maSanPham'],
                        'tenSanPham'    =>$value['tenSanPham'],
                        'soluong'      =>$value['soluong'],
                        // 'giaSanPham'   =>$value['giaSanPham']           
                    ];  

                    $id_insert=$db->insert("chitietdondathang",$data2);    
                }   
                unset($_SESSION['giohang']);
                unset($_SESSION['total']);
                $_SESSION['success']="Đơn hàng của bạn đã đặt thành công ,chúng tôi sẽ gửi hàng đến bạn sớm!";
                header("location: thongbao.php");
            }
        }
        
    }



 ?>
    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">

            <section class="box-main1">
                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Thanh Toán Đơn Hàng </a> </h3>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                      <?php echo $_SESSION['error'];unset($_SESSION['error'])?>
                    </div>
                <?php endif ?>
                <form action="" method="POST" class="form-horizontal" role="form" style="margin-left: 300px;margin-top: 20px">
                        
                        <label>Họ Tên Người Nhận</label>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="text" name="hoTen" placeholder="Họ tên" class="form-control" value="<?php echo $thanhvien['hoTen'] ?>">
                                <?php if (isset($error['hoTen'])): ?>
                                    <p class="text-danger"><?php echo $error['hoTen'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                        
                        <label>Email Người Nhận</label>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $thanhvien['email'] ?>">
                                <?php if (isset($error['email'])): ?>
                                    <p class="text-danger"><?php echo $error['email'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <label>Địa Chỉ Người Nhận</label>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="text" name="diaChi" placeholder="Địa Chỉ" class="form-control" value="<?php echo $thanhvien['diaChi'] ?>">
                                <?php if (isset($error['diaChi'])): ?>
                                    <p class="text-danger"><?php echo $error['diaChi'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <label>Số Điện Thoại Người Nhận</label>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="text" name="sdt" placeholder="Số điện thoại" class="form-control" value="<?php echo $thanhvien['soDienThoai'] ?>">
                                <?php if (isset($error['sdt'])): ?>
                                    <p class="text-danger"><?php echo $error['sdt'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                        
                        <label>Ghi chú</label>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="text" name="motaddh" class="form-control" value="">
                            </div>
                        </div>
                        
                        <label>Tổng giá trị đơn hàng</label>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="text" disabled="true" name="tongdh" class="form-control" value="<?php echo number_format($_SESSION["total"])?> VND">
                            </div>
                        </div>

                        <div class="form-group">
                        <div class="col-sm-offset-0.5 col-sm-10">
                          <button type="submit" name="xacnhan" class="btn btn-info" style="margin-right: 150px">Đặt Hàng</button>
                          <button type="button" name="thoat" class="btn btn-danger">Thoát</button>
                        </div>
                      </div>
                </form>
            </section>
        </div>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>