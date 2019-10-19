<?php 
    $open = "BinhLuanSP";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $suabinhluan = $db->fetchID("binhluansp","maBinhLuan",$id);
    if(empty($suabinhluan))
    {
      $_SESSION["error"] = "Dữ liệu không tồn tại ";
      redirectAdmin("BinhLuanSP");
    }
    // Kiểm tra xem danh mục có sản phẩm
    $xoabinhluan=$db->delete("binhluansp","maBinhLuan",$id);
       if($xoabinhluan > 0)
       {
          $_SESSION['success'] = "Xoá thành công" ;
          redirectAdmin("BinhLuanSP");
       }
       else
       {
          $_SESSION['error'] = "Xoá thất bại" ;
          redirectAdmin("BinhLuanSP");
       }
        
 ?>