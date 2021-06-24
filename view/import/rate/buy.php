<main id="rate-buy">
    <?php
    $mvc = new MVCcontroller();
    if(isset($_GET["rate"]) && isset($_SESSION["user"]) && !empty($_SESSION["user"]["data"]["wechat_id"]) && $mvc->checkRateBuyUser($_SESSION["user"]["data"]["wechat_id"], $_GET["rate"])){
        $buyHistory = $mvc->getBuyHistory($_SESSION["user"]["data"]["wechat_id"], $_GET["rate"]);
        $historyData = json_decode($buyHistory[0]["history"])->data;
        $countImg = count($historyData);
        $middleImg = $countImg/2;
        $middleImgUP = ceil($middleImg);

        $_SESSION["rate_buy"] = $buyHistory[0]["price_value"];
    ?>
        <main class="rate px-3 mb-5 pb-5" id="rateSection">
            <div class="alert alert-warning mt-3 mb-5 small">
                <i class="fas fa-lightbulb"></i>
                <span class="ml-2">按照商品价格获得积分 <span class="text-danger font-weight-bold">10€-80￥ = 10分</span></span>
            </div>
            <section class="my-3 <?php echo (!is_float($middleImg))?"pair":""?>" id="imgCollapseBuy">
                <?php
                foreach ($historyData as $key => $value):
                ?>
                    <img src="..<?php echo $value->item_image?>" class="box-shadow-round" alt="加速中..." style="left:<?php echo 50-(($middleImgUP-($key+1))*(30/$countImg))?>%;">
                <?php
                endforeach;
                ?>
            </section>
            <section class="rate">
                <div id="star" class="text-warning h2 d-flex justify-content-center my-5">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                    ?>
                        <div class="star<?php echo $i; ?> mx-2 star-zone" star="<?php echo $i; ?>" onclick="getStar(this)">
                            <i class="far fa-star"></i>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="input-group my-2" id="day">
                    <input type="number" class="form-control py-4" placeholder="几天到家的?">
                    <div class="input-group-append">
                        <span class="input-group-text px-4">天</span>
                    </div>
                </div>
                <div id="argue" class="my-5">
                    <textarea class="form-control" rows="6" placeholder="<?php echo (($buyHistory[0]["status"] == "已取消")?'很抱歉这次的服务未能帮你实现，如需要我们提高的地方请写下。 我们会按照你的要求严厉更改。 谢谢! 🙏':'评价一下购买服务吧')?>"></textarea>
                </div>
                <button class="btn btn-danger btn-block py-3 h5 font-weight-bold mt-5 mb-3" id="rateBuy">发布</button>
                <div class="text-center adv my-3" id="advert">
                    <small>会显示你购买内容</small>
                </div>
            </section>
        </main>
        <script>
            const code = <?php echo $_SESSION["security_token"];?>;
            const rateItem = <?php echo $_GET["rate"];?>;
        </script>
        <script src="../view/resource/js/min/rate.min.js" defer async></script>
    <?php
    }else
    if(isset($_GET["rate"]) && (!isset($_SESSION["user"]) || empty($_SESSION["user"]["data"]["wechat_id"]))){
    ?>
        <main class="mt-5 pt-5 text-center h5">
            <div class="font-weight-bold">登录才能评价呢~</div>
            <div class="my-5 h4 font-weight-bold">
                <a href="../user/login" class="color-2 d-block my-3">登录</a>
                <a href="../user/register" class="color-2 d-block my-3">注册</a>
            </div>
            <div class="h2 adv mt-5 pt-5">o(*￣▽￣*)ブ</div>
        </main>
    <?php
    }else{
    ?>
        <main class="mb-5 mt-3 pb-5">
            <?php
            if (!isset($_SESSION["rate"]["buy"]) && empty($_SESSION["rate"]["buy"])) {
                $_SESSION["rate"]["buy"] = $mvc->getBuyRates("all");
            }
            foreach ($_SESSION["rate"]["buy"] as $key => $value) {
                $user_name = $mvc->hideName($value["name"]);
            ?>
                <div class="p-4 my-3 bg-white box-shadow-round ratesBox" style="animation-delay: calc(<?php echo $key?>*100ms)">
                    <div class="d-flex justify-content-between">
                        <div class="name h5 font-weight-bold">📦  <?php echo $user_name?></div>
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
                    <div class="my-4" id="imgBuyHistory">
                    <?php
                    $buyHistory = $mvc->getBuyHistory($value["user"], $value["buy_id"]);
                    $historyData = json_decode($buyHistory[0]["history"])->data;
                    $countImg = count($historyData);
                    foreach($historyData as $keyImg => $data):
                    ?>
                        <img src="..<?php echo $data->item_image?>" class="box-shadow-round" alt="加速中..." style="left:<?php echo $keyImg*(30/$countImg)?>%">
                    <?php
                    endforeach;
                    ?>
                    </div>
                <?php
                if(!empty($value["argue"])){
                ?>
                    <div class="my-4 py-1">
                        <?php echo $value["argue"];?>
                    </div>
                <?php
                }
                ?>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="font-weight-bold"><?php echo $value["day"]?>天到家</div>
                        <div class="time text-right">
                            <small class="text-muted"><?php echo $mvc->dateComment($value["date_rated"])?></small>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </main>
    <?php
    }
    ?>
</main>