<section id="coupon" class="no-select">
<?php
$_SESSION["security_token"] = rand();

if(isset($_SESSION["user"]) && !empty($_SESSION["user"]) && $_SESSION["user"]["login"]){
?>
    <div class="container">
        <header class="d-flex justify-content-between align-items-center py-2 pt-4 h4">
            <a href="javascript:(history.length >= 3)?window.history.back():location.href='../user';">
                <i class="fas fa-chevron-left"></i>
            </a>
            <span class="h5 font-weight-bold mr-3 mb-0">折扣码</span>
        </header>
        <main>
            <div class="container">
                <div id="accordian" role="tablist" aria-multiselectable="true" class="my-5">
                    <div class="question-item">
                        <div class="item-header h5 d-flex align-items-center justify-content-between font-weight-bold"  id="headingOne">
                            <span>如何使用?</span>
                            <div class="open" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                        <div id="collapseOne" class="collapse mt-3" aria-labelledby="headingOne" data-parent="#accordian">
                            <div class="item-body">
                                <p>如果你有折扣码，你可把折扣码兑换成本店现金。 就是说会把它换成只有本店可使用的钱</p>
                                <p>不可提现的，但可以充(联系我们)</p>
                                <div class="alert-warning px-3 py-2 small-round">满 10💶 - 80💴 才可使用</div>
                                <div class="my-3">
                                    <h5 class="font-weight-bold">使用步骤</h5>
                                    <ul>
                                        <li class="my-2">如果你有一个折扣码，比如<span class="font-weight-bold">12bhJklU188sjZLL</span> 要把码粘贴到下面</li>
                                        <li class="my-2">粘贴完要点击兑换，点击完毕你的账号就会把折扣码的现金金额充进你的本店小钱包里</li>
                                        <li class="my-2">后面购买时， 可使用。 使用时是一次性使用，不可分开使用。</li>
                                    </ul>
                                    <p class="adv">虽然名字是折扣码，可是意思是和小钱包差不多</p>
                                    <div class="adv mt-3">
                                        <small>本店余额不会过期的，请放心使用٩(ˊ〇ˋ*)و</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="my-5 text-center pb-5">
                    <div class="price <?php echo ($_SESSION["user"]["data"]["money_coin_yuan"] >= 10000)?"h5":"h3"?> font-weight-bold"> <span id="yuan"><?php echo $_SESSION["user"]["data"]["money_coin_yuan"] ?></span>¥ - <span id="euro"><?php echo $_SESSION["user"]["data"]["money_coin_euro"] ?></span>€</div>
                    <div class="mt-3 adv">你的余额</div>
                </div>
                <div class="alert alert-danger mt-5 d-none" id="alert">
                    <i class="fas fa-exclamation"></i>
                    <span class="ml-2" id="text">错误</span>
                </div>
                <div id="coupon_section">
                    <div class="px-3 py-2 d-flex justify-content-around align-items-center input-group-icon" id="input">
                        <i class="fas fa-ticket-alt"></i>
                        <input id="coupon-input" type="text" class="form-control mx-1" placeholder=" 输入折扣码..."> 
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-danger btn-block py-3 h5 font-weight-bold" id="button_add_code">兑换</button>
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
    <script src="./view/resource/js/min/coupon.min.js?v=<?php echo $_SESSION['PWA']['version']?>" defer async></script>
<?php
}else{
?>
    <main class="mt-5 pt-5 text-center h5">
        <div class="font-weight-bold">此页面只有登录后才能使用</div>
        <div class="my-5 h4 font-weight-bold">
            <a href="./user/login" class="color-2 d-block my-3">登录</a>
            <a href="./user/register" class="color-2 d-block my-3">注册</a>
        </div>
        <div class="h2 adv mt-5 pt-5">✺◟( • ω • )◞✺</div>
    </main>
<?php
}
?>
</section>