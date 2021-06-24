<?php
$_SESSION["security_token"] = rand();
$_SESSION["buy_code"] = rand();
?>
<section id="cart" class="no-select">
    <div class="container">
        <header class="text-center mt-4 mb-3">
            <span class="font-weight-bold h5">购物车</span>
        </header>
        <main class="mt-2 flex-column d-flex pb-2">
            <?php
            if (!isset($_SESSION["item_cart"]) || empty($_SESSION["item_cart"])) {
            ?>
                <div class="adv text-center mt-5">没有任何选择 ヽ(￣～￣　)ノ </div>
                <?php
            } else {
                foreach ($_SESSION["item_cart"] as $key => $value) :
                ?>
                    <div class="item_group my-4">
                        <div class="item mb-1 d-flex align-items-center justify-content-start" id="item">
                            <div class="font-weight-bold"><?php echo $key + 1 ?></div>
                            <a class="h-100" href="./item?item=<?php echo $value->id ?>">
                                <img class="h-100 d-block ml-3" src=".<?php echo $value->image; ?>" alt="加速中">
                            </a>
                            <div class="d-flex ml-3 flex-column h-100 w-100 justify-content-between">
                                <a href="./item?item=<?php echo $value->id ?>" class="item-name"><?php echo mb_substr($value->name, 0, 20) ?>...</a>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span class="price font-weight-bold"><span id="yuan"><?php echo $value->price_yuan ?>¥</span> - <span id="euro"><?php echo $value->price_euro ?>€</span></span>
                                        <span class="ml-2 font-weight-bold">x <?php echo $value->number_item ?></span>
                                    </div>
                                    <div class="delete text-danger" onclick="deleteFnc(<?php echo $key ?>)">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($value->text)) : ?>
                            <div class="message mt-3">
                                <div class="px-3 py-2 item-description">
                                    <span class="font-weight-bold">备注:</span> <?php echo mb_substr($value->text, 0, 20); ?>...
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($key == count($_SESSION["item_cart"]) - 1) : ?>
                        <div class="mt-3 text-center adv mb-1">没有了 ~</div>
                        <div class="mt-3 text-center font-weight-bold mb-3 text-danger"><u onclick="deleteAll()">清理购物车</u></div>
                    <?php endif; ?>
            <?php
                endforeach;
            }
            ?>
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
        <?php
        $yuanTotal = 0;
        $euroTotal = 0;

        if (isset($_SESSION["item_cart"]) && !empty($_SESSION["item_cart"])) {
            foreach ($_SESSION["item_cart"] as $key => $value) {
                $yuanTotal += ($value->price_yuan * $value->number_item);
                $euroTotal += ($value->price_euro * $value->number_item);
            }
        }

        $lenCart = (isset($_SESSION["item_cart"])) ? count($_SESSION["item_cart"]) : 0;
        ?>
        <footer class="w-100">
            <div class="mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="use_money" <?php echo (isset($_SESSION["user"]) && $_SESSION["user"]["login"]) ? "" : "disabled" ?>>
                    <label class="form-check-label" for="use_money">
                        <?php echo (isset($_SESSION["user"]) && $_SESSION["user"]["login"]) ? "使用本店现金" : "未登录" ?>
                    </label>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="font-weight-bold <?php echo ($lenCart < 10) ? "h5" : "h6" ?>">
                    <div class="price"> <span id="yuan"><?php echo $yuanTotal ?>¥</span> - <span id="euro"><?php echo $euroTotal ?>€</span></div>
                    <?php
                    if ($_SESSION["user"]["data"]["today_birthday"]) :
                    ?>
                        <small class="text-danger d-block mt-2 font-weight-bold">生日折扣: -20%</small>
                    <?php
                    endif;
                    if ($lenCart > 25) :
                    ?>
                        <small class="adv d-block mt-2">亲，你买的有点多哦</small>
                    <?php
                    endif;
                    ?>
                </div>
                <a class="btn py-3 px-5 font-weight-bold text-light <?php echo ($lenCart <= 0) ? "disabled" : "" ?>" onclick="buyCart()" id="buyGenerateCode">购买</a>
            </div>
        </footer>
    </div>
</section>
<script>
    const code = "<?php echo $_SESSION["security_token"] ?>";
    const buyCode = <?php echo ($lenCart > 0) ? $_SESSION["buy_code"] : "false" ?>;
</script>
<script src="./view/resource/js/min/cart.min.js?v=<?php echo $_SESSION['PWA']['version']?>" defer async></script>