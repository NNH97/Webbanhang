<?php require_once __DIR__. "/autoload/autoload.php";
		$dondathang = $db->fetchAll("dondathang");

		$matk=intval($_SESSION['ma_tv']);
		$sql="SELECT dondathang.* FROM dondathang LEFT JOIN thanhvien ON dondathang.maTaiKhoan=thanhvien.maTaiKhoan WHERE $matk=dondathang.maTaiKhoan ORDER BY trangThai=2,maDonDatHang asc ";
		$sqlLichSu=$db->fetchsql($sql);

		if (isset($_GET['page'])) 
		   {
		     $p = $_GET['page'];
		   }
		   else
		   {
		    $p=1;
		   }

		 $dondathangpage=$db->fetchJone('dondathang',$sql,$p,5,true,"maDonDatHang");
		 if (isset($dondathangpage['page'])) 
		 {
		    $sotrang = $dondathangpage['page'];
		    unset($dondathangpage['page']);
		 }

 ?>
    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">
            <section class="box-main1">
                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Lịch Sử Mua Hàng </a> </h3>
                <table class="table table-bordered" style="margin-top: 50px">
				    <thead>
				      <tr>
				        <th>STT</th>
				        <th>Đơn Hàng</th>
				        <th>Trạng Thái</th>
				      </tr>
				    </thead>
				    <tbody>
				    	<?php $stt=1;foreach ($dondathangpage as $item): ?>
				      <tr>
				        <th scope="row"><?php echo $stt ?></th>
				        <td>
                            <ul>
                                <li><b>Tên người nhận : </b><?php echo $item['tenNguoiNhan'] ?></li>
                                <li><b>Số điện thoại người nhận : </b><?php echo $item['sdtNguoiNhan'] ?></li>
                                <li><b>Email người nhận : </b><?php echo $item['emailNguoiNhan'] ?></li>
                                <li><b>Địa Chỉ người nhận : </b><?php echo $item['diaChiNguoiNhan'] ?></li>
                                <li><b>Mô tả : </b><?php echo $item['moTaDDH'] ?></li>
                                <li><b>Ngày tạo đơn hàng : </b><?php echo $item['ngayTao'] ?></li>
                            </ul>
                        </td>
				        <td>
                            <a style="margin-top: 40px;margin-left: 50px" class="btn btn-xs <?php echo $item['trangThai']==0 ? 'btn-danger' : ($item['trangThai']==1 ? 'btn-info' : 'btn-success') ?>"><?php echo $item['trangThai']==0 ? 'Đang xử lý': ($item['trangThai']==1 ? 'Đang giao hàng' : "Đã giao hàng") ?></a>
                            <a style="margin-top: 40px" class="btn btn-sm btn-info" href="xemchitietdonhang.php?id=<?php echo $item['maDonDatHang'] ?>"> <i class=" fa fa-edit"></i> Xem Chi Tiết</a>
                        </td>
				      </tr>
				      <?php $stt++;endforeach ?>
				    </tbody>
				  </table>
				  <div class="pull-right">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <!-- <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    </a> -->
                                </li>

                                <?php for ($i=1; $i <= $sotrang ; $i++):?>
                                    <?php 
                                    if (isset($_GET['page'])) 
                                    {
                                      $p =$_GET['page'];
                                    }
                                    else
                                    { 
                                        $p=1;
                                    }
                                    ?>
                                <li class="page-item <?php echo ($i==$p)? 'active':''?>"><a class="page-link" href="?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                                <?php endfor; ?>
                                
                                <li class="page-item">
                                    <!-- <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    </a> -->
                                </li>
                            </ul>
                        </nav>
                    </div>
                <!-- Nội dung -->
            </section>
        </div>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>