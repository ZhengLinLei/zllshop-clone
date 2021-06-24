<section id="account_load">
<?php 
if(isset($_GET["code"]) && $_GET["code"] = $_SESSION["account_load"]["verify_code"] && ($_GET["data"] == "verify" || $_GET["data"] == "change_password")){
    if($_GET["data"] == "verify"){
?>
    <header class="mt-5 px-5 font-weight-bold text-center">
        <div>最后一步了, 把下方的文字复制给我们</div>
    </header>
    <main class="mt-5">
        <div class="my-5 container text-center">
            <hr class="mb-5 w-75">
            <div class="my-2 box-shadow-round bg-white py-3 mx-3 px-2">
                <span class="text-muted">我需要验证 微信ID是 <span class="font-weight-bold"><?php echo $_SESSION["account_load"]["id"]?></span>, 验证码是 <span class="font-weight-bold"><?php echo $_SESSION["account_load"]["verify_code"]?></span></span>
            </div>
            <div class="my-5 font-weight-bold h5 adv" id="copy_verifyText" data-toggle="tooltip" title="已复制" >
                <i class="fas fa-copy"></i>
                <span>点击复制</span>
            </div>
        </div>
        <div class="container my-4">
            <div class="mt-5 mb-4 text-center">
                <a class="h4 font-weight-bold color-2" href="./user">完成</a>
            </div>
            <div class="mt-4 small adv mx-3 small-round py-4 px-3 bg-white box-shadow-round">
                <h5 class="font-weight-bold text-dark mb-3">步骤</h5>
                <div class="d-flex my-1">
                    <p class="mr-3 text-dark">1:</p>
                    <p>点击上方 <span class="font-weight-bold text-muted">"点击复制"</span> 然后会自动复制过来文字，或者可以手动把 <span class="font-weight-bold text-muted">全部</span> 复制过来</p>
                </div>
                <div class="d-flex my-1">
                    <p class="mr-3 text-dark">2:</p>
                    <p>在微信 <i class="fab fa-weixin"></i> 加下方的<span class="font-weight-bold text-muted">二维码</span>，然后把复制过来的<span class="font-weight-bold text-muted">文字发给我们</span></p>
                </div>
                <div class="d-flex my-1">
                    <p class="mr-3 text-dark">3:</p>
                    <p>发送完会在最短的时间内给你进行<span class="font-weight-bold text-muted">验证</span></p>
                </div>
            </div>
        </div>
        <hr class="mb-5 w-75">
        <div class="mt-3 mb-5 pb-5 pt-5 d-flex flex-column align-items-center justify-content-center">
            <img src="./view/resource/img/web/qr_weixin.jpg" alt="微信二维码" class="w-75">
            <div class="adv mt-2 text-center">
                <small>微信号: zheng_ll03</small>
            </div>
        </div>
    </main>
    <script>
        window.addEventListener("load", ()=>{
            function copyLinkClipboard(){
                var textArea = document.createElement("textarea");
                textArea.value = "我需要验证 微信ID是<?php echo $_SESSION["account_load"]["id"]?>, 验证码是<?php echo $_SESSION["account_load"]["verify_code"]?>";
                
                // Avoid scrolling to bottom
                textArea.style.top = "0";
                textArea.style.left = "0";
                textArea.style.opacity = "0";
                textArea.style.position = "fixed";

                document.body.appendChild(textArea);
                textArea.focus();
                function isOS() {
                    return ['iPad Simulator','iPhone Simulator','iPod Simulator','iPad','iPhone','iPod'].includes(navigator.platform) || (navigator.userAgent.includes("Mac") && "ontouchend" in document) || navigator.userAgent.match(/ipad|iphone/i);
                }
                var range, selection;
                if (isOS()) {
                    range = document.createRange();
                    range.selectNodeContents(textArea);
                    selection = window.getSelection();
                    selection.removeAllRanges();
                    selection.addRange(range);
                } else {
                    textArea.select();
                }
                textArea.select();
                textArea.setSelectionRange(0, 99999);

                try {
                    var successful = document.execCommand('copy');
                    if(successful){
                        $('section#account_load div#copy_verifyText').tooltip('show');
                        setTimeout(()=>{
                            $('section#account_load div#copy_verifyText').tooltip('hide');
                        }, 1500);
                    }
                } catch (err) {
                    $('section#account_load div#copy_verifyText').prop('title', '无法复制，请手动');
                    $('section#account_load div#copy_verifyText').tooltip('show');
                    setTimeout(()=>{
                        $('section#account_load div#copy_verifyText').tooltip('hide');
                    }, 1500);
                }

                document.body.removeChild(textArea);
            }
            $('section#account_load div#copy_verifyText').tooltip({trigger: "click", delay: 300});
            $('section#account_load div#copy_verifyText').click(copyLinkClipboard);
        });
    </script>
<?php
    }
}else{
?>
    <main class="mt-5 text-center">
        <div class="adv mt-5">对不起，出现了错误 (╥﹏╥)</div>
        <a href="<?php echo (isset($_SESSION["pre_url"]))?(($_SESSION["pre_url"] != $_SERVER['REQUEST_URI'])?$_SESSION["pre_url"]:"./user"):"./user"?>" class="d-block mt-5 h5 font-weight-bold u"><u>回去</u></a>
    </main>
<?php
}
?>
</section>