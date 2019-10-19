<?php 
    $open = "Banner";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));
    $suabanner = $db->fetchID("banner","maBanner",$id);
    if(empty($suabanner))
    {
      $_SESSION["error"] = "Dữ liệu không tồn tại ";
      redirectAdmin("Banner");
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
      {

       $data =
       [
         "tenBanner" => postInput('tenBanner'),
         // "anhBanner" => postInput('anhBanner'),
       ];

       $error = [];

        if (postInput('tenBanner') == '' )
        {
          $error['tenBanner'] = "Mời bạn nhập tên Banner";
        }

        //error trống có nghĩa ko có lỗi 
        if(empty($error))
        {

        	if (isset($_FILES['anhBanner'])) 
          {
            $file_name  = $_FILES['anhBanner']['name'];
            $file_tmp   = $_FILES['anhBanner']['tmp_name'];
            $file_type  = $_FILES['anhBanner']['type'];
            $file_erro  = $_FILES['anhBanner']['error'];

            if ($file_erro == 0) 
            {
              $part =ROOT."banner/";
              $data['anhBanner'] = $file_name;
            }
          }

          $id_update = $db->update("banner",$data,array("maBanner"=>$id));
          if($id_update > 0)
          {
            move_uploaded_file($file_tmp, $part.$file_name);
            $_SESSION['success'] = "Sửa sản phẩm thành công";
            redirectAdmin("Banner");
          }
         else
         {
          $_SESSION['error'] = "Sửa sản phẩm thất bại";
          redirectAdmin("Banner");
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
                            <a href="<?php echo base_url()?>admin/modules/Banner/">Banner</a>
                        </li>
                        <li class="breadcrumb-item active">Sửa Banner</li>
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
                            <label for="exampleInputEmail1">Tên Banner</label>
                            <input class="form-control" id="tenBanner" type="text" placeholder="Tên Banner" name="tenBanner" value="<?php echo $suabanner['tenBanner'] ?>">
                            <?php if (isset($error['tenBanner'])): ?>
                              <p class="text-danger"> <?php echo $error['tenBanner']?></p>
                            <?php endif?>
                          </div>

                            <div class="form-group"> 
                                <label for="exampleFormControlFile1">Hình ảnh Banner</label>
                                <input type="file" class="form-control-file" name="anhBanner" id="anhBanner" >
                            <?php if (isset($error['anhBanner'])): ?>
                              <p class="text-danger"> <?php echo $error['anhBanner']?></p>
                            <?php endif?>
                            <img src=" <?php echo uploads() ?>banner/<?php echo $suabanner['anhBanner'] ?> " width=400px height=150px >
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