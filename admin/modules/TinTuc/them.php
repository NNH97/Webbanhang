<?php 
    $open = "TinTuc";
    require_once __DIR__. "/../../autoload/autoload.php";
    $tintuc = $db->fetchAll('tintuc');
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
      {

       $data =
       [
         "tieuDe" => postInput('tieuDe'),
         "noiDungNgan" => postInput('noiDungNgan'),
         "noiDung" => postInput('noiDung'),
         "tacGia" => postInput('tacGia'),
         "hinhAnh" => postInput('hinhAnh'),
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

        if(isset($_FILES['hinhAnh']))
        {
          if($_FILES['hinhAnh']['error'] > 0)
          {
            $error['hinhAnh'] = "Mời bạn chọn hình ảnh"; 
          }       
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

          $id_insert = $db->insert("tintuc",$data);
          if($id_insert > 0)
          {
            move_uploaded_file($file_tmp, $part.$file_name);
            $_SESSION['success'] = "Thêm mới thành công";
            redirectAdmin("TinTuc");
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
                            <a href="<?php echo base_url()?>admin/modules/TinTuc/">Tin Tức</a>
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
                            <label for="exampleInputEmail1">Tiêu Đề</label>
                            <input class="form-control" id="tieuDe" type="text" placeholder="Tiêu đề" name="tieuDe">
                            <?php if (isset($error['tieuDe'])): ?>
                              <p class="text-danger"> <?php echo $error['tieuDe']?></p>
                            <?php endif?>
                          </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Nội Dung Ngắn</label>
                            <input class="form-control" id="noiDungNgan" type="text" placeholder="Nội dung ngắn" name="noiDungNgan">
                            <?php if (isset($error['noiDungNgan'])): ?>
                              <p class="text-danger"> <?php echo $error['noiDungNgan']?></p>
                            <?php endif?>
                            </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Nội Dung</label>
                            <textarea id="editor1" class="form-control" name="noiDung" rows="5"></textarea>
                            
                            <script>    CKEDITOR.replace( 'editor1' );</script>
                            <?php if (isset($error['noiDung'])): ?>
                              <p class="text-danger"> <?php echo $error['noiDung']?></p>
                            <?php endif?>
                            </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Tác Giả</label>
                            <input class="form-control" id="tacGia" type="text" placeholder="Tác giả" name="tacGia">
                            
                            </div>

                            <div class="form-group"> 
                                <label for="exampleFormControlFile1">Hình ảnh</label>
                                <input type="file" class="form-control-file" name="hinhAnh" id="hinhAnh" >
                            <?php if (isset($error['hinhAnh'])): ?>
                              <p class="text-danger"> <?php echo $error['hinhAnh']?></p>
                            <?php endif?>
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