window.addEventListener("load", ()=>{
    let register_button = document.getElementById("register_button");

    let wechat_id = document.querySelector("input#wechat-input");

    let name = document.querySelector("input#name-input");
    let password = document.querySelector("input#password-input");
    let repassword = document.querySelector("input#repassword-input");
    register_button.addEventListener("click", ()=>{
        if(wechat_id.value && name.value && password.value && repassword.value){
            if(password.value == repassword.value){
                alertEl(false);
                let body = `wechat_id=${wechat_id.value}&name=${name.value}&password=${password.value}&code=${code}`;
                if(typeof invited !== 'undefined'){
                    body += `&inv=${invited}`;
                }
                register_button.disabled = true;
                fetch('../api/account?type=register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: body
                })
                .then(response => response.json())
                .then(data => {
                    register_button.disabled = false;
                    if(data.response == 200){
                        location.href = `../account?data=verify&code=${data.data.verify_code}`;
                    }else if(data.response == "exist"){
                        alertEl(true, `您好 ${data.data.name} 你已用这个微信号注册过账号`)
                    }
                });
            }else{
                alertEl(true, "密码不统一, 请确认");
            }
        }else{
            alertEl(true, "填完完整信息呢, 亲~");
        }
    });
})