<?php 
    $open = "SanPham";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));
    $danhmuc = $db->fetchAll('danhmuc');
    $suasanpham = $db->fetchID("sanpham","maSanPham",$id);
    if(empty($suasanpham))
    {
      $_SESSION["error"] = "Dữ liệu không tồn tại ";
      redirectAdmin("SanPham");
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
      {

       $data =
       [
         "tenSanPham" => postInput('tenSanPham'),
         "giaSanPham" => postInput('giaSanPham'),
         //"hinhAnhSanPham" => postInput('hinhAnhSanPham'),
         "moTaSanPham" => postInput('moTaSanPham'),
         "loaiSanPham" => postInput('loaiSanPham'),
         "soLuongSanPham" => postInput('soLuongSanPham'),
         "sale" => postInput('sale'),
         "chiTietSanPham" => postInput('chiTietSanPham'),
         "maDanhMuc_S" => postInput('maDanhMuc_S'),
       ];

       $error = [];

        if (postInput('tenSanPham') == '' )
        {
          $error['tenSanPham'] = "Mời bạn nhập đầy đủ tên Sản phẩm";
        }

        if (postInput('maDanhMuc_S') == '' )
        {
          $error['maDanhMuc'] = "Mời bạn chọn mã danh mục";
        }

        if (postInput('giaSanPham') == '' )
        {
          $error['giaSanPham'] = "Mời bạn nhập giá sản phẩm";
        }

        if (postInput('moTaSanPham') == '' )
        {
          $error['moTaSanPham'] = "Mời bạn nhập mô tả sản phẩm";
        }

        if (postInput('chiTietSanPham') == '' )
        {
          $error['chiTietSanPham'] = "Mời bạn nhập mô tả sản phẩm";
        }

        if (postInput('soLuongSanPham') == '' )
        {
          $error['soLuongSanPham'] = "Mời bạn nhập số lượng sản phẩm";
        }


        //error trống có nghĩa ko có lỗi 
        if(empty($error))
        {

        	if (isset($_FILES['hinhAnhSanPham'])) 
          {
            $file_name  = $_FILES['hinhAnhSanPham']['name'];
            $file_tmp   = $_FILES['hinhAnhSanPham']['tmp_name'];
            $file_type  = $_FILES['hinhAnhSanPham']['type'];
            $file_erro  = $_FILES['hinhAnhSanPham']['error'];

            if ($file_erro == 0) 
            {
              $part =ROOT."sanpham/";
              $data['hinhAnhSanPham'] = $file_name;
            }
          }

          $id_update = $db->update("sanpham",$data,array("maSanPham"=>$id));
          if($id_update > 0)
          {
            move_uploaded_file($file_tmp, $part.$file_name);
            $_SESSION['success'] = "Sửa sản phẩm thành công";
            redirectAdmin("sanpham");
          }
         else
         {
          $_SESSION['error'] = "Sửa sản phẩm thất bại";
          redirectAdmin("sanpham");
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
                            <a href="<?php echo base_url()?>admin/modules/SanPham/">Sản Phẩm</a>
                        </li>
                        <li class="breadcrumb-item active">Sửa Sản Phẩm</li>
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
                            <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                            <select class="form-control" name="maDanhMuc_S">
                              <option value="">----Mời bạn chọn danh mục sản phẩm----</option>
                              <?php foreach ($danhmuc as $item): ?>
                                <option value="<?php echo $item['maDanhMuc']?>" <?php echo $suasanpham['maDanhMuc_S']==$item['maDanhMuc'] ? "selected='selected'" :'' ?>><?php echo $item['tenDanhMuc'] ?></option>
                              <?php endforeach ?>
                            </select>
                            <?php if (isset($error['maDanhMuc'])): ?>
                              <p class="text-danger"> <?php echo $error['maDanhMuc']?></p>
                            <?php endif?>
                          </div>

                          <div class="form-group">           
                            <label for="exampleInputEmail1">Tên Sản phẩm</label>
                            <input class="form-control" id="tenSanPham" type="text" placeholder="Tên sản phẩm" name="tenSanPham" value="<?php echo $suasanpham['tenSanPham'] ?>">
                            <?php if (isset($error['tenSanPham'])): ?>
                              <p class="text-danger"> <?php echo $error['tenSanPham']?></p>
                            <?php endif?>
                          </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input class="form-control" id="giaSanPham" type="number" placeholder="0.000.000" name="giaSanPham" value="<?php echo $suasanpham['giaSanPham'] ?>">
                            <?php if (isset($error['giaSanPham'])): ?>
                              <p class="text-danger"> <?php echo $error['giaSanPham']?></p>
                            <?php endif?>
                            </div>

                            <div class="form-group"> 
                                <label for="exampleFormControlFile1">Hình ảnh sản phẩm</label>
                                <input type="file" class="form-control-file" name="hinhAnhSanPham" id="hinhAnhSanPham" >
                            <?php if (isset($error['hinhAnhSanPham'])): ?>
                              <p class="text-danger"> <?php echo $error['hinhAnhSanPham']?></p>
                            <?php endif?>
                            <img src=" <?php echo uploads() ?>sanpham/<?php echo $suasanpham['hinhAnhSanPham'] ?> " width=50px height=50px >
                            </div>
                              
                            <div class="form-group">           
                            <label for="exampleInputEmail1">Mô tả sản phẩm</label>
                            <textarea id="editorssp" class="form-control" name="moTaSanPham" rows="5" ><?php echo $suasanpham['moTaSanPham'] ?></textarea>
                            <script>    CKEDITOR.replace( 'editorssp' );</script>
                            <?php if (isset($error['moTaSanPham'])): ?>
                              <p class="text-danger"> <?php echo $error['moTaSanPham']?></p>
                            <?php endif?>
                            </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Chi tiết sản phẩm</label>
                            <textarea id="editorctsp" class="form-control" name="chiTietSanPham" rows="5"><?php echo $suasanpham['chiTietSanPham'] ?></textarea>
                            <script>    CKEDITOR.replace( 'editorctsp' );</script>
                            <?php if (isset($error['chiTietSanPham'])): ?>
                              <p class="text-danger"> <?php echo $error['chiTietSanPham']?></p>
                            <?php endif?>
                            </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Loại sản phẩm</label>
                            <input class="form-control" id="loaiSanPham" type="text" placeholder="Loại sản phẩm" name="loaiSanPham" value="<?php echo $suasanpham['loaiSanPham'] ?>">
                            <?php if (isset($error['loaiSanPham'])): ?>
                              <p class="text-danger"> <?php echo $error['loaiSanPham']?></p>
                            <?php endif?>
                            </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                            <input class="form-control" id="soLuongSanPham" type="number" placeholder="0" name="soLuongSanPham" value="<?php echo $suasanpham['soLuongSanPham'] ?>">
                            <?php if (isset($error['soLuongSanPham'])): ?>
                              <p class="text-danger"> <?php echo $error['soLuongSanPham']?></p>
                            <?php endif?>
                            </div>

                            <div class="form-group">           
                            <label for="exampleInputEmail1">Sale(%)</label>
                            <input class="form-control" id="sale" type="number" placeholder="0" name="sale" value="<?php echo $suasanpham['sale'] ?>">
                            
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