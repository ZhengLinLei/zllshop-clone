<?php
    $_SESSION["security_token"] = rand();
?>
<section id="item">
    <header class="d-flex justify-content-between align-item-center py-2 pt-4 px-3 fixed-top h4">
        <a href="javascript:(history.length >= 3)?window.history.back():location.href='./category';">
            <i class="fas fa-chevron-left"></i>
        </a>
    </header>
    <?php
        $mvc = new MVCcontroller();
        if(!isset($_GET["item"]) || $_GET["item"] != 0){
            if(!isset($_GET["item"]) || $_GET["item"] < 0){
                $_GET["item"] = rand(1, $_SESSION['db']['total']);
            }
            $data = $mvc->searchDataCategoryById($_GET["item"]);
        }else{
            $data = $mvc->getDataCategoryJieDan();
        }

    ?>
    <main>
    <?php
    if(empty($data->data)){
    ?>
        <div class="adv text-center mt-5 pt-5 mx-5">
            <p class="mt-5">你找的物品被下架或者不存在</p> 
            <p>/(ㄒoㄒ)/~~</p>
        </div>
    <?php
    }else{
        $image_arr = json_decode($data->data[0][0]["item_image"])->image;
    ?>
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators opa-bg">
            <?php
            foreach($image_arr as $key => $value):
                if($key == 0){
            ?>
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <?php
                }else{
            ?>
                <li data-target="#carousel" data-slide-to="<?php echo $key;?>"></li>
            <?php 
                }
            endforeach;
            ?>
            </ol>
            <div class="carousel-inner">
            <?php
            foreach($image_arr as $key => $value):
                if($key == 0){
            ?>
                <div class="carousel-item active">
                    <div class="image-option">
                        <a href=".<?php echo $value;?>" class="opa-bg small px-2 py-1 text-white download font-weight-bold" download><i class="far fa-save"></i> 保存</a>
                        <a onclick="copyLinkClipboard(this)" class="opa-bg small px-2 py-1 text-white share" data-toggle="tooltip" title="已复制" copy-text="<?php echo $data->data[0][0]["id"];?> · 📋复制此口令前往APP打开<?php $arr = ['𝚉𝙻𝙻 𝚂𝚑𝚘𝚙','Zₗₗ ₛₕₒₚ','ʐʟʟ ֆɦօք','𝐙𝐋𝐋 𝐒𝐡𝐨𝐩','𝙕𝙇𝙇 𝙎𝙝𝙤𝙥']; echo $arr[array_rand($arr)];?> https://zllshop.es · 自动识别商品 𝐈𝐓𝐄𝐌 · <?php echo $data->data[0][0]["item_name"];?>">
                            <i class="fas fa-share-alt"></i> 分享
                        </a>
                    </div>
                    <img src=".<?php echo $value;?>" class="d-block w-100" alt="加速中">
                </div>
            <?php
                }else{
            ?>
                <div class="carousel-item">
                    <div class="image-option">
                        <a href=".<?php echo $value;?>" class="opa-bg small px-2 py-1 text-white download font-weight-bold" download><i class="far fa-save"></i> 保存</a>
                        <a onclick="copyLinkClipboard(this)" class="opa-bg small px-2 py-1 text-white share" data-toggle="tooltip" title="已复制" copy-text="<?php echo $data->data[0][0]["id"];?> · 📋复制此口令前往APP打开<?php $arr = ['𝚉𝙻𝙻 𝚂𝚑𝚘𝚙','Zₗₗ ₛₕₒₚ','ʐʟʟ ֆɦօք','𝐙𝐋𝐋 𝐒𝐡𝐨𝐩','𝙕𝙇𝙇 𝙎𝙝𝙤𝙥']; echo $arr[array_rand($arr)];?> https://zllshop.es · 自动识别商品 𝐈𝐓𝐄𝐌 · <?php echo $data->data[0][0]["item_name"];?>">
                            <i class="fas fa-share-alt"></i> 分享
                        </a>
                    </div>
                    <img src=".<?php echo $value;?>" class="d-block w-100" alt="加速中">
                </div>
            <?php 
                }
            endforeach;
            ?>  
            </div>
        </div>
        <div class="container">
            <section class="item_info my-3">
                <div class="title my-2 mb-5">
                    <div class="h5 font-weight-bold no-select" onclick="copyLinkClipboard(this)" data-toggle="tooltip" title="已复制" copy-text="<?php echo $data->data[0][0]["item_name"];?>"><?php echo $data->data[0][0]["item_name"];?></div>
                    <div class="mt-4 item_description"><?php echo $data->data[0][0]["item_description"];?></div>
                </div>
                <hr>
                <?php
                if($_GET["item"] != 0):
                ?>
                <div class="complement d-flex justify-content-between align-items-center no-select">
                    <div class="tag"><a href="./category/all?search=<?php echo json_decode($data->data[0][0]["item_tag"])->tag[0] ?>" class="badge badge-pill badge-light box-shadow adv"><?php echo json_decode($data->data[0][0]["item_tag"])->tag[0] ?></a> | <a href="./category/all?search=<?php echo json_decode($data->data[0][0]["item_tag"])->tag[1] ?>" class="badge badge-pill badge-light box-shadow adv"><?php echo json_decode($data->data[0][0]["item_tag"])->tag[1] ?></a> | <a href="./category/all?search=<?php echo json_decode($data->data[0][0]["item_tag"])->tag[2] ?>" class="badge badge-pill badge-light box-shadow adv"><?php echo json_decode($data->data[0][0]["item_tag"])->tag[2] ?></a></div>
                    <div class="shipping"><?php echo ($data->data[0][0]["item_price_ship"])?"包邮":"不包邮" ?></div>
                    <div class="sell-times font-weight-bold color-2">已有<?php echo $data->data[0][0]["item_sell_times"];?>人购买过</div>
                </div>
                <?php
                endif;
                ?>
                <div class="price my-4 ml-3">
                    <div class="price h4 font-weight-bold"><span id="yuan"><?php echo $data->data[0][0]["item_price_yuan"] ?>¥</span> - <span id="euro"><?php echo $data->data[0][0]["item_price_euro"] ?>€</span></div>
                </div>
                <div class="remenber p-2 no-select">
                    <div class="bg-white p-4">
                        <div class="h6 text-muted">如物品有选项，请在把物品加入到购物车前选择。</div>
                        <div class="text-right font-weight-bold text-warning"><i class="fas fa-exclamation"></i> 提示</div>
                    </div>
                </div>
                <hr>
                <div class="number_item my-2 px-3">
                    <div class="d-flex justify-content-between my-2">
                        <span>数量</span>
                        <div class="d-flex align-items-center">
                            <div class="mx-2 icon" id="number_minus"><i class="fas fa-minus"></i></div>
                            <div class="mx-2 font-weight-bold"><span id="number_of_item">1</span></div>
                            <div class="mx-2 icon" id="number_plus"><i class="fas fa-plus"></i></div>
                        </div>
                    </div>
                    <div class="my-2">
                        <span>选择描述</span>
                        <div class="my-2">
                            <input type="text" id="item_description_option" class="form-control" placeholder="  M码 红色 / 图三 / ...">
                        </div>
                    </div>
                </div>
                <div class="share_buy d-flex justify-content-between align-items-start my-5 mt-2 h5">
                    <div class="share ml-3 d-flex">
                        <div onclick="copyLinkClipboard(this)" id="copy_link" data-toggle="tooltip" title="已复制" copy-text="url">
                            <i class="fas fa-link"></i>
                        </div>
                        <a class="mx-3 h5" href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>" download>
                            <i class="fas fa-qrcode"></i>
                        </a>
                        <div onclick="copyLinkClipboard(this)" id="copy_share" data-toggle="tooltip" title="已复制" copy-text="<?php echo $data->data[0][0]["id"];?> · 📋复制此口令前往APP打开<?php $arr = ['𝚉𝙻𝙻 𝚂𝚑𝚘𝚙','Zₗₗ ₛₕₒₚ','ʐʟʟ ֆɦօք','𝐙𝐋𝐋 𝐒𝐡𝐨𝐩','𝙕𝙇𝙇 𝙎𝙝𝙤𝙥']; echo $arr[array_rand($arr)];?> https://zllshop.es · 自动识别商品 𝐈𝐓𝐄𝐌 · <?php echo $data->data[0][0]["item_name"];?>">
                            <i class="fas fa-share-alt"></i>
                        </div>
                    </div>
                    <div class="buy">
                        <button id="button_add" data-toggle="tooltip" title="已被添加" class="px-5 py-3 text-light font-weight-bold btn h5" key-code="<?php echo $_SESSION["security_token"];?>">加入购物车</button>
                    </div>
                </div>
                <footer class="my-5 mt-3 py-3 px-3">
                    <h5 class="font-weight-bold">猜你喜欢的</h5>
                    <div id="recommended" class="mt-4">
                    <?php
                    $recommended_id = [];
                    for($i = 0; $i < 6; $i++){
                        array_push($recommended_id, rand(1, $_SESSION['db']['total']));
                    }
                    $recommended_data = $mvc->searchDataCategoryById(implode(",", $recommended_id), $more = true);
                    ?>
                        <div class="row d-flex justify-content-around">
                        <?php
                        foreach ($recommended_data->data[0] as $key => $row){
                        ?>
                            <div class="col-5 item d-flex my-3 bg-white small-round box-shadow-round p-0">
                                <a href="./item?item=<?php echo $row["id"]?>">
                                    <div class="d-flex flex-column">
                                        <img class="w-100 small-round" src=".<?php echo json_decode($row["item_image"])->image[0] ?>" alt="加速中">
                                        <div class="my-2 mx-3 mb-3">
                                            <div class="item-title small"><?php echo mb_substr($row["item_name"], 0, 7)?>...</div>
                                            <div class="adv mt-2" style="font-size: 10px !important;"><?php echo json_decode($row["item_tag"])->tag[0] ?> | <?php echo json_decode($row["item_tag"])->tag[1] ?> | <?php echo json_decode($row["item_tag"])->tag[2] ?></div>
                                            <div class="item-info small mt-2 d-flex justify-content-between font-weight-bold">
                                                <div class="price"><span id="yuan"><?php echo $row["item_price_yuan"] ?>¥</span> - <span id="euro"><?php echo $row["item_price_euro"] ?>€</span></div>
                                                <div class="color-3"><?php echo ($row["item_price_ship"])?"包邮":"不包邮" ?></div>
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
                </footer>
            </section> 
        </div>
        <script>
            const data_item = {
                "id": "<?php echo $data->data[0][0]["id"] ?>",
                "name": "<?php echo $data->data[0][0]["item_name"] ?>",
                "image": "<?php echo $image_arr[0] ?>",
                "price_yuan": <?php echo $data->data[0][0]["item_price_yuan"] ?>,
                "price_euro": <?php echo $data->data[0][0]["item_price_euro"] ?>,
                "ship_service": <?php echo $data->data[0][0]["item_price_ship"] ?>
            }
        </script>
        <script src="./view/resource/js/min/item.min.js?v=<?php echo $_SESSION['PWA']['version']?>" defer async></script>
    <?php
    }
    ?> 
    </main>
</section>
