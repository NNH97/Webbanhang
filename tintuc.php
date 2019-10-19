<?php require_once __DIR__. "/autoload/autoload.php"; 

	$tintuc = $db->fetchAll("tintuc");
	if(isset($_GET['p']))
        {
            $p = $_GET['p'];
        }
        else {
            $p = 1;
        }

    $sql="SELECT * FROM tintuc ";
    $total=count($tintuc);
    $tintuc=$db->fetchJones("tintuc",$sql,$total,$p,4,true);
    $sotrang=$tintuc['page'];
    unset($tintuc['page']);
    $path=$_SERVER['SCRIPT_NAME'];

?>
    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">
            <section class="box-main1">
                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Tin Tức </a> </h3>
                <!-- item -->
                	<?php foreach ($tintuc as $item): ?>
		           <div class="col-md-12 border-right" style="margin-top: 30px ; margin-bottom: 30px">
		                		<div class="col-md-3">
		                			
			                        <a href="chitiettintuc.php?id=<?php echo $item['maTinTuc'] ?>">
			                            <img class="img-responsive" src="<?php echo base_url() ?>public/upload/tintuc/<?php echo $item['hinhAnh'] ?>" alt="" style="width: 150px;height: 150px">
			                        </a>
			                    </div>
			                    <div class="col-md-9" style="margin-top: 30px">
			                        <h3><?php echo $item['tieuDe'] ?></h3>
			                        <p><?php echo $item['noiDungNgan'] ?></p>
			                        <a class="btn btn-primary" href="chitiettintuc.php?id=<?php echo $item['maTinTuc'] ?>">Xem Chi Tiết <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
								
		                	</div>
					
					<?php endforeach ?>
                <!-- Nội dung -->
                <nav class="text-center">
                        <ul class="pagination">
                          <?php for ($i=1; $i <= $sotrang ; $i++): ?>
                                <li class="page-item <?php echo isset($_GET['p']) && $_GET['p'] == $i ? 'active' : '' ?>"><a class="page-link" href="<?php echo $path ?>?p=<?php echo $i ?>"><?php echo $i; ?></a></li>
                          <?php endfor; ?>
                          
                        </ul>
                </nav>
            </section>
        </div>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>