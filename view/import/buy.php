<section id="buy">
<?php
if(isset($_GET["cart"]) && $_GET["cart"] == $_SESSION["buy_code"]){
    $_SESSION["security_token"] = rand();
    $json = '{"data":[';
    foreach ($_SESSION["item_cart"] as $key => $value){
        $json .= '{"id": '.$value->id.', "text": "'.$value->text.'", "number_item": '.$value->number_item.'}';
        if($key < count($_SESSION["item_cart"])-1){
            $json .= ',';
        }
    }
    $json .= '], "use_money": "' .((isset($_GET["use_money"]) && $_GET["use_money"])?"true":"false"). '" ,"wechat_id":"'.((isset($_SESSION["user"]) && $_SESSION["user"]["login"])?$_SESSION["user"]["data"]["wechat_id"]:"false").'"';
    $json .= '}';
    //GET PIXEL QR
    if(count($_SESSION["item_cart"]) < 5){
        $size = "100x100";
    }elseif(count($_SESSION["item_cart"]) < 10){
        $size = "200x200";
    }elseif(count($_SESSION["item_cart"]) < 15){
        $size = "300x300";
    }else{
        $size = "400x400";
    }
?>
    <header class="mt-5 px-5 font-weight-bold text-center">
        <div>还差一步了 <span class="font-weight-bold text-success">支付</span></div>
    </header>
    <main>
        <div class="my-5 container text-center">
            <div class="spinner-border text-dark" id="loadImg" role="status">
                <span class="sr-only">二维码生成中</span>
            </div>
            <img class="my-5" onload="clearLoadImg()" src="https://api.qrserver.com/v1/create-qr-code/?size=<?php echo $size;?>&data=<?php echo urlencode($json)?>" alt="二维码">
            <hr class="w-75">
            <div class="my-5 font-weight-bold h5 adv" id="copy_link" data-toggle="tooltip" title="已复制" >
                <i class="fas fa-copy"></i>
                <span>点击复制</span>
            </div>
        </div>
        <div class="container my-5">
            <div class="text-center">
                <div class="mt-5 h4 font-weight-bold color-2" onclick="buyEnd()">完成</div>
                <small class="mt-1 adv">* 购物车会被清理</small>
            </div>
            <div class="mt-4 small adv mx-3 small-round py-4 px-3 bg-white box-shadow-round">
                <h5 class="font-weight-bold text-dark mb-3">步骤</h5>
                <div class="d-flex my-1">
                    <p class="mr-3 text-dark">1:</p>
                    <p>点击上方 <span class="font-weight-bold text-muted">"点击复制"</span> 然后会自动复制过来文字，或者把<span class="font-weight-bold text-muted">二维码 <i class="fas fa-qrcode"></i> 截图</span> 下来</p>
                </div>
                <div class="d-flex my-1">
                    <p class="mr-3 text-dark">2:</p>
                    <p>在微信 <i class="fab fa-weixin"></i> 加下方的<span class="font-weight-bold text-muted">二维码</span>，然后把复制过来的<span class="font-weight-bold text-muted">文字</span>或者把<span class="font-weight-bold text-muted">二维码 <i class="fas fa-qrcode"></i></span>发给我们</p>
                </div>
                <div class="d-flex my-1">
                    <p class="mr-3 text-dark">3:</p>
                    <p>发完确认后可以进行 <span class="text-success font-weight-bold">支付</span> 了</p>
                </div>
            </div>
        </div>
        <hr class="mb-5 w-75">
        <div class="mt-3 mb-5 pb-5 pt-5 d-flex flex-column align-items-center justify-content-center">
            <img src="../view/resource/img/web/qr_weixin.jpg" alt="微信二维码" class="w-75">
            <div class="adv mt-2 text-center">
                <small>微信号: zheng_ll03</small>
            </div>
        </div>
    </main>
<?php
}else{
    $json = '{"response":"error-code"}';
?>
    <main class="mt-5 text-center">
        <div class="adv mt-5">对不起，出现了错误 (╥﹏╥)</div>
        <a href="<?php echo (isset($_SESSION["pre_url"]))?(($_SESSION["pre_url"] != $_SERVER['REQUEST_URI'])?$_SESSION["pre_url"]:"../category"):"../category"?>" class="d-block mt-5 h5 font-weight-bold u"><u>回去</u></a>
    </main>
<?php
}
?>
</section>
<script>
    const jsonToCopy = '<?php echo $json?>';
    const code = "<?php echo $_SESSION["security_token"]?>";

    function clearLoadImg(){
        document.querySelector("section#buy main div:nth-of-type(1)").removeChild(document.querySelector("div#loadImg"));
    }
</script>
<script src="../view/resource/js/min/buy.min.js?v=<?php echo $_SESSION['PWA']['version']?>" defer async></script>