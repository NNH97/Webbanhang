<?php 
    $open = "DanhMuc";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $suadanhmuc = $db->fetchID("danhmuc","maDanhMuc",$id);
    if(empty($suadanhmuc))
    {
      $_SESSION["error"] = "Dữ liệu không tồn tại ";
      redirectAdmin("DanhMuc");
    }
    // Kiểm tra xem danh mục có sản phẩm
    $is_sanpham=$db->fetchOne("sanpham","maDanhMuc_S=$id ");
    if ($is_sanpham == null) {
      $xoadanhmuc=$db->delete("DanhMuc","maDanhMuc",$id);
       if($xoadanhmuc > 0)
       {
          $_SESSION['success'] = "Xoá thành công" ;
          redirectAdmin("DanhMuc");
       }else
       {
          $_SESSION['error'] = "Xoá thất bại" ;
          redirectAdmin("DanhMuc");
       }
    }
    else
    {
      $_SESSION['error'] = "Bạn không thể xoá danh mục này vì vẫn còn sản phẩm" ;
          redirectAdmin("DanhMuc");
    }
    
        
 ?>