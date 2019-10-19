<?php require_once __DIR__. "/autoload/autoload.php"; 
		$id=intval(getInput('id'));
		$thanhvientt=$db->fetchID("thanhvien","maTaiKhoan",$id);
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      $data =
       [
         "matKhau" => MD5(postInput('matKhau')),
       ];

       $error = [];

        if (MD5(postInput('matKhauCu')) != $thanhvientt['matKhau']) {
          $error['matKhauCu'] = "Mật khẩu cũ không khớp";
        }

        if (postInput('matKhau') == '' )
        {
            $error['matKhau'] = "Mời bạn nhập mật khẩu";
        }

        if (postInput('re_matKhau') == '' )
        {
            $error['re_matKhau'] = "Mời bạn nhập lại mật khẩu";
        }

        if ($data['matKhau'] != MD5(postInput("re_matKhau")))
        {
            $error['matKhau'] = "Mật khẩu không khớp";
        }
        if(empty($error))
        {
          $id_update = $db->update("thanhvien",$data,array("maTaiKhoan"=>$id));
          if($id_update > 0)
          {
            echo "<script>alert('Đổi mật khẩu thành công');location.href='thongtin.php?id=$id'</script>";
          }
         else
         {
          $_SESSION['error'] = "Đổi mật khẩu thất bại";
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
                <div class="clearfix">
                        <?php if(isset($_SESSION['error'])) :?>
                      <div class="alert alert-danger">
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                      </div>
                </div>
                <?php endif ?>
            <form action="" method="POST">
            <div class="col-xs-12 col-sm-8">
              <ul class="list-group">

                <li class="list-group-item" style="font-size: 15px">Mật Khẩu Cũ : <input style="width: 210px" type="password" name="matKhauCu">
                <?php if (isset($error['matKhauCu'])): ?>
                      <p class="text-danger"> <?php echo $error['matKhauCu']?></p>
                <?php endif?>
                </li>

                <li class="list-group-item" style="font-size: 15px">Mật Khẩu : <input style="width: 230px" type="password" name="matKhau">
                <?php if (isset($error['matKhau'])): ?>
                      <p class="text-danger"> <?php echo $error['matKhau']?></p>
                <?php endif?>
                </li>
                
                <li class="list-group-item" style="font-size: 15px">Nhập Lại Mật Khẩu : <input type="password" name="re_matKhau">
                <?php if (isset($error['re_matKhau'])): ?>
                      <p class="text-danger"> <?php echo $error['re_matKhau']?></p>
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