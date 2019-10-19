<?php require_once __DIR__. "/autoload/autoload.php"; 
		
		$id = intval(getInput('id'));
		if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            if(!isset($_SESSION['ma_tv']))
            {
                echo "<script>alert('Bạn cần đăng nhập để bình luận sản phẩm này !');location.href='dangnhap.php'</script>";
            }
            else{
                    $comment = postInput('comment');
                    $data=
                    [
                        'maSanPham' => $id,
                        'maTaiKhoan' => $_SESSION['ma_tv'],
                        'comment' => $comment
                    ];
                    $gbinhluan=$db->insert('binhluansp',$data);
                    echo "<script>alert('Bình luận của bạn đã gửi thành công !');location.href='chitietsanpham.php?id=$id'</script>";
                }

        }




?>