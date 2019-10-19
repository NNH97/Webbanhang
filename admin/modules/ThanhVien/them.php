<?php 
    $open = "ThanhVien";
    require_once __DIR__. "/../../autoload/autoload.php";
    $quyen = $db->fetchAll('quyen');
    $data =
       [
         "taiKhoan" => postInput('taiKhoan'),
         "matKhau" => MD5(postInput('matKhau')),
         "hoTen" => postInput('hoTen'),
         "email" => postInput('email'),
         "diaChi" => postInput('diaChi'),
         "soDienThoai" => postInput('soDienThoai'),
         "maQuyen_S" => postInput('maQuyen_S'),
       ];
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
      {


       $error = [];

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
            $error['email']="Email đã tồn tại";
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
        if (postInput('maQuyen_S') == '' )
        {
          $error['maQuyen_S'] = "Mời bạn chọn quyền";
        }
        //error trống có nghĩa ko có lỗi 
        if(empty($error))
        {

          $id_insert = $db->insert("thanhvien",$data);
          if($id_insert)
          {
            $_SESSION['success'] = "Thêm mới thành công";
            redirectAdmin("ThanhVien");
          }
         else
         {
            $_SESSION['error'] = "Thêm mới thất bại";
         }
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
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url()?>admin/modules/ThanhVien/">Thành Viên</a>
                        </li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                    <div class="clearfix">
                        <?php if(isset($_SESSION['error'])) :?>
                            <div class="alert alert-danger">
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                            </div>
                        <?php endif ?>
                    </div>
            <div class="content-wrapper">
                <div class="container-fluid">
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                          <div class="form-group">           
                            <label for="exampleInputEmail1">Quyền</label>
                            <select class="form-control" name="maQuyen_S">
                              <option value="">----Mời bạn chọn quyền----</option>
                              <?php foreach ($quyen as $item): ?>
                                <option value="<?php echo $item['maQuyen']?> "><?php echo $item['tenQuyen'] ?></option>
                              <?php endforeach ?>
                            </select>
                            <?php if (isset($error['maQuyen_S'])): ?>
                              <p class="text-danger"> <?php echo $error['maQuyen_S']?></p>
                            <?php endif?>
                          </div>

                          <div class="form-group">           
                            <label for="exampleInputEmail1">Tài Khoản</label>
                            <input class="form-control" id="taiKhoan" type="text" placeholder="Tài Khoản" name="taiKhoan" value="<?php echo $data['taiKhoan'] ?>">
                            <?php if (isset($error['taiKhoan'])): ?>
                              <p class="text-danger"> <?php echo $error['taiKhoan']?></p>
                            <?php endif?>
                          </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Mật Khẩu</label>
                            <input class="form-control" id="matKhau" type="password" placeholder="********" name="matKhau">
                            <?php if (isset($error['matKhau'])): ?>
                              <p class="text-danger"> <?php echo $error['matKhau']?></p>
                            <?php endif?>
                            </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Nhập lại mật khẩu</label>
                            <input class="form-control" id="re_matKhau" type="password" placeholder="********" name="re_matKhau">
                            <?php if (isset($error['re_matKhau'])): ?>
                              <p class="text-danger"> <?php echo $error['re_matKhau']?></p>
                            <?php endif?>
                            </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Họ và Tên</label>
                            <input class="form-control" id="hoTen" type="text" placeholder="Họ và Tên" name="hoTen" value="<?php echo $data['hoTen'] ?>">
                            <?php if (isset($error['hoTen'])): ?>
                              <p class="text-danger"> <?php echo $error['hoTen']?></p>
                            <?php endif?>
                            </div>
                              
                            <div class="form-group">           
                            <label for="exampleInputEmail1">Email</label>
                            <input class="form-control" id="email" type="email" placeholder="Email@gmail.com" name="email" value="<?php echo $data['email'] ?>">
                            <?php if (isset($error['email'])): ?>
                              <p class="text-danger"> <?php echo $error['email']?></p>
                            <?php endif?>
                            </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Địa Chỉ</label>
                            <input class="form-control" id="diaChi" type="text" placeholder="Địa Chỉ" name="diaChi" value="<?php echo $data['diaChi'] ?>">
                            <?php if (isset($error['diaChi'])): ?>
                              <p class="text-danger"> <?php echo $error['diaChi']?></p>
                            <?php endif?>
                            </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Số Điện Thoại</label>
                            <input class="form-control" id="soDienThoai" type="tel" pattern="^0[0-9\s.-]{9,13}" placeholder="Số Điện Thoại" name="soDienThoai" value="<?php echo $data['soDienThoai'] ?>">
                            <?php if (isset($error['soDienThoai'])): ?>
                              <p class="text-danger"> <?php echo $error['soDienThoai']?></p>
                            <?php endif?>
                            </div>
                            <br>
                            
                          
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                          </div>
                          
                        </form>
                </div>
            </div>

<?php require_once __DIR__. "/../../layouts/footer.php"; ?>