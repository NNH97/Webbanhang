<?php
	$open="SanPham";
	require_once __DIR__."/../../autoload/autoload.php";


	$id=intval(getInput('id'));

	$suasanpham=$db->fetchID("sanpham","maSanPham",$id);
	if(empty($suasanpham))
	{
		$_SESSION['error']="Dữ liệu không tồn tại";
		redirectAdmin("SanPham");
	}


	$view = $suasanpham['view']==1?0:1;

	
	$update=$db->update("sanpham",array("view"=>$view),array("maSanPham"=>$id));
	if($update > 0)
	      {
	          $_SESSION['success']= "Cập nhật thành công";
	          redirectAdmin("SanPham");
	      }
	      else
	      {
	          $_SESSION['error'] ="Dữ liệu không thay đổi";
	          redirectAdmin("SanPham");
	      }
?>