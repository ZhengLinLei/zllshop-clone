<div class="d-none mt-4" id="alert">
    <div class="alert alert-danger mx-3">
        <i class="fas fa-exclamation"></i>
        <span id="text" class="ml-2 font-weight-bold"></span>
    </div>
</div>
<main class="mt-4 pb-5 mb-5">
    <div id="changeProfile_section" class="container mt-2 mb-5">
        <div class="group my-3 ">
            <div class="mb-3 font-weight-bold">微信号</div>
            <div class="px-3 py-2 d-flex justify-content-around align-items-center input-group-icon" id="input_wechat">
                <i class="fab fa-weixin"></i>
                <input id="wechat_id" type="text" class="form-control mx-1" placeholder="<?php echo $_SESSION["user"]["data"]["wechat_id"] ?>">
            </div>
            <small class="adv mt-2 ml-3">! 更改微信号需要重新进行验证步骤</small>
        </div>
        <div class="group my-3 ">
            <div class="mb-3 font-weight-bold">姓名</div>
            <div class="px-3 py-2 d-flex justify-content-around align-items-center input-group-icon" id="input_name">
                <i class="fas fa-user-check"></i>
                <input id="name" type="text" class="form-control mx-1" placeholder="<?php echo $_SESSION["user"]["data"]["name"] ?>">
            </div>
        </div>
        <hr class="my-4">
        <div class="group my-3 ">
            <div class="mb-3 font-weight-bold">密码</div>
            <a href="./password">
                <div class="p-4 py-3 bg-white box-shadow-round small-round d-flex justify-content-between align-items-center">
                    <div class="h1 <?php echo ((strlen($_SESSION["user"]["data"]["password"] >= 8) && preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $_SESSION["user"]["data"]["password"])) ? "text-success" : "adv") ?>">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <div class="font-weight-bold small mb-2"><?php echo ((strlen($_SESSION["user"]["data"]["password"] >= 8) && preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $_SESSION["user"]["data"]["password"])) ? "你设置的密码很安全" : "你设置的密码可以提高") ?></div>
                        <div class="small font-weight-bold">
                            <div class="<?php echo ((strlen($_SESSION["user"]["data"]["password"] >= 8)) ? "text-success" : "text-danger") ?>">· 8-12字以内</div>
                            <div class="<?php echo ((preg_match('/[0-9]/', $_SESSION["user"]["data"]["password"])) ? "text-success" : "text-danger") ?>">· 有数字</div>
                            <div class="<?php echo ((preg_match('/[a-zA-Z]/', $_SESSION["user"]["data"]["password"])) ? "text-success" : "text-danger") ?>">· 有字母</div>
                        </div>
                    </div>
                    <div class="h5">
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </a>
            <small class="adv mt-2 ml-3">密码由智能识别，人工无法查看</small>
        </div>
        <div class="mt-5">
            <div id="accordian" role="tablist" aria-multiselectable="true" class="mt-5">
                <div class="question-item">
                    <div class="item-header h5 d-flex align-items-center justify-content-between font-weight-bold" id="headingOne">
                        <span>选择性填写</span>
                        <div class="open" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse mt-5" aria-labelledby="headingOne" data-parent="#accordian">
                        <div class="group my-4">
                            <div class="mb-3 font-weight-bold">生日日期 🎂</div>
                            <div class="px-3 py-2 d-flex justify-content-around align-items-center input-group-icon" id="input_birthday">
                                <i class="fas fa-birthday-cake"></i>
                                <input id="birthday" type="date" class="form-control mx-1" <?php echo ($_SESSION["user"]["data"]["user_birthday"] != '0000-00-00')?("value=".$_SESSION["user"]["data"]["user_birthday"]." disabled"):"" ?>>
                            </div>
                            <?php 
                            if($_SESSION["user"]["data"]["user_birthday"] != '0000-00-00'){
                            ?>
                                <small class="text-success mt-2 ml-3">已填写日期 (不可更改)</small>
                            <?php
                            }else{
                            ?>
                                <small class="adv mt-2 ml-3">! 填写完不可更改, 填写出生日期 (填写有惊喜)</small>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="group my-4">
                            <div class="mb-3 font-weight-bold">电子邮件</div>
                            <div class="alert alert-danger small p-2 px-3 d-none" id="alert_verify">错误</div>
                            <div class="px-3 py-2 d-flex justify-content-around align-items-center input-group-icon" id="input_email">
                                <i class="fas fa-envelope"></i>
                                <input id="email" type="mail" class="form-control mx-1" placeholder="<?php echo (empty(($_SESSION["user"]["data"]["email"]))?"输入电子邮件":$_SESSION["user"]["data"]["email"])?>" value="<?php echo (!empty($_SESSION["user"]["data"]["email"]))?$_SESSION["user"]["data"]["email"]:""?>" <?php echo !empty($_SESSION["user"]["data"]["email"]) && ($_SESSION["user"]["data"]["email_verify_code"])?"disabled":""?>>
                                <div style="white-space:nowrap;">
                                    <a class="color-2 font-weight-bold small" id="email_button">获取验证码</a>
                                </div>
                            </div>
                            <div class="my-3 d-none" id="verify_code_section">
                                <div class="inputs justify-content-around d-flex">
                                    <input type="text" class="email_verify_code px-2 h5 my-0" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                    <input type="text" class="email_verify_code px-2 h5 my-0" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                    <input type="text" class="email_verify_code px-2 h5 my-0" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                    <input type="text" class="email_verify_code px-2 h5 my-0" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                    <button class="btn btn-light box-shadow-round px-4 py-2 font-weight-bold color-2" type="button" id="button_email_verify">验证</button>
                                </div>
                                <div class="font-weight-bold text-warning small mt-3 mx-3">
                                    <p class="m-0">· 请在邮箱里查看我们给你发的 [验证码]</p>
                                    <p class="m-0">· 如未收到信息请点击重新发送</p>
                                </div>
                            </div>
                            <script>
                                const email_data = {
                                    code: <?php echo (!empty($_SESSION["user"]["data"]["email"]) && $_SESSION["user"]["data"]["email_verify_code"])?"true":"false"?>,
                                    email: "<?php echo ((!empty($_SESSION["user"]["data"]["email"]) && !$_SESSION["user"]["data"]["email_verify_code"])?"":$_SESSION["user"]["data"]["email"])?>",
                                    send: true
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 pt-3">
            <button class="btn btn-danger btn-block py-3 font-weight-bold" id="profile_button">更改</button>
        </div>
    </div>
</main>