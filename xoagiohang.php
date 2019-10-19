<?php 
	require_once __DIR__. "/autoload/autoload.php";
	$key =intval(getInput('key'));

	unset($_SESSION['giohang'][$key]);

	$_SESSION['success']="Xóa sản phẩm giỏ hàng thành công !!!";
	header("location: giohang.php");

 ?>