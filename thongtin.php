<?php require_once __DIR__. "/autoload/autoload.php"; 
		$id=intval(getInput('id'));
		$thanhvientt=$db->fetchID("thanhvien","maTaiKhoan",$id);


?>

    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">
            <section class="box-main1">
                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Thông Tin </a> </h3>
                <div class="col-lg-12" style="margin-top: 50px">
                	<div class="clearfix">
                        <?php if(isset($_SESSION['error'])) :?>
                      <div class="alert alert-danger">
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                      </div>
                </div>
                <?php endif ?>
            <div class="col-xs-12 col-sm-4" >
              <figure>
                <img class="img-circle img-responsive" alt="" src="<?php echo uploads() ?>150x150.png">
              </figure>
              
              
            </div>

            <div class="col-xs-12 col-sm-8">
              <ul class="list-group">
                <li class="list-group-item" style="font-size: 15px">Họ Tên : <?php echo $thanhvientt['hoTen'] ?></li>
                <li class="list-group-item" style="font-size: 15px">Địa Chỉ : <?php echo $thanhvientt['diaChi'] ?></li>
                <!-- <li class="list-group-item">Google Inc. </li> -->
                <li class="list-group-item" style="font-size: 15px"><i class="fa fa-phone"></i> <?php echo $thanhvientt['soDienThoai'] ?> </li>
                <li class="list-group-item" style="font-size: 15px"><i class="fa fa-envelope"></i> <?php echo $thanhvientt['email'] ?></li>
              </ul>
            </div>

          </div>
          				<div class="action" style="margin-left: 300px">
							<a href="suathongtin.php?id=<?php echo $_SESSION['ma_tv'] ?>" class="add-to-cart btn btn-default" type="button">Sửa Thông Tin</a>
							<a href="doimatkhau.php?id=<?php echo $_SESSION['ma_tv'] ?>" class="like btn btn-default" type="button">Đổi Mật Khẩu</a>
						</div>
                <!-- Nội dung -->
            </section>
        </div>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>