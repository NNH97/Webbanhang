<?php 
    $open = "DanhMuc";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $suasanpham = $db->fetchID("sanpham","maSanPham",$id);
    if(empty($suasanpham))
    {
      $_SESSION["error"] = "Dữ liệu không tồn tại ";
      redirectAdmin("SanPham");
    }
    // Kiểm tra xem danh mục có sản phẩm
    $xoasanpham=$db->delete("sanpham","maSanPham",$id);
       if($xoasanpham > 0)
       {
          $_SESSION['success'] = "Xoá thành công" ;
          redirectAdmin("SanPham");
       }
       else
       {
          $_SESSION['error'] = "Xoá thất bại" ;
          redirectAdmin("SanPham");
       }
        
 ?>