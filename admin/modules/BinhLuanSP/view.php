<?php
	$open="BinhLuanSP";
	require_once __DIR__."/../../autoload/autoload.php";


	$id=intval(getInput('id'));

	$suabinhluan=$db->fetchID("binhluansp","maBinhLuan",$id);
	if(empty($suabinhluan))
	{
		$_SESSION['error']="Dữ liệu không tồn tại";
		redirectAdmin("BinhLuanSP");
	}


	$view = $suabinhluan['view']==1?0:1;

	
	$update=$db->update("binhluansp",array("view"=>$view),array("maBinhLuan"=>$id));
	if($update > 0)
	      {
	          $_SESSION['success']= "Cập nhật thành công";
	          redirectAdmin("BinhLuanSP");
	      }
	      else
	      {
	          $_SESSION['error'] ="Dữ liệu không thay đổi";
	          redirectAdmin("BinhLuanSP");
	      }
?>