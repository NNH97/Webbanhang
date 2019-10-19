<?php require_once __DIR__. "/autoload/autoload.php"; 
        
        if(isset($_SESSION['ten_tv'])){
            echo "<script>alert('Bạn đã có tài khoản không thể vào đây !');location.href='index.php'</script>";
        }

        $data =
        [
            "taiKhoan" => postInput('taiKhoan'),
            "matKhau" => MD5(postInput('matKhau')),
            "hoTen" => postInput('hoTen'),
            "email" => postInput('email'),
            "diaChi" => postInput('diaChi'),
            "soDienThoai" => postInput('soDienThoai'),
        ];
        $error = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (postInput('taiKhoan') == '' )
        {
            $error['taiKhoan'] = "Mời bạn nhập đầy đủ tên tài khoản";
        }
        else
        {
          $is_check1=$db->fetchOne("thanhvien","taiKhoan='".$data['taiKhoan']."'");
          if($is_check1!=NULL)
          {
                $error['taiKhoan']="Tài khoản này đã tồn tại.Bạn vui lòng nhập tài khoản khác";
          }
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

        if (postInput('hoTen') == '' )
        {
            $error['hoTen'] = "Mời bạn nhập đầy đủ họ tên";
        }

        if (postInput('email') == '' )
        {
            $error['email'] = "Mời bạn nhập email";
        }
        else
        {
          $is_check=$db->fetchOne("thanhvien","email='".$data['email']."'");
          if($is_check!=NULL)
          {
                $error['email']="Email đã tồn tại. Mời bạn nhập địa chỉ email khác.";
          }
        }

        if (postInput('diaChi') == '' )
        {
            $error['diaChi'] = "Mời bạn nhập địa chỉ";
        }
        if (postInput('soDienThoai') == '' )
        {
            $error['soDienThoai'] = "Mời bạn nhập số điện thoại";
        }


        if(empty($error))
        {

          $id_insert = $db->insert("thanhvien",$data);
          if($id_insert>0)
          {
            $_SESSION['success'] = "Cảm ơn bạn đã đăng ký làm thành viên của cửa hàng chúng tôi !";
            header("location: dangnhap.php");
          }
         else
         {
            $_SESSION['error'] = "Đăng ký thất bại !";

         }
        }
    }


?>
    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">

            <section class="box-main1">
                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Đăng Ký Thành Viên </a> </h3>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                      <?php echo $_SESSION['error'];unset($_SESSION['error'])?>
                    </div>
                    
                <?php endif ?>
                <form action="" method="POST" class="form-horizontal" role="form" style="margin-left: 300px;margin-top: 20px">
                        <label>Tài khoản </label><b style="color: red">(*)</b>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="text" name="taiKhoan" placeholder="Tài Khoản" class="form-control" value="<?php echo $data['taiKhoan'] ?>">
                                <?php if (isset($error['taiKhoan'])): ?>
                                    <p class="text-danger"><?php echo $error['taiKhoan'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                        
                        <label>Mật khẩu</label><b style="color: red">(*)</b>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="password" name="matKhau" placeholder="Mật khẩu" class="form-control">
                                <?php if (isset($error['matKhau'])): ?>
                                    <p class="text-danger"><?php echo $error['matKhau'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <label>Nhập Lại Mật khẩu</label><b style="color: red">(*)</b>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="password" name="re_matKhau" placeholder="Mật khẩu" class="form-control">
                                <?php if (isset($error['re_matKhau'])): ?>
                                    <p class="text-danger"><?php echo $error['re_matKhau'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                        
                        <label>Họ Tên</label><b style="color: red">(*)</b>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="text" name="hoTen" placeholder="Họ tên" class="form-control" value="<?php echo $data['hoTen'] ?>">
                                <?php if (isset($error['hoTen'])): ?>
                                    <p class="text-danger"><?php echo $error['hoTen'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                        
                        <label>Email</label><b style="color: red">(*)</b>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $data['email'] ?>">
                                <?php if (isset($error['email'])): ?>
                                    <p class="text-danger"><?php echo $error['email'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <label>Địa Chỉ</label><b style="color: red">(*)</b>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="text" name="diaChi" placeholder="Địa Chỉ" class="form-control" value="<?php echo $data['diaChi'] ?>">
                                <?php if (isset($error['diaChi'])): ?>
                                    <p class="text-danger"><?php echo $error['diaChi'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <label>Số điện thoại</label><b style="color: red">(*)</b>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="tel" name="soDienThoai" placeholder="Số điện thoại" pattern="^0[0-9\s.-]{9,13}" class="form-control" value="<?php echo $data['soDienThoai'] ?>">
                                <?php if (isset($error['soDienThoai'])): ?>
                                    <p class="text-danger"><?php echo $error['soDienThoai'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group">
                        <div class="col-sm-offset-0.5 col-sm-10">
                          <button type="submit" name="dangky" class="btn btn-info" style="margin-right: 150px">Đăng ký</button>
                          <a href="index.php"><button type="button" name="thoat" class="btn btn-danger">Thoát</button></a>
                        </div>
                      </div>
                </form>
                <!-- Nội dung -->
            </section>
        </div>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>