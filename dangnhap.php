<?php require_once __DIR__. "/autoload/autoload.php"; 

        if(isset($_SESSION['ten_tv'])){
            echo "<script>alert('Bạn đã có tài khoản không thể vào đây !');location.href='index.php'</script>";
        }

        $data=
        [    
            'taiKhoan'     =>postInput("taiKhoan"),
            'matKhau'  =>(postInput("matKhau"))    
        ];

        $error=[];
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                if (postInput('taiKhoan') == '' )
                {
                    $error['taiKhoan'] = "Mời bạn nhập đầy đủ tên tài khoản";
                }
                
             
                if (postInput('matKhau') == '' )
                {
                    $error['matKhau'] = "Mời bạn nhập mật khẩu";
                }
                if (empty($error)) 
                {
                    $is_check=$db->fetchOne("thanhvien","taikhoan='".$data['taiKhoan']."' AND matKhau='".md5($data['matKhau'])."'");
                    if($is_check!=NULL)
                    {
                        $_SESSION['ten_tv']  =$is_check['hoTen'];
                        $_SESSION['ma_tv']    =$is_check['maTaiKhoan'];
                        $_SESSION['quyen'] = $is_check['maQuyen_S'];
                        echo "<script>alert('Đăng nhập thành công');location.href='index.php'</script>";
                    }
                    else
                    {
                        $_SESSION['error']="Đăng nhập thất bại !";
                    }
                }
            }





?>
    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">
            
            <section class="box-main1">
                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Đăng nhập </a> </h3>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success" role="alert">
                      <?php echo $_SESSION['success'];unset($_SESSION['success'])?>
                    </div>
                <?php endif ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                      <?php echo $_SESSION['error'];unset($_SESSION['error'])?>
                    </div>
                    
                <?php endif ?>

                <form action="" method="POST" class="form-horizontal" role="form" style="margin-left: 300px;margin-top: 20px">
                        <label>Tài khoản</label>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="text" name="taiKhoan" placeholder="Tài Khoản" class="form-control" value="<?php echo $data['taiKhoan'] ?>">
                                <?php if (isset($error['taiKhoan'])): ?>
                                    <p class="text-danger"><?php echo $error['taiKhoan'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                        
                        <label>Mật khẩu</label>
                        <div class="form-group">
                            <div class="col-md-7">
                                <input type="password" name="matKhau" placeholder="Mật khẩu" class="form-control">
                                <?php if (isset($error['matKhau'])): ?>
                                    <p class="text-danger"><?php echo $error['matKhau'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group">
                        <div class="col-sm-offset-0.5 col-sm-10">
                          <button type="submit" class="btn btn-info" style="margin-right: 150px">Đăng Nhập</button>
                          <a href="index.php"><button type="button" class="btn btn-danger">Thoát</button></a>
                        </div>
                      </div>
                </form>
                <!-- Nội dung -->
            </section>
        </div>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>