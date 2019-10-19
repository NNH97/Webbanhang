<?php 
    $open = "DanhMuc";
    require_once __DIR__. "/../../autoload/autoload.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
      {

       $data =
       [
         "tenDanhMuc" => postInput('tenDanhMuc'),
         "moTaDanhMuc" => postInput('moTaDanhMuc'),
         "logo" => postInput('logo')
       ];

       $error = [];

        if (postInput('tenDanhMuc') == '' )
        {
          $error['tenDanhMuc'] = "Mời bạn nhập đầy đủ tên danh mục";
        }
        if(isset($_FILES['logo']))
        {
          if($_FILES['logo']['error'] > 0)
          {
            $error['logo'] = "Mời bạn chọn logo"; 
          }       
        }
        //error trống có nghĩa ko có lỗi 
        if(empty($error))
        {
          if (isset($_FILES['logo'])) 
          {
            $file_name  = $_FILES['logo']['name'];
            $file_tmp   = $_FILES['logo']['tmp_name'];
            $file_type  = $_FILES['logo']['type'];
            $file_erro  = $_FILES['logo']['error'];

            if ($file_erro == 0) 
            {
              $part =ROOT."logo/";
              $data['logo'] = $file_name;
            }
          }

        	$isset = $db->fetchOne('danhmuc'," tenDanhMuc= '".$data['tenDanhMuc']."' ");
        	if(count($isset) > 0)
        	{
        		$_SESSION['error'] = "Tên danh mục đã tồn tại !";
        	}
        	else
        	{
        		$id_insert = $db->insert("danhmuc",$data);
		        if ($id_insert > 0) 
		          {
                move_uploaded_file($file_tmp, $part.$file_name);
		            $_SESSION['success'] = "Thêm mới thành công" ;
		            redirectAdmin("DanhMuc");
		          }
		          else
		          {
		            $_SESSION['error'] = "Thêm mới thất bại" ;
		          }
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
                            <a href="<?php echo base_url()?>admin/modules/DanhMuc/">Danh Mục</a>
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
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input class="form-control" id="tenDanhMuc" type="text" placeholder="Tên danh mục" name="tenDanhMuc">
                            <?php if (isset($error['tenDanhMuc'])): ?>
                              <p class="text-danger"> <?php echo $error['tenDanhMuc']?></p>
                            <?php endif?>
                            <br>
                            <label for="exampleInputEmail1">Mô tả danh mục</label>
                            <input class="form-control" id="moTaDanhMuc" type="text" placeholder="Mô tả danh mục" name="moTaDanhMuc">
                            <br>
                            <div class="form-group"> 
                                <label for="exampleFormControlFile1">Logo</label>
                                <input type="file" class="form-control-file" name="logo" id="logo" >
                            <?php if (isset($error['logo'])): ?>
                              <p class="text-danger"> <?php echo $error['logo']?></p>
                            <?php endif?>
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