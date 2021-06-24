<section id="donate">
    <div class="container">
        <header class="d-flex justify-content-between align-item-center py-2 pt-4 h4">
            <a href="javascript:(history.length >= 3)?window.history.back():location.href='./category';">
                <i class="fas fa-chevron-left"></i>
            </a>
        </header>
        <main id="main">
            <section id="logos" class="d-flex flex-wrap mt-4 justify-content-between">
                <?php
                if(!isset($_GET["list"])){
                    $arr = ["腾讯公益" => "tencentgy.png", "Red Cross" => "rd.svg", "World Health Organization" => "who.svg", "OTAN" => "otan.svg", "UNESCO" => "unesco.svg", "UNICEF" => "unicef.svg",
                            "FAO" => "fao.svg", "ONU" => "onu.svg", "GreenPeace." => "greenpeace.svg", "PLAN" => "plan.svg", "WFP" => "wfp.svg", "UNHCR" => "unhcr.svg", "心意公益" => "xygy.jpg", "Save the Children" => "svc.svg"];
                }else{
                    $arr = array_diff(scandir('./view/resource/img/web/donate'), array('..', '.'));
                }
                foreach ($arr as $key => $value):
                ?>
                <div class="px-3 py-2 box-shadow-round bg-white small-round mx-1 my-2">
                    <img src="./view/resource/img/web/donate/<?php echo $value?>" alt="<?php echo $key?>" style="height:20px">
                </div>
                <?php
                endforeach;
                ?>
            </section>
            <?php 
            if(!isset($_GET["list"])){
            ?>
            <a href="?list=true" class="text-center d-block mx-1 my-2 px-3 py-2 box-shadow-round bg-light small-round">
                <span class="font-weight-bold text-muted">点击查看更多...</span>
            </a>
            <section id="info" class="my-5 pb-5">
                <div class="my-5 p-4 bg-white box-shadow-round small-round">
                    <h4 class="font-weight-bold mb-4">公益捐款</h4>
                    <p>主要负责替你捐款给一家公益组织(NGO)或者人员，不管国家，不管大小，不管教派，不管非政府或者政府管理。</p>
                    <p>如果您觉得捐出去的钱被私自独吞了，可以申请证明，只需要联系然后会在最快的时间内给你提供捐款的钱的下落。</p>
                    <img src="./view/resource/img/web/volunteer.png" alt="志愿者" style="width: 100%">
                    <div class="text-right mx-3 mt-5">
                        <a href="https://baike.baidu.com/item/%E5%85%AC%E7%9B%8A%E7%BB%84%E7%BB%87" target="_blank" class="btn btn-danger py-2 px-4 font-weight-bold h4">查看</a>
                    </div>
                </div>
                <hr>
                <div class="my-5 p-4 bg-white box-shadow-round small-round">
                    <h4 class="font-weight-bold mb-4">如何使用</h4>
                    <p>所有捐款的钱都会尽量交给组织，但有时候有些组织急缺物资，所以会把钱攒起来然后合起来买物资捐给急缺的组织</p>
                    <h6 class="font-weight-bold">物资都有</h6>
                    <ul>
                        <li>食物</li>
                        <li>衣裳</li>
                        <li>药品</li>
                        <li>书本材料</li>
                        <li>等等...</li>
                    </ul>
                    <p>如果需要知道你的钱是否拿来买东西，可以向我们申请购买记录和任何证明</p>
                </div>
                <hr>
                <div class="my-5 p-4 bg-white box-shadow-round small-round">
                    <h4 class="font-weight-bold mb-4">怎么交钱?</h4>
                    <p>我们接受各种捐款方式，下方可查看各种方式和交付通道</p>
                    <p>如果自己优选好捐款的组织，可以在备注里填写 组织名字 <b>(无备注 会捐给最需要的组织)</b></p>
                    <p class="font-weight-bold mt-5">请在备注里写上:</p>
                    <p class="text-muted"> "捐款" 名字(随意/匿名) 组织(随意)</p>
                    <div class="mt-5">
                        <div class="my-3 text-center">
                            <div class="bg-light p-3 py-2 my-2 box-shadow-round d-flex justify-content-between align-items-center">
                                <div class="h2 mx-3" style="color:#7BB32E">
                                    <i class="fab fa-weixin"></i>
                                </div>
                                <div class="mx-2">
                                    <h5 class="font-weight-bold" style="color:#7BB32E">微信支付</h5>
                                </div>
                            </div>
                            <img src="./view/resource/img/web/wechatpay.png" class="my-2 small-round" alt="微信支付" style="width: 70%">
                        </div>
                        <hr>
                        <div class="my-3 text-center">
                            <div class="bg-light p-3 py-2 my-2 box-shadow-round d-flex justify-content-between align-items-center">
                                <div class="h2 mx-3" style="color:#0e9dec">
                                    <i class="fab fa-alipay"></i>
                                </div>
                                <div class="mx-2">
                                    <h5 class="font-weight-bold" style="color:#0e9dec">支付宝</h5>
                                </div>
                            </div>
                            <img src="./view/resource/img/web/alipay.jpg" class="my-2 small-round" alt="支付宝" style="width: 70%">
                        </div>
                        <hr>
                        <div class="my-3 text-center">
                            <div class="bg-light px-3 p-3 py-2 my-2 box-shadow-round d-flex justify-content-between align-items-center">
                                <div class="h2 mx-3" style="color:#000018">
                                    <i class="fab fa-qq"></i>
                                </div>
                                <div class="mx-2">
                                    <h5 class="font-weight-bold" style="color:#000018">QQ支付</h5>
                                </div>
                            </div>
                            <img src="./view/resource/img/web/qqpay.png" class="my-2 small-round" alt="QQ支付" style="width: 70%">
                        </div>
                        <hr>
                        <div class="my-2 text-center">
                            <div class="bg-light px-3 p-3 py-2 my-2 box-shadow-round d-flex justify-content-between align-items-center">
                                <div class="h2 mx-3" style="color:#00457C">
                                    <i class="fab fa-paypal"></i>
                                </div>
                                <div class="mx-2">
                                    <h5 class="font-weight-bold" style="color:#00457C">PayPal支付</h5>
                                </div>
                            </div>
                            <img src="./view/resource/img/web/paypal.jpg" class="my-2 small-round" alt="PAYPAL" style="width: 70%">
                        </div>
                    </div>
                </div>
                <div class="my-3 text-center">
                    <span class="adv small">捐款人员有所有权利提出本钱的条件</span>
                </div>
            </section>
            <?php
            }else{
            ?>
            <section class="mt-3 mb-5 pb-5 text-center">
                <div class="small adv">未显示全部 还有很多 ʕ ᵔᴥᵔ ʔ</div>
            </section>
            <?php
            }
            ?>
        </main>
    </div>
</section>