<main class="mb-5">
    <div class="container">
        <div id="login_section" class="container mt-2 pt-2 mb-5">
            <div class="group my-3 ">
                <div class="px-3 py-2 d-flex justify-content-around align-items-center input-group-icon" id="input">
                    <i class="fab fa-weixin"></i>
                    <input id="wechat-input" type="text" class="form-control mx-1" placeholder=" 微信号"> 
                </div>
                <small class="adv mt-2 ml-3">注册中使用的微信号</small>
            </div>
            <div class="group my-3 ">
                <div class="px-3 py-2 my-3 d-flex justify-content-around align-items-center input-group-icon" id="input">
                    <i class="fas fa-lock"></i>
                    <input id="password-input" type="password" class="form-control mx-1" placeholder=" 密码"> 
                    <div id="open-password" onclick="openPassword(this, true)">
                        <i class="fas fa-eye" id="close"></i>
                        <i class="fas fa-eye-slash d-none" id="open"></i>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="autologin">
                        <label class="form-check-label" for="autologin">
                            自动登录
                        </label>
                    </div>
                </div>
                <div>
                    <a href="#" class="color-2" data-toggle="tooltip" data-placement="bottom" title="忘了?, 快联系我们">忘记密码</a>
                </div>
            </div>
            <div class="mt-5 pt-3">
                <button class="btn btn-danger btn-block py-3 font-weight-bold" id="login_button">登录</button>
            </div>
        </div>
        <div class="text-center adv font-weight-bold">
            <span>(￣﹃￣)</span>
        </div>
    </div>
</main>