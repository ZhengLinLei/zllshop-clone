<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap" rel="stylesheet">
<main class="mt-2 flex-column d-flex pt-4">
    <?php
    $mvc = new MVCcontroller();
    if (isset($_GET["history"]) && !empty($_GET["history"])) {
        $data = $mvc->getBuyHistory($_SESSION["user"]["data"]["wechat_id"], $_GET["history"]);
        if (!empty($data)) {
            $dataHistory = json_decode($data[0]["history"]);
    ?>
            <div class="container">
                <div class="dataHistory p-1 mb-5 pb-5">
                    <div class="item-body mt-5">
                        <div class="item-history-info">
                            <?php
                            foreach ($dataHistory->data as $key => $value) {
                            ?>
                                <div class="d-flex my-3 justify-content-between align-items-center">
                                    <div class="img">
                                        <a href="../item?item=<?php echo $value->id ?>" class="font-weight-bold color-2 d-flex" target="_blank">
                                            <img src="..<?php echo $value->item_image ?>" alt="加速中..." class="small-round" style="height:80px">
                                        </a>
                                    </div>
                                    <div class="ammount">x<?php echo $value->number_item ?></div>
                                    <div class="price"><span><?php echo $value->item_price_yuan ?>￥</span> - <span><?php echo $value->item_price_euro ?>€</span></div>
                                </div>
                            <?php
                            }
                            ?>
                            <hr class="w-75 my-3">
                            <div class="d-flex justify-content-between my-2">
                                <div>总共</div>
                                <div class="price font-weight-bold"><?php echo $dataHistory->total_price ?>￥ - <?php echo ($dataHistory->total_price == 0) ? 0 : number_format($dataHistory->total_price / 8, 2, '.', '') ?>€</div>
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <div>付款</div>
                                <div class="price font-weight-bold"><?php echo $dataHistory->real_price ?>￥ - <?php echo ($dataHistory->real_price == 0) ? 0 : number_format($dataHistory->real_price / 8, 2, '.', '') ?>€</div>
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <div>差价</div>
                                <div class="font-weight-bold"><?php echo $dataHistory->gap_price ?>￥ / <?php echo ($dataHistory->gap_price == 0) ? 0 : number_format($dataHistory->gap_price / 8, 2, '.', '') ?>€</div>
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <div>使用本店现金</div>
                                <div class="h5">
                                    <?php
                                    if ($dataHistory->use_money == "true") {
                                    ?>
                                        <i class="far fa-check-circle text-success"></i>
                                    <?php
                                    } else {
                                    ?>
                                        <i class="far fa-times-circle text-danger"></i>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="my-2">
                                <div>备注</div>
                                <div class="message px-3 py-2 mt-3"><?php echo $dataHistory->price_comment ?></div>
                            </div>
                            <hr class="w-75">
                            <div class="info mt-5 mb-3 pb-5">
                                <div class="mt-2 mb-4 d-flex justify-content-between">
                                    <div>单号</div>
                                    <div class="font-weight-bold <?php echo (strlen($data[0]["id"]) >= 15) ? "small" : ""; ?>"><?php echo $data[0]["id"]; ?></div>
                                </div>
                                <div class="mt-2 mb-4 d-flex justify-content-between">
                                    <div>跟踪</div>
                                    <div class="font-weight-bold <?php echo ($data[0]["status"] == "未发货" || $data[0]["status"] == "已取消") ? "text-danger" : (($data[0]["status"] == "已签收") ? "text-success" : "") ?>"><?php echo $data[0]["status"]; ?></div>
                                </div>
                                <div class="my-2 d-flex justify-content-between">
                                    <div>物流号</div>
                                    <div class="font-weight-bold <?php echo ($data[0]["code"] == "未批准") ? "text-danger" : "" ?><?php echo (strlen($data[0]["code"]) >= 15) ? "small" : ""; ?>"><?php echo $data[0]["code"]; ?></div>
                                </div>
                                <?php
                                if ($data[0]["code"] != "未批准") {
                                ?>
                                    <div class="text-center barcode my-5 h5">
                                        <?php echo $data[0]["code"] ?>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="my-2 d-flex justify-content-between">
                                    <div>运送号</div>
                                    <div class="font-weight-bold <?php echo ($data[0]["ship_code"] == "未运送") ? "text-danger" : "" ?><?php echo (strlen($data[0]["ship_code"]) >= 15) ? "small" : ""; ?>"><?php echo $data[0]["ship_code"]; ?></div>
                                </div>
                                <?php
                                if ($data[0]["ship_code"] != "未运送") {
                                ?>
                                    <div class="text-center barcode my-5 h5">
                                        <?php echo $data[0]["ship_code"] ?>
                                    </div>
                                <?php
                                }
                                ?>
                                <?php
                                if (($data[0]["ship_code"] != "未运送") && ($data[0]["status"] == "已运送" || $data[0]["status"] == "已到达国家" || $data[0]["status"] == "等待签收")) {
                                ?>
                                    <div style="height: 800px">
                                        <a id="historyElement"></a>
                                    </div>
                                    <script type="text/javascript" src="//www.17track.net/externalcall.js" defer async></script>
                                    <script type="text/javascript" defer async>
                                        window.addEventListener("load", () => {
                                            YQV5.trackSingleF1({
                                                YQ_ElementId: "historyElement",
                                                YQ_Width: 470,
                                                YQ_Height: 700,
                                                YQ_Fc: "0",
                                                YQ_Lang: "zh-CN",
                                                YQ_Num: "<?php echo $data[0]['ship_code'] ?>"
                                            });
                                            document.getElementById("historyElement").click();
                                        })
                                    </script>
                                <?php
                                }
                                ?>
                                <div class="manage text-right my-5">
                                    <?php
                                    if ($data[0]["status"] == "已签收" || $data[0]["status"] == "已取消") {
                                    ?>
                                        <?php if ($data[0]["rate"] == 0) { ?>
                                            <a class="btn btn-danger py-2 px-4" href="../rate/buy?rate=<?php echo $data[0]['id'] ?>">评价</a>
                                        <?php } ?>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="text-center small adv">(测试版)以后更多功能</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="adv h5 text-center mt-5">单号不对呢~ 亲</div>
        <?php
        }
    } else {
        $data = $mvc->getBuyHistory($_SESSION["user"]["data"]["wechat_id"], 0, $type = ((isset($_GET['view']) && !empty($_GET['view'])) ? $_GET['view'] : 'all'));
        ?>
        <div class="mt-2 mb-3 px-2">
            <div class="small-round p-4 px-2 box-shadow-round bg-white d-flex justify-content-around align-items-start">
                <div class="times h-100 text-center">
                    <div class="font-weight-bold">购买次数</div>
                    <div class="h2 mt-3 <?php echo ($_SESSION["user"]["data"]["user_buy_times"] < 20) ? 'text-danger' : (($_SESSION["user"]["data"]["user_buy_times"] >= 20 && $_SESSION["user"]["data"]["user_buy_times"] < 80) ? 'text-warning' : 'text-success') ?>"><?php echo $_SESSION["user"]["data"]["user_buy_times"] ?></div>
                </div>
                <div class="times-buy h-100 text-center">
                    <div class="font-weight-bold">消费</div>
                    <div class="h5 price mt-3 small">
                        <div class="my-1"><?php echo $_SESSION["user"]["data"]["user_buy_all_money_yuan"] ?>￥</div>
                        <div class="my-1"><?php echo $_SESSION["user"]["data"]["user_buy_all_money_euro"] ?>€</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-4 d-flex justify-content-around align-items-center">
            <a href="./history" class="<?php echo ((!isset($_GET['view']) || empty($_GET['view'])) ? 'font-weight-bold color-2' : '') ?>">全部</a>
            <a href="?view=country" class="<?php echo ((isset($_GET['view']) && !empty($_GET['view']) && $_GET['view'] == "country") ? 'font-weight-bold color-2' : '') ?>">国内</a>
            <a href="?view=warehouse" class="<?php echo ((isset($_GET['view']) && !empty($_GET['view']) && $_GET['view'] == "warehouse") ? 'font-weight-bold color-2' : '') ?>">仓库</a>
            <a href="?view=plane" class="<?php echo ((isset($_GET['view']) && !empty($_GET['view']) && $_GET['view'] == "plane") ? 'font-weight-bold color-2' : '') ?>">空运</a>
            <a href="?view=arrive" class="<?php echo ((isset($_GET['view']) && !empty($_GET['view']) && $_GET['view'] == "arrive") ? 'font-weight-bold color-2' : '') ?>">签收</a>
            <a href="?view=rate" class="<?php echo ((isset($_GET['view']) && !empty($_GET['view']) && $_GET['view'] == "rate") ? 'font-weight-bold color-2' : '') ?>">评价 <?php if (!empty($_SESSION['user']['data']['user_need_rate']) && $_SESSION['user']['data']['user_need_rate'] > 0) { ?><span class="badge badge-pill badge-danger"><?php echo $_SESSION['user']['data']['user_need_rate'] ?></span><?php } ?></a>
        </div>
        <div id="history_data" class="mb-5 pb-5">
            <?php
            if (empty($data)) {
            ?>
                <div class="adv text-center mt-5">没有任何记录呢~ 亲</div>
            <?php
            }
            foreach ($data as $key => $value) {
                $dataHistory = json_decode($value["history"]);
            ?>
                <div class="toast fade show history_item p-2 py-3" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
                    <div class="toast-header item-header d-flex align-items-center justify-content-between font-weight-bold pb-2">
                        <div>
                            <div class="h5 font-weight-bold"><span>单号: </span><span class="color-2"><?php echo $value["id"] ?></span></div>
                            <div class="adv small"><?php echo $value["date_buy"] ?></div>
                            <div class="price">
                                <span><?php echo $value["price_value"] ?>￥</span> - <span><?php echo ($value["price_value"] == 0) ? 0 : number_format($value["price_value"] / 8, 2, '.', '') ?> €</span>
                            </div>
                        </div>
                        <div class="font-weight-bold h4">
                            <a href="?history=<?php echo $value['id'] ?>"><i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="toast-body">
                        <div>
                            <?php
                            if ($dataHistory->gap_price === "代理" || $dataHistory->gap_price === "礼物") {
                            ?>
                                <span class="box-shadow-round badge badge-pill badge-success px-3 py-2 small"><?php echo $dataHistory->gap_price ?></span>
                            <?php
                            }
                            if ($dataHistory->use_money == "true") {
                            ?>
                                <span class="box-shadow-round badge badge-pill badge-info px-3 py-2 small">钱包</span>
                            <?php
                            }
                            if ($value["status"] == "已取消") {
                            ?>
                                <span class="box-shadow-round badge badge-pill badge-danger px-3 py-2 small">取消</span>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        if ($value["status"] == "已签收" || $value["status"] == "已取消") {
                        ?>
                            <div class="my-3 small-round box-sahdow-round px-3 py-1 alert-<?php echo ($value["status"] == "已签收") ? "success" : "danger" ?>">
                                <small> <i class="fas fa-<?php echo ($value["status"] == "已签收") ? "box" : "store-alt-slash" ?>"></i> <span class="ml-3"><?php echo $value["status"] ?></span></small>
                            </div>
                            <?php
                            if (!$value["rate"]) {
                            ?>
                                <div class="my-3 small-round box-sahdow-round px-3 py-1 alert-warning">
                                    <small> <i class="fas fa-feather-alt"></i> <span class="ml-3"><?php echo $value["status"] ?>，未评价未吐槽</span></small>
                                </div>
                            <?php
                            }
                        } elseif ($value["status"] == "已运送") {
                            ?>
                            <div class="my-3 small-round box-sahdow-round px-3 py-1 alert-warning">
                                <small> <i class="fas fa-plane-departure"></i> <span class="ml-3">空运中，注意签收</span></small>
                            </div>
                        <?php
                        } elseif ($value["status"] == "已到达国家" || $value["status"] == "等待签收") {
                        ?>
                            <div class="my-3 small-round box-sahdow-round px-3 py-1 alert-warning">
                                <small> <i class="fas fa-hourglass-half"></i> <span class="ml-3">等待签收</span></small>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="my-3 small-round box-sahdow-round px-3 py-1 alert-dark">
                                <small> <i class="fas fa-bell"></i> <span class="ml-3">等待国内消息</span></small>
                            </div>
                            <?php
                            if ($value["status"] == "已入仓库" || $value["status"] == "已批准") {
                            ?>
                                <div class="my-3 small-round box-sahdow-round px-3 py-1 alert-info">
                                    <small> <i class="fas fa-warehouse"></i> <span class="ml-3">仓库内</span></small>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="my-3 small-round box-sahdow-round px-3 py-1 alert-danger">
                                    <small> <i class="fas fa-shipping-fast"></i><span class="ml-3">还没入仓库</span></small>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <?php
                    if ($value["status"] == "已签收" || $value["status"] == "已取消") {
                    ?>
                        <?php if ($value["rate"] == 0) { ?>
                            <section class="toast-footer mx-3 my-2 mt-4">
                                <a class="btn btn-danger btn-block py-2 small font-weight-bold" href="../rate/buy?rate=<?php echo $value['id'] ?>">评价</a>
                            </section>
                        <?php } ?>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>
        </div>
        <hr>
        <?php
        if (count($data) >= 40) {
        ?>
            <div class="mb-5 pb-5">
                <div class="adv h5 text-center mt-5">只能查看前几单</div>
                <div class="adv text-center mt-2"><small>如需查看更多要请联系</small></div>
            </div>
        <?php
        }
        ?>
    <?php
    }
    ?>
</main>