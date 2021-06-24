<?php

$type_accept = ["all", "beauty", "bag", "accessories", "clothes", "shoe", "electronic", "toy", "sport", "furniture", "entertainment"];
$_SESSION["security_token"] = rand();

if (isset($_GET["type"]) && !in_array($_GET["type"], $type_accept)) {
    $_GET["type"] = "all";
}
?>
<section id="category">
    <?php
    $ad_yet = false;
    if(isset($_SESSION["user"]) && !isset($_SESSION["ad"]["daily_points"]) && $_SESSION["user"]["data"]["can_get_points"]){
        $ad_yet = true;
        $_SESSION["ad"]["daily_points"] = true;
    ?>
    <section id="ad_main">
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <a type="button" class="close text-white fixed-bottom text-center mb-4" data-dismiss="modal" aria-label="Close" id="closeModal">
                <span aria-hidden="true" class="h1"><i class="far fa-times-circle"></i></span>
            </a>
            <a href="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>points">
            <?php
            if($_SESSION["user"]["data"]["today_birthday"]){
            ?>
                <div class="font-weight-bold text-white h4" style="position: absolute;top: 30%;left: 50%;transform: translate(-20px, 6px);z-index: 99;"><?php echo $_SESSION["user"]["data"]["today_year"]?></div>
                <div class="font-weight-bold text-white h2" style="position: absolute;top: 50%;left: 50%;z-index: 99;transform: translate(-50%, -10px);"><?php echo $_SESSION["user"]["data"]["name"]?></div>
            <?php
            }
            ?>
                <img class="modal-dialog modal-dialog-centered text-center fixed-center" role="document" src="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>view/resource/img/web/<?php echo ($_SESSION["user"]["data"]["today_birthday"])?"birthday":"daily_points"?>.svg" alt="广告">
            </a>
        </div>
    </section>
    <?php
    }
    if(!isset($_SESSION["ad"]["valentine_day"]) && !$ad_yet){
        $ad_yet = true;
        $_SESSION["ad"]["valentine_day"] = true;
    ?>
    <section id="ad_main">
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <a type="button" class="close text-white fixed-bottom text-center mb-4" data-dismiss="modal" aria-label="Close" id="closeModal">
                <span aria-hidden="true" class="h1"><i class="far fa-times-circle"></i></span>
            </a>
            <a href="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>item?item=432">
                <img class="modal-dialog modal-dialog-centered text-center fixed-center" role="document" src="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>view/resource/img/web/valentine_day.svg" alt="情人节">
            </a>
        </div>
    </section>
    <?php
    }
    if(!isset($_SESSION["user"]) && !isset($_SESSION["ad"]["create_account"]) && !$ad_yet){
        $ad_yet = true;
        $_SESSION["ad"]["create_account"] = true;
    ?>
    <section id="ad_main">
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <a type="button" class="close text-white fixed-bottom text-center mb-4" data-dismiss="modal" aria-label="Close" id="closeModal">
                <span aria-hidden="true" class="h1"><i class="far fa-times-circle"></i></span>
            </a>
            <a href="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>user">
                <img class="modal-dialog modal-dialog-centered text-center fixed-center" role="document" src="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>view/resource/img/web/create_account.svg" alt="注册">
            </a>
        </div>
    </section>
    <?php
    }
    ?>
    <section id="import_item">
        <div class="modal fade" id="Modal_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <a type="button" class="close text-white fixed-bottom text-center mb-4" data-dismiss="modal" aria-label="Close" id="closeModal">
                <span aria-hidden="true" class="h1"><i class="far fa-times-circle"></i></span>
            </a>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <img class="w-100 small-round" src="" level="<?php echo ((isset($_GET["type"])) ? ".." : ".") ?>" alt="口令" id="image_import_item">
                    <div class="modal-body px-3">
                        <div id="title_import_item" class="font-weight-bold h5"></div>
                        <div class="mt-4">
                            <a class="btn btn-danger btn-block py-3 font-weight-bold text-white" href="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>item?item=" id="check_import_item">查看物品</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <!-- Menu -->
        <section id="menu" class="d-flex justify-content-end">
            <div class="w-75 p-3 py-4 pb-5">
                <div class="pb-5">
                    <div class="menu-button text-left h4" id="closeMenu">
                        <svg width="30" height="30" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 20L80 80" stroke="black" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M20 80L80 20" stroke="black" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="my-4 px-4 pt-3">
                        <div class="my-2 font-weight-bold text-right">
                            <span class="new_user d-none badge badge-pill badge-danger">新消息</span>
                            <a href="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>info">关于</a>
                        </div>
                        <div class="my-4 text-right">
                            <div class="my-2">
                                <a href="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>rate/app">APP评价</a>
                            </div>
                            <div class="my-2">
                                <a href="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>rate/buy">购买评价</a>
                            </div>
                        </div>
                        <div class="my-2 text-right">
                            <a href="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>item" class="color-2 font-weight-bold">随机物品</a>
                        </div>
                        <div class="my-2 text-right">
                            <a href="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>donate">公益捐款</a>
                        </div>
                    </div>
                    <div class="pb-5 pt-2 mb-5" id="notice-zone">
                        <div class="pl-3 py-2">
                            <div class="notice box-shadow-round bg-white p-3">
                                <span class="font-weight-bold color-2">发话:</span>
                                <p class="font-weight-bold d-flex">
                                    <span>愿大家2021过上好年🏮</span>
                                </p>
                                <p class="small adv">本店此期间购买有礼物</p>
                            </div>
                        </div>
                        <div class="pl-3 py-2">
                            <div class="notice box-shadow-round bg-white p-3">
                                <span class="font-weight-bold color-2">2020/12/14 通知:</span>
                                <p class="font-weight-bold">邀请身边的朋友吧🎈</p>
                                <p>每邀请一个朋友可以获得很多礼物... <a class="color-2 font-weight-bold" href="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>setting/invite">查看</a></p>
                                <div class="mt-1 small adv">
                                    <p>· 进入账号 -> 邀请 -> 复制</p>
                                </div>
                            </div>
                        </div>
                        <div class="pl-3 py-2">
                            <div class="notice box-shadow-round bg-white p-3">
                                <span class="font-weight-bold color-2">自愿公益捐款:</span>
                                <a href="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>donate" class="d-block text-primary">#多一份心多一份爱</a>
                            </div>
                        </div>
                        <div class="pl-3 py-2">
                            <div class="notice box-shadow-round bg-white p-3">
                                <span class="font-weight-bold color-2">2020/11/20 通知:</span>
                                <span>因年底靠近，有些价格会上涨和派送延长</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <main id="main">
            <header class="d-flex justify-content-between align-items-center py-2 pt-4 mx-2 h4">
                <?php
                if (isset($_GET["search"])) {
                ?>
                    <a href="javascript:window.history.back()">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                <?php
                } else {
                ?>
                    <div class="welcome font-weight-bold">欢迎 <span class="small font-weight-bold color-2"><?php echo ((isset($_SESSION["user"]) && ($_SESSION["user"]["data"]["today_birthday"]))?($_SESSION["user"]["data"]["today_year"]."岁🎂"):"2021🎉")?></small></div>
                    <div class="menu-button color-2" id="openMenu">
                        <svg width="40" height="40" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 30H85" stroke="black" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M29 50L85 50" stroke="black" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M45 70L85 70" stroke="black" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="new_user d-none badge badge-pill badge-danger text-danger" style="font-size:7px !important;position:absolute;transform:translate(-10px,5px)">.</span>
                    </div>
                <?php
                }
                ?>
            </header>
            <nav id="category-nav" class="mt-3">
                <div id="nav-search" class="d-flex my-1 px-3 py-2 justify-content-around align-items-center input-group-icon">
                    <i class="fas fa-search"></i>
                    <?php
                    $searchPlaceholder = ["内衣", "卫衣", "GUCCI迷你爆款包", "美瞳日抛", "小白鞋", "Oversize大衣 🧥"];
                    ?>
                    <input value="<?php echo (isset($_GET["search"])) ? $_GET["search"] : "" ?>" id="search-input" type="search" class="form-control mx-1" placeholder=" <?php echo $searchPlaceholder[rand(0, count($searchPlaceholder) - 1)]; ?>">
                    <div id="clear-search-text" class="p-2 <?php echo (isset($_GET["search"])) ? "active" : "" ?>">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div id="category-type" class="mt-2 w-100 py-2">
                    <div id="type-group" class="d-flex align-items-center w-auto">
                        <!-- tags: all, beauty, bag, accessories, clothes, shoe, electronic, toy, sport, furniture, entertainment -->
                        <div class="all <?php echo (!isset($_GET["type"]) || $_GET["type"] == "all") ? "active" : "disabled" ?>">
                            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>category/all<?php echo (isset($_GET["search"])) ? "?search=" . $_GET["search"] : "" ?>">全部</a>
                        </div>
                        <div class="beauty <?php echo (isset($_GET["type"]) && $_GET["type"] == "beauty") ? "active" : "disabled" ?>">
                            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>category/beauty<?php echo (isset($_GET["search"])) ? "?search=" . $_GET["search"] : "" ?>">美妆</a>
                        </div>
                        <div class="bag <?php echo (isset($_GET["type"]) && $_GET["type"] == "bag") ? "active" : "disabled" ?>">
                            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>category/bag<?php echo (isset($_GET["search"])) ? "?search=" . $_GET["search"] : "" ?>">背包</a>
                        </div>
                        <div class="accessories <?php echo (isset($_GET["type"]) && $_GET["type"] == "accessories") ? "active" : "disabled" ?>">
                            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>category/accessories<?php echo (isset($_GET["search"])) ? "?search=" . $_GET["search"] : "" ?>">饰品</a>
                        </div>
                        <div class="clothes <?php echo (isset($_GET["type"]) && $_GET["type"] == "clothes") ? "active" : "disabled" ?>">
                            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>category/clothes<?php echo (isset($_GET["search"])) ? "?search=" . $_GET["search"] : "" ?>">服装</a>
                        </div>
                        <div class="shoe <?php echo (isset($_GET["type"]) && $_GET["type"] == "shoe") ? "active" : "disabled" ?>">
                            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>category/shoe<?php echo (isset($_GET["search"])) ? "?search=" . $_GET["search"] : "" ?>">鞋品</a>
                        </div>
                        <div class="electronic <?php echo (isset($_GET["type"]) && $_GET["type"] == "electronic") ? "active" : "disabled" ?>">
                            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>category/electronic<?php echo (isset($_GET["search"])) ? "?search=" . $_GET["search"] : "" ?>">数码/电品</a>
                        </div>
                        <div class="toy <?php echo (isset($_GET["type"]) && $_GET["type"] == "toy") ? "active" : "disabled" ?>">
                            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>category/toy<?php echo (isset($_GET["search"])) ? "?search=" . $_GET["search"] : "" ?>">玩具</a>
                        </div>
                        <div class="sport <?php echo (isset($_GET["type"]) && $_GET["type"] == "sport") ? "active" : "disabled" ?>">
                            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>category/sport<?php echo (isset($_GET["search"])) ? "?search=" . $_GET["search"] : "" ?>">运动</a>
                        </div>
                        <div class="furniture <?php echo (isset($_GET["type"]) && $_GET["type"] == "furniture") ? "active" : "disabled" ?>">
                            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>category/furniture<?php echo (isset($_GET["search"])) ? "?search=" . $_GET["search"] : "" ?>">家具</a>
                        </div>
                        <div class="entertainment <?php echo (isset($_GET["type"]) && $_GET["type"] == "entertainment") ? "active" : "disabled" ?>">
                            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>category/entertainment<?php echo (isset($_GET["search"])) ? "?search=" . $_GET["search"] : "" ?>">娱乐</a>
                        </div>
                    </div>
                </div>
            </nav>
            <?php
            $mvc = new MVCcontroller();
            //Define number of page
            $numDataArray = (isset($_GET["num"]) && $_GET['num'] > 1) ? $_GET["num"] - 1 : 0;
            $groupNumber = floor($numDataArray / 10);

            if (isset($_GET["search"])) {
                $data = $mvc->searchDataCategory($_GET["search"], (isset($_GET["type"])) ? $_GET['type'] : "all");
            } else {
                $data = $mvc->getDataCategory((isset($_GET["type"])) ? $_GET["type"] : "all", $groupNumber);
            }
            ?>
            <main id="category-main" class="my-2">
                <div id="container" class="mx-1 d-flex flex-column">
                    <div class="w-100 mb-4 d-none my-1 p-3 px-4 align-items-center justify-content-between small-round bg-color-2 box-shadow-round" id="download">
                        <a href="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>info" class="d-flex align-items-center">
                            <img class="small-round" src="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>view/resource/img/web/favicon/androidIcon48x48.png" alt="加速中">
                            <div class="ml-4">
                                <div class="title color-2 font-weight-bold">我们发现你未下载APP</div>
                                <div class="color-3 small">随时查看 | 更快 | <span class="text-success"><i class="fas fa-lock"></i> 安全</span></div>
                                <div class="my-1 small color-2">点击查看</div>
                            </div>
                        </a>
                        <div id="installclose" class="small color-2 p-1">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <?php
                    if (!isset($_GET["search"])) {
                    ?>
                        <div class="item w-100 d-flex my-1 bg-white p-2 ad box-shadow-round" onclick="href_item(this)" href_item="0" id="shop-item">
                            <img class="h-100" src="<?php echo ((isset($_GET["type"])) ? "../" : "./") ?>view/resource/img/database/jiedan_taobao_pdd.jpg" alt="加速中">
                            <div class="item-body mx-3 my-1 w-100">
                                <div class="item-title h-auto">📦 接单</div>
                                <div class="item-tags">淘宝 | 拼多多 | 小红书 | 等等...</div>
                                <div class="item-info mt-4 d-flex justify-content-between">
                                    <div class="item-price"><span id="yuan">点击查看</div>
                                    <div class="item-shipping"><i class="fas fa-thumbtack"></i> 置顶</div>
                                </div>
                            </div>
                        </div>
                        <hr class="w-75 mb-4">
                    <?php
                    }
                    $groupNumSub = $numDataArray - ($groupNumber * 10);
                    //If Array is Empty
                    if (empty($data->data[$groupNumSub])) {
                    ?>
                        <div class="adv mx-auto my-3 text-center">空空的，看看别的吧 (ó﹏ò｡)</div>
                        <?php
                    } else {
                        foreach ($data->data[$groupNumSub] as $row) :
                            //Remmenber the title only can contain 21 chinese characters
                        ?>
                            <div class="item w-100 d-flex my-2" onclick="href_item(this)" href_item="<?php echo $row["id"] ?>" id="shop-item">
                                <img class="h-100 small-round" src="<?php echo (isset($_GET['type'])) ? '..' : '.' ?><?php echo json_decode($row["item_image"])->image[0] ?>" alt="加速中">
                                <div class="item-body mx-3 my-1 w-100">
                                    <div class="item-title"><?php echo mb_substr($row["item_name"], 0, 21) ?>...</div>
                                    <div class="item-tags"><?php echo json_decode($row["item_tag"])->tag[0] ?> | <?php echo json_decode($row["item_tag"])->tag[1] ?> | <?php echo json_decode($row["item_tag"])->tag[2] ?></div>
                                    <div class="item-info mt-2 d-flex justify-content-between">
                                        <div class="item-price"><span id="yuan"><?php echo $row["item_price_yuan"] ?>¥</span> - <span id="euro"><?php echo $row["item_price_euro"] ?>€</span></div>
                                        <div class="item-shipping"><?php echo ($row["item_price_ship"]) ? "包邮" : "不包邮" ?></div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endforeach;
                    }
                    ?>

                    <?php
                    if ((isset($_GET["num"]) && $_GET["num"] == (($groupNumber * 10) + $data->parseLen)) && count($data->data[$groupNumSub]) < 40) {
                    ?>
                        <div class="adv mx-auto my-3 text-center">没有了 ¯\(°_o)/¯</div>
                    <?php
                    }
                    ?>
                </div>
            </main>
            <footer id="category-footer" class="d-flex my-5 py-2 align-items-center justify-content-center">
                <div class="w-75">
                    <?php $data->pagination(); ?>
                </div>
            </footer>
        </main>
    </div>
</section>
<script>
    const searchSomething = <?php echo (isset($_GET["type"])) ? "true" : "false" ?>;
    const code = "<?php echo $_SESSION["security_token"] ?>";
</script>
<script src="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/js/min/category.min.js?v=<?php echo $_SESSION['PWA']['version'] ?>" defer async></script>