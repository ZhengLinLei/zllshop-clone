window.addEventListener("load", () => {
    const alert_dom = document.getElementById("alert");
    function alertEl(active, text) {
        if (active) {
            alert_dom.querySelector("div > span#text").innerHTML = text;
            alert_dom.classList.remove("d-none");
        } else {
            alert_dom.classList.add("d-none");
        }
    }
    //----------------
    let profileButton = document.getElementById("profile_button");
    //inputs
    let wechatId = document.getElementById("wechat_id");
    let userName = document.getElementById("name");
    let birthday = document.getElementById("birthday");
    //Email
    let email = document.getElementById("email");
    let email_button = document.getElementById("email_button");
    let code_input = document.querySelectorAll(".email_verify_code");
    let code_button = document.getElementById("button_email_verify");

    code_input.forEach((el, index)=>{
        el.addEventListener("keyup", e=>{
            if(index < code_input.length-1){
                if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)){
                    code_input[index+1].focus();
                }
            }
            if(index > 0){
                if(e.keyCode == 8){
                    code_input[index-1].focus();
                }
            }
        });
    });
    if(email_data.code){
        email_button.innerHTML = "重新发送";
        $('#verify_code_section').addClass('d-block');
    }
    email_button.addEventListener("click", () => {
        if (email.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && email_data.send){
            if(!email_data.email){
                email_data.email = email.value;
            }
            email.value = email_data.email;
            email_data.send = false;
            email_button.innerHTML = `<div class="spinner-border text-secondary" role="status" style="width:1rem;height:1rem;"></div>`;
            fetch('../api/user?type=email&content=send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `code=${code}&email=${email_data.email}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.response == 200) {
                        $('#verify_code_section').addClass('d-block');
                        email_data.code = true;
                        email.disabled = true;
                        let num = 60;
                        let again = setInterval(()=>{
                            email_button.innerHTML = `${num}秒后重新`;
                            num --;
                            if(num == 0){
                                clearInterval(again);
                                email_data.send = true;
                                email_button.innerHTML = "重新发送";
                            }
                        }, 1000);
                    }else{
                        $('#alert_verify').addClass('d-block');
                        $('#alert_verify').html(data.error);
                        email_data.send = true;
                        email.disabled = false;
                    }
                });
        }
    });
    code_button.addEventListener("click", ()=>{
        if(email_data.code && code_input[0].value && code_input[1].value && code_input[2].value && code_input[3].value){
            let verify_code =  code_input[0].value+code_input[1].value+code_input[2].value+code_input[3].value;
            code_button.disabled = true;
            fetch('../api/user?type=email&content=verify_code', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `code=${code}&verify_code=${verify_code}&email=${email_data.email}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.response == 200) {
                        $('#alert_verify').removeClass('alert-danger');
                        $('#alert_verify').addClass('d-block alert-success');
                        $('#alert_verify').html('<i class="far fa-check-circle mr-2"></i>验证完毕');
                        $('#verify_code_section').removeClass('d-block');
                        email_data.email = "";
                        setTimeout(()=>{
                            $('#alert_verify').removeClass('d-block');
                        }, 4000);
                    }else{
                        code_button.disabled = false;
                        $('#alert_verify').addClass('d-block');
                        $('#alert_verify').html(data.error);
                        setTimeout(()=>{
                            $('#alert_verify').removeClass('d-block');
                        }, 4000);
                    }
                });
        }
    });
    profileButton.addEventListener("click", () => {
        if ((wechatId.value && wechatId.value != wechatId.getAttribute("placeholder")) ||
            (userName.value && userName.value != userName.getAttribute("placeholder")) ||
            (birthday.value && !birthday.disabled)) {
            let body = `code=${code}`;
            profileButton.disabled = true;

            if (wechatId.value && wechatId.value != wechatId.getAttribute("placeholder")) {
                body += `&wechat_id=${wechatId.value}`;
            }
            if (userName.value && userName.value != userName.getAttribute("placeholder")) {
                body += `&user_name=${userName.value}`;
            }
            if (birthday.value && !birthday.disabled) {
                body += `&birthday=${birthday.value}`;
            }
            fetch('../api/user?type=profile', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: body
            })
                .then(response => response.json())
                .then(data => {
                    profileButton.disabled = false;
                    if (data.response == 200) {
                        if (data.data.type == "other") {
                            location.href = "../user";
                        } else {
                            location.href = `../account?data=verify&code=${data.data.verify_code}`;
                        }
                    } else if (data.response == "exist") {
                        alertEl(true, "已有人使用此微信号注册过");
                    }
                });
        }
    })
});