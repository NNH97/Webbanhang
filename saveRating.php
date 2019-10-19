<?php
require_once __DIR__. "/autoload/autoload.php";
$id = intval(getInput('id'));
if(!isset($_SESSION['ma_tv']))
            {
                echo "<script>alert('Bạn cần đăng nhập để đánh giá sản phẩm này !');location.href='dangnhap.php'</script>";
            }
	if(!empty($_POST['rating']) && !empty($_POST['itemId'])){
	$itemId = $_POST['itemId'];
	$userID = $_SESSION['ma_tv'];
	$insertRating = "INSERT INTO item_rating (itemId, userId, ratingNumber, title, comments, created, modified) VALUES ('".$itemId."', '".$userID."', '".$_POST['rating']."', '".$_POST['title']."', '".$_POST["comment"]."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')";
	mysqli_query($conn, $insertRating) or die("database error: ". mysqli_error($conn));
	echo "rating saved!";
}
?>