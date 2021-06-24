<main class="mt-4 pb-5 mb-5">
    <div class="text-center font-weight-bold">点击复制下方分享给朋友</div>
    <section class="mt-4">
        <div class="bg-white my-2 box-shadow-round p-3 text-center text-muted">
            <p id="copy_text_invitation">
                <span>我邀请你来购买啦~ 🛍</span><br>
                <span>有很多礼物可以领取哦~ 🎁</span><br>
                <span>快来复制下方🆄🆁🅻🔗然后在浏览器打开</span><br>
                <span class="h5">𝐳ᒪℓ 𝐬𝐇𝑜ρ</span><br><br>
                <span class="font-weight-bold">https://zllshop.es/user/register?inv=<?php echo $_SESSION["user"]["data"]["id"]?></span>
            </p>
        </div>
        <div class="mt-3 mb-5 d-flex align-items-center">
            <a class="mx-3 btn btn-danger btn-block big-round py-3 px-3 h5 box-shadow-round font-weight-bold text-white" id="copy_invitation" data-toggle="tooltip" title="已复制" ><i class="fas fa-copy mr-2"></i> 复制</a>
            <a class="mx-3 btn btn-dark btn-block big-round py-3 px-3 h5 box-shadow-round font-weight-bold text-white" href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo "https://".$_SERVER['HTTP_HOST']."/user/register?inv=".$_SESSION["user"]["data"]["id"];?>" download><i class="fas fa-qrcode mr-2"></i> 二维码</a></div>
    </section>
    <hr>
    <footer class="mt-4">
        <div class="my-5 p-4 bg-white box-shadow-round small-round">
            <h4 class="font-weight-bold mb-4">获得什么?</h4>
            <p>邀请朋友可以获得优惠劵并且很多礼物🎁</p>
            <p>每邀一个朋友，在以后对方每次购买你可以拥有享受更多优惠</p>
        </div>
        <div class="my-5 p-4 bg-white box-shadow-round small-round">
            <div class="d-flex justify-content-between align-items-end">
                <span>邀请一个朋友可以获得</span>
                <span class="color-2 h2 font-weight-bold">2-10💶</span>
            </div>
            <div class="mt-3">邀请的朋友在后日下单，一单满50💶 有机会获得5-30💶的优惠卷并且可以获得一些礼物</div>
        </div>
        <div class="my-5 text-center adv">
            <small>活动规则由主办方解释权所有</small>
            <p>(*_*)</p>
        </div>
    </footer>
</main>