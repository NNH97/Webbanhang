<?php 
    $open = "TinTuc";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $suatintuc = $db->fetchID("tintuc","maTinTuc",$id);
    if(empty($suatintuc))
    {
      $_SESSION["error"] = "Dữ liệu không tồn tại ";
      redirectAdmin("TinTuc");
    }
    // Kiểm tra xem danh mục có sản phẩm
    $xoatintuc=$db->delete("tintuc","maTinTuc",$id);
       if($xoatintuc > 0)
       {
          $_SESSION['success'] = "Xoá thành công" ;
          redirectAdmin("TinTuc");
       }
       else
       {
          $_SESSION['error'] = "Xoá thất bại" ;
          redirectAdmin("TinTuc");
       }
        
 ?>