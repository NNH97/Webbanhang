
<?php 
   session_start();
   require_once __DIR__. "/../../libraries/Database.php";
   require_once __DIR__. "/../../libraries/Function.php";

   $db = new Database;
   $data=
        [    
            'taiKhoan'     =>postInput("taiKhoan"),
            'matKhau'  =>(postInput("matKhau"))    
        ];

   if($_SERVER["REQUEST_METHOD"]=="POST")
      {
          
          
              $is_check=$db->fetchOne("thanhvien","taikhoan='".$data['taiKhoan']."' AND matKhau='".md5($data['matKhau'])."' AND maQuyen_S=1 ");
              if($is_check!=NULL)
              {
                  $_SESSION['ten_tv']  =$is_check['hoTen'];
                  $_SESSION['ma_tv']    =$is_check['maTaiKhoan'];
                  $_SESSION['quyen'] = $is_check['maQuyen_S'];
                  echo "<script>alert('Đăng nhập thành công');location.href='/websitebanlaptop/admin'</script>";
              }
              else
              {
                  $_SESSION['error']="Đăng nhập thất bại !";
              }
          
      }




 ?>


<link href="bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="bootstrap.min.js"></script>
<script src="jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">

<!------ Include the above in your HEAD tag ---------->

<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
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
            <img id="profile-img" class="profile-img-card" src="<?php echo uploads() ?>avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" name="taiKhoan" id="inputEmail" class="form-control" placeholder="Tài Khoản" required autofocus>
      
                <input type="password" name="matKhau" id="inputPassword" class="form-control" placeholder="Mật Khẩu" required>
                
                <div id="remember" class="checkbox">
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Đăng Nhập</button>
            </form><!-- /form -->
            <!-- <a href="#" class="forgot-password">
                Forgot the password?
            </a> -->
        </div><!-- /card-container -->
    </div><!-- /container -->