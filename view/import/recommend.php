<section id="recommend" class="no-select">
    <div class="container">
        <header class="text-center mt-4 mb-3">
            <span class="font-weight-bold h5">推荐宝贝💎</span>
        </header>
        <?php
        $mvc = new MVCcontroller();
        $mvc = new MVCcontroller();
        $recommended_id = [];
        for ($i = 0; $i < 20; $i++) {
            array_push($recommended_id, rand(1, $_SESSION['db']['total']));
        }
        $recommended_data = $mvc->searchDataCategoryById(implode(",", $recommended_id), $more = true);
        ?>
        <main id="category-main" class="my-5 pb-5">
            <div id="container" class="mx-1 d-flex flex-column">
                <?php
                foreach ($recommended_data->data[0] as $row) :
                    //Remmenber the title only can contain 21 chinese characters
                ?>
                    <div class="item w-100 d-flex my-2" onclick='location.href=`./item?item=<?php echo $row["id"] ?>`' id="shop-item">
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
                ?>
            </div>
            <footer class="my-5 text-center">
                <span class="adv">刷新 可以查看更多 ♪(´▽｀)</span>
            </footer>
        </main>
</section>