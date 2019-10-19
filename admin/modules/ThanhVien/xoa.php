<?php 
    $open = "ThanhVien";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));
    //Kiểm tra có tồn tại ID
    $suathanhvien = $db->fetchID("thanhvien","maTaiKhoan",$id);
    if(empty($suathanhvien))
    {
      $_SESSION["error"] = "Dữ liệu không tồn tại ";
      redirectAdmin("ThanhVien");
    }
    // Xoá thành viên
    $xoathanhvien=$db->delete("thanhvien","maTaiKhoan",$id);
       if($xoathanhvien > 0)
       {
          $_SESSION['success'] = "Xoá thành công" ;
          redirectAdmin("ThanhVien");
       }
       else
       {
          $_SESSION['error'] = "Xoá thất bại" ;
          redirectAdmin("ThanhVien");
       }
        
 ?>