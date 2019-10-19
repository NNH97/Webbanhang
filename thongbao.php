<?php require_once __DIR__. "/autoload/autoload.php"; ?>
    <?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">
            <section class="box-main1">
                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Thông Báo Thanh Toán </a> </h3>
                <?php if(isset($_SESSION['success'])):?>
                    <div class="alert alert-success" style="margin-top:20px ">
                        <strong style="color: #3c763d">Success!</strong><?php echo $_SESSION['success'];unset($_SESSION['success'])?>
                    </div>
                <?php endif?>
                <a style="margin-bottom: 20px" href="index.php" class="btn btn-success">Tiếp Tục Mua Hàng</a>
            </section>
        </div>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>