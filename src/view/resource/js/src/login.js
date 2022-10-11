window.addEventListener("load", ()=>{
    let login_button = document.getElementById("login_button");

    let wechat_id = document.querySelector("input#wechat-input");
    let password = document.querySelector("input#password-input");
    let autologin = document.querySelector("input#autologin");

    $('a[data-toggle="tooltip"]').tooltip();
    
    login_button.addEventListener("click", ()=>{
        if(wechat_id.value && password.value){
            alertEl(false);
            let body = `wechat_id=${wechat_id.value}&password=${password.value}&code=${code}&autologin=${autologin.checked}`;
            login_button.disabled = true;
            fetch('../api/account?type=login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: body
            })
            .then(response => response.json())
            .then(data => {
                login_button.disabled = false;
                if(data.response == 200){
                    if(history.length >= 3){
                        window.history.back();
                    }else{
                        location.href = "../user";
                    }
                }else if(data.response == "verify"){
                    location.href = `../account?data=verify&code=${data.data.verify_code}`;
                }else if(data.response == "empty"){
                    alertEl(true, "你填写的微信号或者密码不正确");
                }
            });
        }else{
            alertEl(true, "填完完整信息呢, 亲~");
        }
    });
})