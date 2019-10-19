<?php 
    $open = "DanhMuc";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $suabanner = $db->fetchID("banner","maBanner",$id);
    if(empty($suabanner))
    {
      $_SESSION["error"] = "Dữ liệu không tồn tại ";
      redirectAdmin("Banner");
    }
    // Kiểm tra xem danh mục có sản phẩm
    $xoaBanner=$db->delete("banner","maBanner",$id);
       if($xoaBanner > 0)
       {
          $_SESSION['success'] = "Xoá thành công" ;
          redirectAdmin("Banner");
       }
       else
       {
          $_SESSION['error'] = "Xoá thất bại" ;
          redirectAdmin("Banner");
       }
        
 ?>