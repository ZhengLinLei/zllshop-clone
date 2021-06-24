<main class="mb-5">
    <div class="container">
    <?php
    if((isset($_GET["inv"]) && is_numeric($_GET["inv"]) && !empty($_GET["inv"]) && $_GET["inv"] > 0) || (isset($_SESSION["inv"]))){
        if(!isset($_SESSION["inv"]) || ($_SESSION["inv"]["id"] != $_GET["inv"] && !empty($_GET["inv"]) && $_GET["inv"] > 0)){
            $mvc = new MVCcontroller();
            $_SESSION["inv"]["id"] = $_GET["inv"];
            $inv = $mvc->getUserData($_GET["inv"]); 
            $_SESSION["inv"]["data"] = ((empty($inv))?((isset($_SESSION["inv"]["data"]))?$_SESSION["inv"]["data"]:""):$inv[0]);
        }
        if(!empty($_SESSION["inv"]["data"])){
    ?>
        <div class="text-center adv mb-4 mt-3 pt-2">
            <span class="color-2 font-weight-bold"><?php echo $_SESSION["inv"]["data"]["name"]?> </span><span>邀请你注册号</span>
        </div>
        <section id="ad_main">
            <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <a type="button" class="close text-white fixed-bottom text-center mb-5 pb-5" data-dismiss="modal" aria-label="Close" id="closeModal">
                    <span aria-hidden="true" class="h1"><i class="far fa-times-circle"></i></span>
                </a>
                <div class="modal-dialog modal-dialog-centered text-center fixed-center w-100">
                    <span class="text-center font-weight-bold color-2 h5" style="transform:rotate(7deg) translate(-50%, 10px);position:absolute;left:50%"><?php echo $_SESSION["inv"]["data"]["name"]?></span>
                    <img role="document" src="../view/resource/img/web/invitation_account.svg" alt="注册" class="w-100">
                </div>
            </div>
        </section>
        <script>
            const invited = "<?php echo $_SESSION['inv']['data']['wechat_id']?>";
            window.addEventListener("load", ()=>{
                //Show invitation
                if(document.querySelector("#ad_main")){
                    $('#Modal').modal('show');
                }
            })
        </script>
    <?php
        }
    }
    ?>
        <div id="register_section" class="container mt-2 pt-2 mb-5">
            <div class="group my-3 ">
                <div class="px-3 py-2 d-flex justify-content-around align-items-center input-group-icon" id="input">
                    <i class="fab fa-weixin"></i>
                    <input id="wechat-input" type="text" class="form-control mx-1" placeholder=" 微信号">
                </div>
                <small class="adv mt-2 ml-3">使用真正的微信号</small>
            </div>
            <div class="group my-3 mt-5">
                <div class="px-3 py-2 my-3 d-flex justify-content-around align-items-center input-group-icon" id="input">
                    <i class="fas fa-user-check"></i>
                    <input id="name-input" type="text" class="form-control mx-1" placeholder=" 姓名">
                </div>
            </div>
            <div class="group my-3">
                <div class="px-3 py-2 d-flex justify-content-around align-items-center input-group-icon" id="input">
                    <i class="fas fa-lock-open"></i>
                    <input id="password-input" type="password" class="form-control mx-1" placeholder=" 密码">
                    <div id="open-password" onclick="openPassword(this, true)">
                        <i class="fas fa-eye" id="close"></i>
                        <i class="fas fa-eye-slash d-none" id="open"></i>
                    </div>
                </div>
                <small class="adv mt-2 ml-3">密码最好8-20字母</small>
            </div>
            <div class="group my-3">
                <div class="px-3 py-2 my-3 d-flex justify-content-around align-items-center input-group-icon" id="input">
                    <i class="fas fa-lock"></i>
                    <input id="repassword-input" type="password" class="form-control mx-1" placeholder=" 重写密码">
                    <div id="open-password" onclick="openPassword(this, true)">
                        <i class="fas fa-eye" id="close"></i>
                        <i class="fas fa-eye-slash d-none" id="open"></i>
                    </div>
                </div>
            </div>
            <div class="mt-5 pt-3">
                <button class="btn btn-danger btn-block py-3 font-weight-bold" id="register_button">注册</button>
            </div>
        </div>
        <div class="text-center adv font-weight-bold">
            <span>(ˆ(oo)ˆ)</span>
        </div>
    </div>
</main>