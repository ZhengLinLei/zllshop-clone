<section id="user">
    <?php
    $_SESSION["security_token"] = rand();

    if (isset($_SESSION["user"]) && !empty($_SESSION["user"]) && $_SESSION["user"]["login"]) {
?>
        <div class="container">
            <main class="my-5 pt-2 mx-3">
                <div class="top mb-5 mt-2 d-flex justify-content-between">
                    <div>
                        <div class="name font-weight-bold h4 no-select"><?php echo $_SESSION["user"]["data"]["name"] ?></div>
                        <div class="wechat_id adv monospace">@<?php echo $_SESSION["user"]["data"]["wechat_id"] ?></div>
                    </div>
                    <div class="text-right no-select">
                        <div class="mb-3">
                            <a href="./setting/profile" class="d-flex justify-content-end align-items-center h5">
                                <div class="color-2 mr-3">
                                    <i class="far fa-address-card"></i>
                                </div>
                                <div>
                                    <i class="fas fa-angle-right"></i>   
                                </div>
                            </a>
                        </div>
                        <div>
                        <?php
                        if (!empty($_SESSION["user"]["data"]["user_range"])) {
                        ?>
                            <div class="font-weight-bold box-shadow-round badge badge-pill badge-secondary px-3 py-2"><?php echo $_SESSION["user"]["data"]["user_range"] ?></div>
                        <?php
                        }
                        if (!empty($_SESSION["user"]["data"]["user_role"])) {
                        ?>
                            <div class="font-weight-bold box-shadow-round badge badge-pill badge-light px-3 py-2"><?php echo $_SESSION["user"]["data"]["user_role"] ?></div>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
                <div class="user_money my-1">
                    <div class="box-shadow-round bg-color-2 small-round d-flex justify-content-around row">
                        <button onclick="location.href='./coupon'" class="btn col-6 color-2 d-flex flex-column align-items-center py-4">
                            <div class="d-flex">
                                <div class="font-weight-bold">余额</div>
                            </div>
                            <div class="mt-1 price small font-weight-bold text-center">
                                <div><?php echo ($_SESSION["user"]["data"]["money_coin_yuan"] <= 0)?"0.00":"****"?></div>
                            </div>
                        </button>
                        <button onclick="location.href='./points'" class="btn col-6 color-2 d-flex flex-column align-items-center py-4">
                            <div class="d-flex">
                                <div class="font-weight-bold">积分</div>
                            <?php
                            if($_SESSION["user"]["data"]["can_get_points"]):
                            ?>
                                <span class="daily_points badge badge-pill badge-danger text-danger" style="font-size:7px !important;position:absolute;transform:translate(30px,20px)">.</span>
                            <?php
                            endif;
                            ?>
                            </div>
                            <div class="mt-1 price small font-weight-bold"><?php echo $_SESSION["user"]["data"]["daily_points"]?>分</div>
                        </button>
                    </div>
                </div>
                <div class="setting my-5 no-select">
                    <div class="password d-flex justify-content-between my-4">
                        <div class="font-weight-bold">
                            <i class="fas fa-tag color-2"></i>
                            <span class="ml-1">折扣码</span>
                        </div>
                        <div class="h5"><a href="./coupon"><i class="fas fa-angle-right"></i></a></div>
                    </div>
                    <div class="password d-flex justify-content-between my-4">
                        <div class="font-weight-bold">
                            <i class="fas fa-calendar-alt color-2"></i>
                            <span class="ml-1">签到</span>
                        </div>
                        <div class="d-flex">
                        <?php
                        if($_SESSION["user"]["data"]["can_get_points"]):
                        ?>
                            <div class="mx-2">
                                <span class="badge badge-pill badge-danger">未签到</span>
                            </div>
                        <?php
                        endif;
                        ?>
                            <div class="h5"><a href="./points"><i class="fas fa-angle-right"></i></a></div>
                        </div>
                    </div>
                    <div class="historial d-flex justify-content-between my-4">
                        <div class="font-weight-bold">
                            <i class="fas fa-history color-2"></i>
                            <span class="ml-1">记录</span>
                        </div>
                        <div class="d-flex">
                            <?php
                            if (!empty($_SESSION['user']['data']['user_need_rate']) && $_SESSION['user']['data']['user_need_rate'] > 0) {
                            ?>
                                <div class="mx-2">
                                    <span class="badge badge-pill badge-danger"><?php echo $_SESSION['user']['data']['user_need_rate'] ?>待评价</span>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="h5"><a href="./setting/history"><i class="fas fa-angle-right"></i></a></div>
                        </div>
                    </div>
                    <div class="password d-flex justify-content-between my-4">
                        <div class="font-weight-bold">
                            <i class="fas fa-key color-2"></i>
                            <span class="ml-1">密码</span>
                        </div>
                        <div class="h5"><a href="./setting/password"><i class="fas fa-angle-right"></i></a></div>
                    </div>
                    <div class="location d-flex justify-content-between mt-4 mb-2">
                        <div class="font-weight-bold">
                            <i class="fas fa-map-marked-alt color-2"></i>
                            <span class="ml-1">地址</span>
                        </div>
                        <div class="h5"><a href="./setting/location"><i class="fas fa-angle-right"></i></a></div>
                    </div>
                    <?php
                    if (empty($_SESSION["user"]["data"]["user_location"]) && !json_decode($_SESSION["user"]["data"]["user_location"])) {
                    ?>
                        <div class="py-2 px-3 small-round alert-warning small d-flex align-items-center">
                            <i class="fas fa-exclamation"></i>
                            <div class="ml-2">你还未填写地址，快去填写一下吧</div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="invite d-flex justify-content-between mt-4 mb-2 align-items-center">
                        <div class="font-weight-bold">
                            <i class="fas fa-handshake color-2"></i>
                            <span class="ml-1">邀请朋友</span>
                        </div>
                        <div class="h5">
                            <a href="./setting/invite" class="btn btn-dark px-4 py-1 box-shadow-round big-round">邀请</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="page my-5">
                    <div class="cart d-flex justify-content-between my-4">
                        <div class="font-weight-bold">购物车</div>
                        <div class="h5"><a href="./cart"><i class="fas fa-angle-right"></i></a></div>
                    </div>
                    <div class="home d-flex justify-content-between my-4">
                        <div class="font-weight-bold">推荐</div>
                        <div class="h5"><a href="./recommend"><i class="fas fa-angle-right"></i></a></div>
                    </div>
                </div>
            </main>
            <footer class="my-5 mx-3">
                <div class="logout d-flex justify-content-between my-4 text-danger mb-5">
                    <div class="font-weight-bold">退号</div>
                    <div class="h5" onclick="logout()"><i class="fas fa-angle-right"></i></div>
                </div>
            </footer>
            <a href="./donate">
                <img src="./view/resource/img/web/donate_paper.svg" alt="捐款" class="small-round">
            </a>
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
            const code = <?php echo $_SESSION["security_token"]; ?>;
        </script>
        <script src="./view/resource/js/min/user.min.js?v=<?php echo $_SESSION['PWA']['version']?>" defer async></script>
    <?php
    } else {
    ?>
        <main class="mt-5 pt-5 text-center h5">
            <div class="my-5 h4 font-weight-bold">
                <a href="./user/login" class="color-2 d-block my-3">登录</a>
                <a href="./user/register" class="color-2 d-block my-3">注册</a>
            </div>
            <div class="my-5 h1 pt-5">
                <!-- <div>🛒</div> -->
                <div class="mt-5 h4 font-weight-bold">“登录后方便你购买”</div>
            </div>
        </main>
    <?php
    }
    ?>
</section>