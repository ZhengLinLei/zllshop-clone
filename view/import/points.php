<section id="daily_points" class="no-select">
<?php
$_SESSION["security_token"] = rand();

if(isset($_SESSION["user"]) && !empty($_SESSION["user"]) && $_SESSION["user"]["login"]){
?>
    <header id="pointsSection">
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body px-3">
                        <a type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </a>
                        <div class="container text-center py-4">
                            <div>
                                <div class="text-success font-weight-bold"><i class="fas fa-check-circle"></i> 已体现成功</div>
                                <div class="info py-3">
                                    <div class="price h5 font-weight-bold" id="change_money">00￥ - 00€</div>
                                    <div class="h3 font-weight-bold my-5" id="change_points">00</div>
                                </div>
                            </div>
                            <div class="check">
                                <a href="./coupon" class="adv"><u>点击查看余额</u></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <header class="d-flex justify-content-between align-items-center py-2 pt-4 h4">
            <a href="javascript:(history.length >= 3)?window.history.back():location.href='../user';">
                <i class="fas fa-chevron-left"></i>
            </a>
            <span class="h5 font-weight-bold mr-3 mb-0">签到</span>
        </header>
        <main>
            <div class="container">
                <div class="my-5 text-center pb-5">
                    <div class="price h3 font-weight-bold"><span id="daily_points_num"><?php echo $_SESSION["user"]["data"]["daily_points"]?></span>分 <span id="add_points" class="d-none" style="animation:addPoints 0.5s ease 1s forwards;font-size:12px;position:absolute;transform:translateX(10px)">+<?php echo (($_SESSION["user"]["data"]["today_birthday"])?"50":"10")?>分</span></div>
                    <div class="mt-3 adv">你的积分</div>
                    <div class="mt-5">
                    <?php
                    if($_SESSION["user"]["data"]["can_get_points"]){
                    ?>
                        <div id="get_points">
                            <button class="btn bg-color-2 color-2 px-4 font-weight-bold box-shadow-round big-round"><i class="fas fa-calendar-alt"></i> 签到</button>
                        </div>
                    <?php
                    }else{
                    ?>
                        <div class="text-success font-weight-bold"><i class="fas fa-calendar-check"></i> 今天已签到</div>
                    <?php
                    }
                    ?>
                        <div class="adv mt-2 small" id="info_get">记得每天来打卡</div>
                    </div>
                </div>
                <div id="points_section" class="text-center">
                    <div class="mt-4">
                        <button class="btn btn-danger btn-block py-3 h5 font-weight-bold" <?php echo (($_SESSION["user"]["data"]["daily_points"] < 50)?'disabled="true"':"")?> id="button_change_money" data-toggle="modal" data-target="#Modal">提现</button>
                        <div class="adv small">≥ 50分 可以体现余额</div>
                        <div class="adv small">250分 = 16￥ - 2€</div>
                    </div>
                </div>
            </div>
        </main>
        <section class="my-5 mt-3 py-3 px-3 pb-5" id="hot">
            <h5 class="font-weight-bold">热烈推荐🔥</h5>
            <div id="recommended" class="mt-4">
                <?php
                $mvc = new MVCcontroller();
                $recommended_id = [];
                for ($i = 0; $i < 6; $i++) {
                    array_push($recommended_id, rand(1, $_SESSION['db']['total']));
                }
                $recommended_data = $mvc->searchDataCategoryById(implode(",", $recommended_id), $more = true);
                ?>
                <div class="row d-flex justify-content-around">
                    <?php
                    foreach ($recommended_data->data[0] as $key => $row) {
                    ?>
                        <div class="col-5 item d-flex my-3 bg-white small-round box-shadow-round p-0">
                            <a href="./item?item=<?php echo $row["id"] ?>">
                                <div class="d-flex flex-column">
                                    <img class="w-100 small-round" src=".<?php echo json_decode($row["item_image"])->image[0] ?>" alt="加速中">
                                    <div class="my-2 mx-3 mb-3">
                                        <div class="item-title small"><?php echo mb_substr($row["item_name"], 0, 7) ?>...</div>
                                        <div class="adv mt-2" style="font-size: 10px !important;"><?php echo json_decode($row["item_tag"])->tag[0] ?> | <?php echo json_decode($row["item_tag"])->tag[1] ?> | <?php echo json_decode($row["item_tag"])->tag[2] ?></div>
                                        <div class="item-info small mt-2 d-flex justify-content-between font-weight-bold">
                                            <div class="price"><span id="yuan"><?php echo $row["item_price_yuan"] ?>¥</span> - <span id="euro"><?php echo $row["item_price_euro"] ?>€</span></div>
                                            <div class="color-3"><?php echo ($row["item_price_ship"]) ? "包邮" : "不包邮" ?></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
    <script>
        const code = <?php echo $_SESSION["security_token"];?>;
    </script>
    <script src="./view/resource/js/min/points.min.js?v=<?php echo $_SESSION['PWA']['version']?>" defer async></script>
<?php
}else{
?>
    <main class="mt-5 pt-5 text-center h5">
        <div class="font-weight-bold">此页面只有登录后才能使用</div>
        <div class="my-5 h4 font-weight-bold">
            <a href="./user/login" class="color-2 d-block my-3">登录</a>
            <a href="./user/register" class="color-2 d-block my-3">注册</a>
        </div>
        <div class="h2 adv mt-5 pt-5">( • v • )</div>
    </main>
<?php
}
?>
</section>