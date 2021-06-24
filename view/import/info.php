<section id="info">
    <div class="container">
        <header class="d-flex justify-content-between align-item-center py-2 pt-4 h4">
            <a href="javascript:(history.length >= 3)?window.history.back():location.href='./category';">
                <i class="fas fa-chevron-left"></i>
            </a>
        </header>
        <main id="info-main">
            <div class="container">
                <h4 class="font-weight-bold text-center mb-3">问题</h4>
                <div id="download-app" class="my-4 d-flex justify-content-between align-items-center box-shadow-round p-4 bg-white">
                    <div class="d-flex flex-column">
                        <h5 class="font-weight-bold">下载试试?</h5>
                        <small class="adv">· 方便使用</small>
                        <small class="adv">· 直接打开</small>
                        <small class="text-success">· 更安全 <i class="fa fa-lock" aria-hidden="true"></i></small>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                        <button class="btn btn-danger px-3 py-2" disabled id="download_app_pwa">下载 <i class="fas fa-download"></i></button>
                        <div id="notify_pwa_version" class="mt-1 text-right" version="<?php echo $_SESSION['PWA']['version'] ?>"><small class="adv d-flex align-items-center">
                                <div>检查版本中...</div>
                                <div class="spinner-border ml-2 w-20" style="width:20px;height:20px;border-width: 2px" role="status"></div>
                            </small></div>
                    </div>
                </div>
                <div id="accordian" role="tablist" aria-multiselectable="true" class="mt-5">
                    <div class="question-item">
                        <div class="item-header h5 d-flex align-items-center justify-content-between font-weight-bold" id="headingOne">
                            <span>如何下单?</span>
                            <div class="open" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                        <div id="collapseOne" class="collapse mt-3" aria-labelledby="headingOne" data-parent="#accordian">
                            <div class="item-body">
                                <p>购买时可使用匿名购买或者使用账号购买。</p>
                                <h5 class="font-weight-bold">匿名</h5>
                                <p>购买时不需要任何账号， 就是购买的记录不会存起来然后无法使用优惠和折扣码。</p>
                                <h5 class="font-weight-bold">账号</h5>
                                <p>使用账号购买，会记录下来你所购买的全部，包括购买中消费的钱 (购买余额到达一定的数字会有优惠和折扣码)</p>
                                <h5 class="font-weight-bold">购买步骤</h5>
                                <p>1: 选择全部需要的物品后，前往购物车</p>
                                <p>2: 按下付账按钮然后确认所购买的物品是否正确 (不包邮，邮费额外算)</p>
                                <p>4: 价格会看情况改动的，有可能更便宜有可能更贵(差距不超过20欧。 额外价格有可能是一些物流情况，或者货物被海关拦下要付额外税，大概率10% => 很多东西)</p>
                                <p>5: 确认后会出现一个二维码，请把二维码私信发给我</p>
                                <p>6: 发完后，等待我预算完会通知你</p>
                                <p>7: 下完单就会收你的钱</p>
                                <div class="adv mt-3">
                                    <small>收完你的钱，这个单子才算购买成功 (¬‿¬ )</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="question-item">
                        <div class="item-header h5 d-flex align-items-center justify-content-between font-weight-bold" id="headingTwo">
                            <span>如何注册个人号? 🆔</span>
                            <div class="open" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                        <div id="collapseTwo" class="collapse mt-3" aria-labelledby="headingTwo" data-parent="#accordian">
                            <div class="item-body">
                                <p>新人注册是要用证实微信注册，这样为了如果出现问题方便我来找你。 注册过程是要填写密码，这样可以使用微信号和密码后续登录。</p>
                                <p>注册完毕后，需要验证。</p>
                                <h5 class="font-weight-bold">验证步骤</h5>
                                <p>1: 注册成功后会出现一段字，复制这段字。 记的确认是否复制过来</p>
                                <p>2: 复制完，如是新人加我微信如果已经加过请把那一段字粘贴给我</p>
                                <p>3: 你的号会在12h内可以使用，会通知你的。 如果急需要，请通知一下，会在最短的时间内处理。</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="question-item">
                        <div class="item-header h5 d-flex align-items-center justify-content-between font-weight-bold" id="headingThree">
                            <span>如何拥有折扣码?</span>
                            <div class="open" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                        <div id="collapseThree" class="collapse mt-3" aria-labelledby="headingThree" data-parent="#accordian">
                            <div class="item-body">
                                <p>折扣码只有那些老顾客会有的，偶尔本店会有活动或者抽奖，会赠送一些折扣码</p>
                                <h5 class="font-weight-bold">使用过程</h5>
                                <p>1: 在折扣页面输入折扣码，输入完系统会自动识别兑换成本店现金</p>
                                <p>2: 在购物车里算账时，你可选择使不使用本店现金。 使用的话，要全使用不可分开使用金额</p>
                                <p>3: 使用完后，将会从你的本店现金扣你使用的余额</p>
                                <div class="alert-warning px-3 py-2 small-round">满 10💶 - 80💴 才可使用</div>
                                <div class="adv mt-3">
                                    <small>本店现金是不会过期的， 请放心使用。</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="question-item">
                        <div class="item-header h5 d-flex align-items-center justify-content-between font-weight-bold" id="headingFour">
                            <span>使用网页出现问题或者BUG 🐜</span>
                            <div class="open" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                        <div id="collapseFour" class="collapse mt-3" aria-labelledby="headingFour" data-parent="#accordian">
                            <div class="item-body">
                                <p>如在使用过程中出现故障或者无法显示一些东西，请你立即私信我来解决此故障。</p>
                                <p>如果故障是由安全系统的问题，通知会有奖励。</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="question-item">
                        <div class="item-header h5 d-flex align-items-center justify-content-between font-weight-bold" id="headingFive">
                            <span>需知 ❗❗</span>
                            <div class="open" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                        <div id="collapseFive" class="collapse mt-3" aria-labelledby="headingFive" data-parent="#accordian">
                            <div class="item-body">
                                <p>· 如果被该国家征税，税钱要自理 (概率0.3%)</p>
                                <p>· 如果货超重，需要自理 (一般都是不确定重量物品)</p>
                                <p>· 忽催单</p>
                                <p>· 下单可自助在购买记录查看物流情况</p>
                                <p>· 嫌价格贵的请闭嘴，不买别打击。 谢谢🙏</p>
                                <p>· 活动期间请守规矩的购买</p>
                                <p>· 招代理❗  有意者请私聊</p>
                                <h5 class="font-weight-bold">海关问题 🛃</h5>
                                <p>有时候海关查的严，需要及时清关。 如果被退回，会二次帮你寄送，无需要付钱</p>
                                <p>但是被海关没收，请看下面</p>
                                <p>· 有提醒的: 不退款，不退钱 (本店权力所有)</p>
                                <p>· 有提醒普通货的: 只退15% (本店权力所有)</p>
                                <p>· 无提醒敏感货: 退50% (本店权力所有)</p>
                                <p>· 无提醒普通货: 全额退款</p>
                                <div class="adv mt-3">
                                    <small>其他不懂得私聊</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="question-item">
                        <div class="item-header h5 d-flex align-items-center justify-content-between font-weight-bold" id="headingSix">
                            <span>时间到达 ⏳</span>
                            <div class="open" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                        <div id="collapseSix" class="collapse mt-3" aria-labelledby="headingSix" data-parent="#accordian">
                            <div class="item-body">
                                <p>货物运送一般情况下会在15到家 - 内在7-30天到家，时间也要看快递员需要多久能送到仓库里进行运送</p>
                                <h5 class="font-weight-bold">特殊时期</h5>
                                <p>(有可能更容易被海关查)</p>
                                <p>在特殊时期里有可能货会迟到，不会超过3个月</p>
                                <p>如有情况会第一时间通知您</p>
                                <h5 class="font-weight-bold">你所在的国家快递</h5>
                                <p>有时候也有可能，你所在的快递公司发货发的慢耽误时间。可是我会帮你安排的</p>
                                <div class="adv mt-3">
                                    <small>普通情况下，3个月未到家会重新帮你发货的 (不可退款，除非另有情况。 也可以用本店现金退款给您)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="question-item">
                        <div class="item-header h5 d-flex align-items-center justify-content-between font-weight-bold" id="headingSeven">
                            <span>人民币💴换欧元💶</span>
                            <div class="open" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                        <div id="collapseSeven" class="collapse mt-3" aria-labelledby="headingSeven" data-parent="#accordian">
                            <div class="item-body">
                                <p>我们这里的汇率是 <span>8￥-1€</span></p>
                                <div class="adv mt-3">
                                    <small>更换会被通知</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="question-item" id="error_download">
                        <div class="item-header h5 d-flex align-items-center justify-content-between font-weight-bold" id="headingEight">
                            <span>无法下载APP</span>
                            <div class="open" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                        <div id="collapseEight" class="collapse mt-3" aria-labelledby="headingEight" data-parent="#accordian">
                            <div class="item-body">
                                <p>如果尝试全部这些解决方式无法下载，不要急。 放心使用网页版</p>
                                <div class="my-5">
                                    <h5 class="font-weight-bold">苹果(IOS)手机📱</h5>
                                    <p>苹果无法自动下载，可是可以使用Safari或者别的浏览器手动下载</p>
                                    <p>1. 打开分享
                                        <svg width="30" height="30" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M24.5 27V2M24.5 2L19 6.74138M24.5 2L30 6.74138" stroke="#0085FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20 12H15C12.2386 12 10 14.2386 10 17V33C10 35.7614 12.2386 38 15 38H35C37.7614 38 40 35.7614 40 33V17C40 14.2386 37.7614 12 35 12H29V14H35C36.6569 14 38 15.3431 38 17V33C38 34.6569 36.6569 36 35 36H15C13.3431 36 12 34.6569 12 33V17C12 15.3431 13.3431 14 15 14H20V12Z" fill="#0085FF" />
                                        </svg>
                                    </p>
                                    <p>2. 点击添加到主屏幕
                                        <svg width="30" height="30" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="13" y="13" width="23" height="23" rx="4" stroke="#0085FF" stroke-width="2" />
                                            <path d="M24.2402 18V31" stroke="#0085FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M18 24.24H31" stroke="#0085FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </p>
                                    <p>3. 再点击添加</p>
                                    <p>4. 就可以使用了，返回桌面可以看见APP了</p>
                                    <small class="adv mb-5">苹果用户其他问题私聊</small>
                                </div>
                                <div class="my-5">
                                    <h5 class="font-weight-bold">安卓(Android)手机📱</h5>
                                    <p>经常遇到的问题有:</p>
                                    <div class="my-2">
                                        <p class="font-weight-bold">1. 使用的浏览器由于老旧</p>
                                        <p>解决的方式是用新版本的浏览器打开网页，然后进行下载</p>
                                        <p class="text-muted">(Google Chrome，Mozillas Firefox，Samsung浏览器，QQ浏览器，百度浏览器，Tor...)</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="font-weight-bold">2. 打开了无痕迹模式</p>
                                        <p>一般打开无痕迹模式是为了等会自动消除留下的痕迹，所以在无痕迹模式下无法下载</p> 
                                        <p class="text-muted">(嘿! 你打开无痕迹模式干嘛呢 (✿◡‿◡))</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="font-weight-bold">3. 手机老旧</p>
                                        <p>由于手机比较老旧，我们没有可以解决的办法。 可是可以使用网页版本</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="font-weight-bold">4. 拒绝了二次下载</p>
                                        <p>一般点击两次下载然后被拒绝的时候，我们不会再向你提出下载的请求。 解决的方式也很简单，只需要关闭网页然后在浏览器设置里清理本网站的数据</p> 
                                        <p class="text-muted">(新版本浏览器是不会出现的)</p>
                                    </div>
                                    <p class="font-weight-bold">手动下载</p>
                                    <p>1. 点击浏览器上方的三个点</p>
                                    <p>2. 找到 添加到主屏幕 的选项并且点击</p>
                                    <p>3. 返回桌面即可看见APP了</p>
                                    <div class="mt-5 pt-5 text-center">
                                        <div>
                                            <small class="adv">网页 | APP 版本 v<?php echo $_SESSION["PWA"]["version"];?></small>
                                        </div>
                                        <small class="adv">上次更新 <?php echo $_SESSION["PWA"]["update_date"];?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="question-item">
                        <div class="item-header h5 d-flex align-items-center justify-content-between font-weight-bold" id="headingNine">
                            <span>退款 🔙</span>
                            <div class="open" data-toggle="collapse" data-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                        <div id="collapseNine" class="collapse mt-3" aria-labelledby="headingNine" data-parent="#accordian">
                            <div class="item-body">
                                <p>支持退款</p>
                                <h5 class="font-weight-bold">但是</h5>
                                <p>只退<span class="font-weight-bold">80%</span>的钱，然后运会来的邮费要自理或者我们帮着你寄回来 (会给你一个详细地址让你寄过去)。</p>
                                <p class="text-danger small">非西班牙国家的请注意</p>
                                <p>到货才退钱，如果发现有破损我们只能退你<span class="font-weight-bold">30%</span>的钱</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="question-item">
                        <div class="item-header h5 d-flex align-items-center justify-content-between font-weight-bold" id="headingTen">
                            <span>支付方式 💳</span>
                            <div class="open" data-toggle="collapse" data-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                        <div id="collapseTen" class="collapse mt-3" aria-labelledby="headingTen" data-parent="#accordian">
                            <div class="item-body">
                                <p>支持很多支付方式</p>
                                <div class="bg-white px-3 py-4 my-2 box-shadow-round d-flex align-items-center">
                                    <div class="h2 mx-3" style="color:#7BB32E">
                                        <i class="fab fa-weixin"></i>
                                    </div>
                                    <div class="mx-2">
                                        <h5 class="font-weight-bold" style="color:#7BB32E">微信支付</h5>
                                        <p>红包，转账，二维码， 条码</p>
                                    </div>
                                </div>
                                <div class="bg-white px-3 py-4 my-2 box-shadow-round d-flex align-items-center">
                                    <div class="h2 mx-3" style="color:#0e9dec">
                                        <i class="fab fa-alipay"></i>
                                    </div>
                                    <div class="mx-2">
                                        <h5 class="font-weight-bold" style="color:#0e9dec">支付宝</h5>
                                        <p>红包，转账，二维码， 条码</p>
                                    </div>
                                </div>
                                <div class="bg-white px-3 py-4 my-2 box-shadow-round d-flex align-items-center">
                                    <div class="h2 mx-3" style="color:#000018">
                                        <i class="fab fa-qq"></i>
                                    </div>
                                    <div class="mx-2">
                                        <h5 class="font-weight-bold" style="color:#000018">QQ支付</h5>
                                        <p>红包，转账，二维码， 条码</p>
                                    </div>
                                </div>
                                <div class="bg-white px-3 py-4 my-2 box-shadow-round d-flex align-items-center">
                                    <div class="h2 mx-3" style="color:#00457C">
                                        <i class="fab fa-paypal"></i>
                                    </div>
                                    <div class="mx-2">
                                        <h5 class="font-weight-bold" style="color:#00457C">PayPal支付</h5>
                                        <p>转账，链接，二维码</p>
                                    </div>
                                </div>
                                <div class="bg-white px-3 py-4 my-2 box-shadow-round d-flex align-items-center">
                                    <div class="h2 mx-3" style="color:#90802F">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <div class="mx-2">
                                        <h5 class="font-weight-bold" style="color:#90802F">银行转账</h5>
                                        <p>网银，三方软件，ATM</p>
                                    </div>
                                </div>
                                <div class="bg-white px-3 py-4 my-2 box-shadow-round d-flex align-items-center">
                                    <div class="h2 mx-3" style="color:#1a1f71">
                                        <i class="fab fa-cc-visa"></i>
                                    </div>
                                    <div class="mx-2">
                                        <h5 class="font-weight-bold" style="color:#1a1f71">信用卡</h5>
                                        <p>Visa, Mastercard, 三方软件</p>
                                    </div>
                                </div>
                                <div class="bg-white px-3 py-4 my-2 box-shadow-round d-flex align-items-center">
                                    <div class="h2 mx-3" style="color:#f7931a">
                                        <i class="fab fa-bitcoin"></i>
                                    </div>
                                    <div class="mx-2">
                                        <h5 class="font-weight-bold" style="color:#f7931a">Bitcoin</h5>
                                        <p>看情况使用</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="adv text-center mt-5">
                <small>任何其他问题请私聊 ∠( ᐛ 」∠)＿</small>
            </div>
            <div class="mt-3 mb-5 pb-5 d-flex flex-column align-items-center justify-content-center">
                <img src="./view/resource/img/web/qr_weixin.jpg" alt="微信二维码" class="w-75">
                <div class="adv mt-2 text-center">
                    <small>微信号: zheng_ll03</small>
                </div>
            </div>
        </main>
    </div>
</section>
<script src="./view/resource/js/min/info.min.js?v=<?php echo $_SESSION['PWA']['version']?>" async defer></script>