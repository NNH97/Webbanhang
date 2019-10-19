<?php 
		require_once __DIR__. "/autoload/autoload.php"; 
        
        if(!isset($_SESSION['ten_tv'])){
            echo "<script>alert('Bạn cần đăng nhập để thêm hàng vào giỏ !');location.href='dangnhap.php'</script>";
        }


        $id = intval(getInput('id'));
        //lấy sản phẩm
        $sanpham = $db->fetchID("sanpham","maSanPham",$id);

        if($sanpham['soLuongSanPham']<1)
        {
            echo "<script>alert('Sản phẩm này đã hết hàng bạn vui lòng chọn sản phẩm khác hoặc có thể quay lại sau !');location.href='index.php'</script>";
        }

        //kiểm tra nếu tồn tại giỏ hàng thì thêm vào
        //Ngược lại thì tạo mới

        if(!isset($_SESSION['giohang'][$id]))
        {
        	//Tạo mới giỏ hàng
        	$_SESSION['giohang'][$id]['maSanPham']=$sanpham['maSanPham'];
        	$_SESSION['giohang'][$id]['tenSanPham']=$sanpham['tenSanPham'];
        	$_SESSION['giohang'][$id]['hinhAnhSanPham']=$sanpham['hinhAnhSanPham'];
        	$_SESSION['giohang'][$id]['giaSanPham']=((100-$sanpham['sale'])*$sanpham['giaSanPham'])/100;
        	$_SESSION['giohang'][$id]['soluong']=1;
        	
        }
        else
        {
        	//Cập nhật giỏ hàng
        	$_SESSION['giohang'][$id]['soluong']+=1;

        }

        echo "<script>alert('Thêm sản phẩm thành công !');location.href='giohang.php'</script>";
 ?>