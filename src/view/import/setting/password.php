<div class="d-none mt-4" id="alert">
    <div class="alert alert-danger mx-3">
        <i class="fas fa-exclamation"></i>
        <span id="text" class="ml-2 font-weight-bold"></span>
    </div>
</div>
<main class="mt-2 pt-3">
    <div id="changePassword_section" class="container mt-2 pt-2 mb-5">
        <div class="group my-3 ">
            <div class="px-3 py-2 d-flex justify-content-around align-items-center input-group-icon" id="input">
                <i class="fas fa-user-lock"></i>
                <input id="old-password-input" type="password" class="form-control mx-1" placeholder=" 使用中的密码">
                            <div id="open-password" onclick="openPassword(this, true)">
                    <i class="fas fa-eye" id="close"></i>
                    <i class="fas fa-eye-slash d-none" id="open"></i>
                </div>
            </div>
            <small class="adv mt-2 ml-3">正在使用的密码</small>
        </div>
        <div class="group my-3">
            <div class="px-3 py-2 d-flex justify-content-around align-items-center input-group-icon" id="input">
                <i class="fas fa-lock-open"></i>
                <input id="new-password-input" type="password" class="form-control mx-1" placeholder=" 新密码">
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
                <input id="new-repassword-input" type="password" class="form-control mx-1" placeholder=" 重写密码"> 
                <div id="open-password" onclick="openPassword(this, true)">
                    <i class="fas fa-eye" id="close"></i>
                    <i class="fas fa-eye-slash d-none" id="open"></i>
                </div>
            </div>
        </div>
        <div class="mt-5 pt-3">
            <button class="btn btn-danger btn-block py-3 font-weight-bold" id="password_button">更改</button>
        </div>
    </div>
    <div class="text-center adv font-weight-bold">
        <span>(ˆ(oo)ˆ)</span>
    </div>
</main>
<script>
function openPassword(dom, active){
    dom.querySelector((active)?"#close":"#open").classList.add("d-none");
    dom.querySelector((active)?"#open":"#close").classList.remove("d-none");
    dom.previousElementSibling.type = (active)?"text":"password";
    dom.onclick = ()=>{
        openPassword(dom, !active);
    }
}
const alert_dom = document.getElementById("alert");
function alertEl(active, text){
    if(active){
        alert_dom.querySelector("div > span#text").innerHTML = text;
        alert_dom.classList.remove("d-none");
    }else{
        alert_dom.classList.add("d-none");
    }
}
</script>