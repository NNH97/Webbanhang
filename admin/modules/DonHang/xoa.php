<?php 
    $open = "DanhMuc";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $suasanpham = $db->fetchID("dondathang","maDonDatHang",$id);
    if(empty($suasanpham))
    {
      $_SESSION["error"] = "Dữ liệu không tồn tại ";
      redirectAdmin("DonHang");
    }
    
    $xoadonhang=$db->delete("chitietdondathang","maDonDatHang",$id);
    $xoactdonhang=$db->delete("dondathang","maDonDatHang",$id);
       if($xoadonhang > 0)
       {
          $_SESSION['success'] = "Xoá thành công" ;
          redirectAdmin("DonHang");
       }
       else
       {
          $_SESSION['error'] = "Xoá thất bại" ;
          redirectAdmin("DonHang");
       }
        
 ?>