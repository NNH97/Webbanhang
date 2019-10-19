<?php 
	require_once __DIR__. "/autoload/autoload.php";
	$key = intval(getInput("key")); // lấy id sản phẩm
	$soluong = intval(getInput("soluong"));
	$sanpham = $db->fetchID("sanpham","maSanPham",$key);
	// _debug($sanpham);
	// kiểm tra sem số lượng người dùng mua có lớn hơn số lượng sản phẩm đấy trong giỏ hàng
	if ($soluong > $sanpham['soLuongSanPham']) {
		echo 2;
	}
		$_SESSION['giohang'][$key]['soluong'] = $soluong;
		
		echo 1;
?>