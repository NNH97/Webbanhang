<?php require_once __DIR__. "/autoload/autoload.php"; 
		$id = intval(getInput('id'));
		$chitiettt = $db->fetchID("tintuc","maTinTuc",$id);

?>

    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">
            <section class="box-main1">
                <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $chitiettt['tieuDe'] ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $chitiettt['tacGia'] ?></a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="<?php echo uploads() ?>tintuc/<?php echo $chitiettt['hinhAnh'] ?>" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $chitiettt['ngayTao'] ?></p>
                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $chitiettt['noiDungNgan'] ?></p>
                <p><?php echo $chitiettt['noiDung'] ?></p>
              
                <hr>

                

            </div>
    
                
            </section>
        </div>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>