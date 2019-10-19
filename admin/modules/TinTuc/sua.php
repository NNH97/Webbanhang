<?php 
    $open = "TinTuc";
    require_once __DIR__. "/../../autoload/autoload.php";
    $tintuc = $db->fetchAll('tintuc');
    $id = intval(getInput('id'));
    $suatintuc = $db->fetchID("tintuc","maTinTuc",$id);
    if(empty($suatintuc))
    {
      $_SESSION["error"] = "Dữ liệu không tồn tại ";
      redirectAdmin("TinTuc");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
      {

       $data =
       [
         "tieuDe" => postInput('tieuDe'),
         "noiDungNgan" => postInput('noiDungNgan'),
         "noiDung" => postInput('noiDung'),
         "tacGia" => postInput('tacGia'),
         // "hinhAnh" => postInput('hinhAnh'),
       ];

       $error = [];

        if (postInput('tieuDe') == '' )
        {
          $error['tieuDe'] = "Mời bạn nhập đầy đủ tên Sản phẩm";
        }

        if (postInput('noiDungNgan') == '' )
        {
          $error['noiDungNgan'] = "Mời bạn nhập giá sản phẩm";
        }

        if (postInput('noiDung') == '' )
        {
          $error['noiDung'] = "Mời bạn nhập mô tả sản phẩm";
        }

        //error trống có nghĩa ko có lỗi 
        if(empty($error))
        {

        	if (isset($_FILES['hinhAnh'])) 
          {
            $file_name  = $_FILES['hinhAnh']['name'];
            $file_tmp   = $_FILES['hinhAnh']['tmp_name'];
            $file_type  = $_FILES['hinhAnh']['type'];
            $file_erro  = $_FILES['hinhAnh']['error'];

            if ($file_erro == 0) 
            {
              $part =ROOT."tintuc/";
              $data['hinhAnh'] = $file_name;
            }
          }

          $id_update = $db->update("tintuc",$data,array("maTinTuc"=>$id));
          if($id_update > 0)
          {
            move_uploaded_file($file_tmp, $part.$file_name);
            $_SESSION['success'] = "Sửa tin tức thành công";
            redirectAdmin("TinTuc");
          }
         else
         {
            $_SESSION['error'] = "Sửa tin tức thất bại";
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
                            <a href="<?php echo base_url()?>admin/modules/TinTuc/">Tin Tức</a>
                        </li>
                        <li class="breadcrumb-item active">Sửa Tin Tức</li>
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
                            <label for="exampleInputEmail1">Tiêu Đề</label>
                            <input class="form-control" id="tieuDe" type="text" placeholder="Tiêu đề" name="tieuDe" value="<?php echo $suatintuc['tieuDe'] ?>">
                            <?php if (isset($error['tieuDe'])): ?>
                              <p class="text-danger"> <?php echo $error['tieuDe']?></p>
                            <?php endif?>
                          </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Nội Dung Ngắn</label>
                            <input class="form-control" id="noiDungNgan" type="text" placeholder="Nội dung ngắn" name="noiDungNgan" value="<?php echo $suatintuc['noiDungNgan'] ?>">
                            <?php if (isset($error['noiDungNgan'])): ?>
                              <p class="text-danger"> <?php echo $error['noiDungNgan']?></p>
                            <?php endif?>
                            </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Nội Dung</label>
                            <textarea id="editor2" class="form-control" name="noiDung" rows="5"><?php echo $suatintuc['noiDung'] ?></textarea>
                            <script>    CKEDITOR.replace( 'editor2' );</script>
                            <?php if (isset($error['noiDung'])): ?>
                              <p class="text-danger"> <?php echo $error['noiDung']?></p>
                            <?php endif?>
                            </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Tác Giả</label>
                            <input class="form-control" id="tacGia" type="text" placeholder="Tác giả" name="tacGia" value="<?php echo $suatintuc['tacGia'] ?>">
                            
                            </div>

                            <div class="form-group"> 
                                <label for="exampleFormControlFile1">Hình ảnh</label>
                                <input type="file" class="form-control-file" name="hinhAnh" id="hinhAnh" >
                            <?php if (isset($error['hinhAnh'])): ?>
                              <p class="text-danger"> <?php echo $error['hinhAnh']?></p>
                            <?php endif?>
                            <img src=" <?php echo uploads() ?>tintuc/<?php echo $suatintuc['hinhAnh'] ?> " width=50px height=50px >
                            </div>

                            </div>
                          
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                          </div>
                          
                        </form>
                </div>
            </div>

<?php require_once __DIR__. "/../../layouts/footer.php"; ?>