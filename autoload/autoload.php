<?php 
	session_start();
	require_once __DIR__. "/../libraries/Database.php";
	require_once __DIR__. "/../libraries/Function.php";

	$db = new Database;

	define("ROOT", $_SERVER['DOCUMENT_ROOT']."/websitebandienthoai/public/upload/");



	$sanpham = $db->fetchAll('sanpham');
	$danhmuc = $db->fetchAll('danhmuc');
	// Lấy danh sách sản phẩm

	$sqlNew="SELECT * FROM sanpham WHERE 1 ORDER BY maSanPham DESC LIMIT 4";
	$sanphamNew=$db->fetchsql($sqlNew);
	$index = 0;
	foreach($sanphamNew as $item){
		$maSanPham = (int)$item['maSanPham'];
		$sql_luotbt = "SELECT COUNT(*) FROM sanpham sp JOIN binhluansp blsp ON sp.maSanPham = blsp.maSanPham WHERE blsp.maSanPham = $maSanPham";

		$luotbl_fecthsql =  $db->fetchsql($sql_luotbt);
		$luotbl = $luotbl_fecthsql[0]['COUNT(*)'];
		$sanphamNew[$index]['luotbl'] = $luotbl;
		$index = $index + 1;
	}

	$sqlPay="SELECT sanpham.*,chitietdondathang.maSanPham,SUM(chitietdondathang.soLuong) slbd FROM sanpham JOIN chitietdondathang ON sanpham.maSanPham=chitietdondathang.maSanPham WHERE 1 GROUP BY chitietdondathang.maSanPham ORDER BY slbd DESC limit 4";
	$sanphamPay=$db->fetchsql($sqlPay);
	$index1 = 0;
	foreach($sanphamPay as $item){
		$maSanPham = (int)$item['maSanPham'];
		$sql_luotbt = "SELECT COUNT(*) FROM sanpham sp JOIN binhluansp blsp ON sp.maSanPham = blsp.maSanPham WHERE blsp.maSanPham = $maSanPham";

		$luotbl_fecthsql =  $db->fetchsql($sql_luotbt);
		$luotbl = $luotbl_fecthsql[0]['COUNT(*)'];
		$sanphamPay[$index1]['luotbl'] = $luotbl;
		$index1 = $index1 + 1;
	}

 ?>