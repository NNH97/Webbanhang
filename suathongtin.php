<?php require_once __DIR__. "/autoload/autoload.php"; 
		$id=intval(getInput('id'));
		$thanhvientt=$db->fetchID("thanhvien","maTaiKhoan",$id);
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      $data =
       [
         "hoTen" => postInput('hoTen'),
         "diaChi" => postInput('diaChi'),
         "soDienThoai" => postInput('soDienThoai'),
         "email" => postInput('email'),
       ];

       $error = [];

        if (postInput('hoTen') == '' )
        {
          $error['hoTen'] = "Bạn chưa nhập họ tên";
        }

        if (postInput('diaChi') == '' )
        {
          $error['diaChi'] = "Bạn chưa nhập địa chỉ";
        }

        if (postInput('soDienThoai') == '' )
        {
          $error['soDienThoai'] = "Bạn chưa nhập số điện thoại";
        }

        if (postInput('email') == '' )
        {
            $error['email'] = "Mời bạn nhập email";
        }
        else
        {
          $email = $thanhvientt['email'];
          $is_check=$db->fetchOne("thanhvien","email='".$data['email']."' AND email != '$email' ");
          if($is_check!=NULL)
          {
                $error['email']="Email đã tồn tại. Mời bạn nhập địa chỉ email khác.";
          }
        }
        if(empty($error))
        {
          $id_update = $db->update("thanhvien",$data,array("maTaiKhoan"=>$id));
          if($id_update > 0)
          {
            echo "<script>alert('Đổi thông tin thành công');location.href='thongtin.php?id=$id'</script>";
          }
         else
         {
          $_SESSION['error'] = "Đổi thông tin thất bại";
          redirect("thongtin.php?id=$id");
         }
        }
    }

?>

    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">
            <section class="box-main1">
                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Thông Tin </a> </h3>
                <div class="col-lg-12" style="margin-top: 50px">
            <div class="col-xs-12 col-sm-4" >
              <figure>
                <img class="img-circle img-responsive" alt="" src="<?php echo uploads() ?>150x150.png">
              </figure>
            </div>
               <!--  <div class="clearfix">
                        <?php if(isset($_SESSION['error'])) :?>
                      <div class="alert alert-danger">
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                      </div>
                </div>
                <?php endif ?> -->
            <form action="" method="POST">
            <div class="col-xs-12 col-sm-8">
              <ul class="list-group">
                <li class="list-group-item" style="font-size: 15px">Họ Tên : <input type="text" name="hoTen" value="<?php echo $thanhvientt['hoTen'] ?>">
                <?php if (isset($error['hoTen'])): ?>
                      <p class="text-danger"> <?php echo $error['hoTen']?></p>
                <?php endif?>
                </li>
                
                <li class="list-group-item" style="font-size: 15px">Địa Chỉ : <input type="text" name="diaChi" value="<?php echo $thanhvientt['diaChi'] ?>">
                <?php if (isset($error['diaChi'])): ?>
                      <p class="text-danger"> <?php echo $error['diaChi']?></p>
                <?php endif?>
                </li>
                <!-- <li class="list-group-item">Google Inc. </li> -->
                <li class="list-group-item" style="font-size: 15px"><i class="fa fa-phone"></i> <input type="tel" pattern="^0[0-9\s.-]{9,13}" name="soDienThoai" value="<?php echo $thanhvientt['soDienThoai'] ?>"> 
                <?php if (isset($error['soDienThoai'])): ?>
                      <p class="text-danger"> <?php echo $error['soDienThoai']?></p>
                <?php endif?>
                </li>
                <li class="list-group-item" style="font-size: 15px"><i class="fa fa-envelope"></i> <input type="email" name="email" value="<?php echo $thanhvientt['email'] ?>">
                <?php if (isset($error['email'])): ?>
                      <p class="text-danger"> <?php echo $error['email']?></p>
                <?php endif?>
                </li>
              </ul>
            </div>

          </div>
          				<div class="action" style="margin-left: 300px">
							<button class="add-to-cart btn btn-default" name="suatt" type="submit">Lưu </button>
							<a href="index.php" class="btn btn-danger" type="button">Thoát</a>
						</div>
            </form>
                <!-- Nội dung -->
            </section>
        </div>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>