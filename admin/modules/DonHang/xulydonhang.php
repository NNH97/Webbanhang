<?php

 require_once __DIR__. "/../../autoload/autoload.php";

   $id = intval(getInput('id'));
   $nguoixuly=$_SESSION['ten_tv'];

   $suadonhang = $db->fetchID("dondathang","maDonDatHang",$id);
   if(empty($suadonhang))
   {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("dondathang");
   }

   if($suadonhang['trangThai']==2)
   {
   	$_SESSION['error'] = "Đơn hàng đã được giao";
    redirectAdmin("DonHang");
   }

   // $trangThai=0;

   if ($suadonhang['trangThai']==0) {
   		$trangThai=1;
   }
   if($trangThai==1)
   {
     	$update=$db->update("dondathang",array("trangThai"=>$trangThai,"nguoiXuLy"=>$nguoixuly),array("maDonDatHang"=>$id));
		if($update > 0) 
		redirectAdmin("DonHang");

	}
	if ($suadonhang['trangThai']==1) {
   		$trangThai=2;
   }
	if($trangThai==2)
   {
   		
		$update=$db->update("dondathang",array("trangThai"=>$trangThai),array("maDonDatHang"=>$id));
		if($update > 0)
		     {
		          $_SESSION['success']= "Cập nhật thành công";

		          $sql = "SELECT maSanPham,soLuong FROM chitietdondathang WHERE maDonDatHang = $id";
		          $donhang = $db->fetchsql($sql);
		          foreach ($donhang as $item) {

		         	$maSanPham=intval($item['maSanPham']);

		         	$sanpham=$db->fetchID("sanpham","maSanPham",$maSanPham);

		         	$soluong=$sanpham['soLuongSanPham'] - $item['soLuong'];

		         	$up_pro=$db->update("sanpham",array("soLuongSanPham"=>$soluong),array("maSanPham"=>$maSanPham));
		         	
		        }
		         
		          redirectAdmin("DonHang");
		     	}

	}

?>