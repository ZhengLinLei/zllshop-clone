<main id="rate-app">
<?php
$mvc = new MVCcontroller();
if(isset($_SESSION["user"]) && !empty($_SESSION["user"]) && $_SESSION["user"]["login"]){
    if(!isset($_SESSION["user"]["data"]["rated"]) && empty($_SESSION["user"]["data"]["rated"])){
        $mvc->checkUserRated($_SESSION["user"]["data"]["wechat_id"]);
    }
    if(!$_SESSION["user"]["data"]["rated"]){
?>
    <div class="alert alert-success mt-5 d-none" id="alert">
        <span class="ml-2" id="text">评价完成! 谢谢</span>
    </div>
    <header class="my-5" id="rateSection">
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body px-3">
                        <a type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </a>
                        <div id="star" class="text-warning h2 d-flex justify-content-center my-5">
                        <?php
                        for($i = 1; $i <= 5; $i++){
                        ?>
                            <div class="star<?php echo $i;?> mx-2 star-zone" star="<?php echo $i;?>" onclick="getStar(this)">
                                <i class="far fa-star"></i>
                            </div>
                        <?php
                        }
                        ?>
                        </div>
                        <div id="argue" class="my-5">
                            <textarea class="form-control" rows="6" placeholder="吐槽一下你的使用体验哦~"></textarea>
                        </div>
                        <button class="btn btn-danger btn-block py-3 h5 font-weight-bold mt-5 mb-3" id="rateApp">发布</button>
                        <div class="text-center adv my-3" id="advert">
                            <small>匿名评价</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-danger btn-block py-3 h5 font-weight-bold" data-toggle="modal" data-target="#Modal">评价</button>
    </header>
    <script>
        const code = <?php echo $_SESSION["security_token"];?>
    </script>
    <script src="../view/resource/js/min/rate.min.js" defer async></script>
<?php
    }else{
?>
    <div class="login text-center adv my-4 small">
        <span>你已评价了此APP，如需要更改需要等待新通知</span>
    </div>
<?php
    }
}else{
?>
    <div class="login text-center adv my-4 small">
        <span>亲，登录后才能评价此APP呢~ (ノへ￣、) <a href="../user">登录</a></span>
    </div>
<?php
}
?>
    <main class="mb-5 mt-3 pb-5">
    <?php
    if(!isset($_SESSION["rate"]["app"]) && empty($_SESSION["rate"]["app"])){
        $_SESSION["rate"]["app"] = $mvc->getAPPRates("all");
    }
    foreach ($_SESSION["rate"]["app"] as $key => $value) {
        $user_name = $mvc->hideName($value["name"]);
    ?>
        <div class="p-4 my-3 bg-white box-shadow-round ratesBox" style="animation-delay: calc(<?php echo $key?>*100ms)">
            <div class="d-flex justify-content-between">
                <div class="name h5 font-weight-bold"><?php echo $user_name?></div>
                <div class="star text-warning">
                <?php
                for($i = 1; $i <= $value["rate"]; $i++){
                ?>
                    <i class="fas fa-star"></i>
                <?php
                }
                for($i = $value["rate"]; $i <= 4; $i++){
                ?>
                    <i class="far fa-star"></i>
                <?php
                }
                ?>
                </div>
            </div>
        <?php
        if(!empty($value["argue"])){
        ?>
            <div class="mt-4 py-1">
                <?php echo $value["argue"];?>
            </div>
        <?php
        }
        ?>
            <div class="time mt-4 text-right">
                <small class="text-muted"><?php echo $mvc->dateComment($value["date_rated"])?></small>
            </div>
        </div>
    <?php
    }
    ?>
    </main>
</main>