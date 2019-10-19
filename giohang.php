<?php require_once __DIR__. "/autoload/autoload.php";
        $sum=0;

        if(!isset($_SESSION['ten_tv'])){
            echo "<script>alert('Bạn cần đăng nhập để xem giỏ hàng !');location.href='dangnhap.php'</script>";
        }

        if(!isset($_SESSION['giohang'])||count($_SESSION['giohang'])==0)
        {
            echo "<script>alert('Không có sản phẩm nào trong giỏ hàng');location.href='index.php'</script>";
        }

 ?>
    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">
            <section class="box-main1">
                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Giỏ Hàng </a> </h3>
                    <?php if(isset($_SESSION['success'])):?>
                            <div class="alert alert-success">
                                <strong style="color: #3c763d">Success!</strong><?php echo $_SESSION['success'];unset($_SESSION['success'])?>
                            </div>
                    <?php endif?>
                <!-- Nội dung -->
                <table class="table table-hover" id="shopping">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Hình Ảnh</th>
                            <th>Số Lượng</th>
                            <th>Giá</th>
                            <th>Tổng Tiền</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt=1;foreach ($_SESSION['giohang'] as $key => $value): ?>
                            <tr>
                                <td><?php echo $stt ?></td>
                                <td><?php echo $value['tenSanPham'] ?></td>
                                <td>
                                    <img src="<?php echo uploads() ?>sanpham/<?php echo $value['hinhAnhSanPham'] ?>" while="80px" height="80px">
                                </td>
                                <td>
                                    <input type="number" name="soluong" value="<?php echo $value['soluong'] ?>" class="form-control soluong" id="soluong" min="0">
                                </td>
                                <td><strong><?php echo number_format($value['giaSanPham'])?> VND</strong></td>
                                <td><strong><?php echo number_format($value['soluong']*$value['giaSanPham'])?> VND</strong> </td>
                                <td>
                                    <a href="xoagiohang.php?key=<?php echo $key ?>" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> Xoá</a>
                                    <a href="#" class="btn btn-xs btn-info updatecart" data-key=<?php echo $key?>><i class="fa fa-refresh"></i> Sửa</a>
                                </td>
                            </tr>
                            <?php $sum+=$value['giaSanPham']*$value['soluong']; $_SESSION['tongttien']=$sum;?>
                        <?php $stt++;endforeach ?>

                    </tbody>
                </table>
                <div class="col-md-5 pull-right">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h3>Thông tin đơn hàng</h3>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge"><?php echo number_format($_SESSION['tongttien'])?> VND</span>
                                        Số tiền
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge">10%</span>
                                        Thuế VAT
                                    </li>
                                    
                                    <li class="list-group-item">
                                        <span class="badge"><?php $_SESSION['total']=$_SESSION['tongttien']*110/100;echo number_format($_SESSION['total'])?> VND</span>
                                        Tổng tiền thanh toán
                                    </li>

                                    <li class="list-group-item">
                                        <a href="index.php" class="btn btn-success">Tiếp tục mua hàng</a>
                                        <a style="margin-left: 45px" href="thanhtoan.php" class="btn btn-success">Thanh toán</a>
                                    </li>
                                </ul>
                            </div>
            </section>
        </div>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>