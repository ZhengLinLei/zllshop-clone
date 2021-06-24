window.addEventListener("load", ()=>{
    let passwordButton = document.getElementById("password_button");
    //inputs
    let oldPassword = document.getElementById("old-password-input"); 
    let newPassword = document.getElementById("new-password-input");
    let newRepassword = document.getElementById("new-repassword-input");

    passwordButton.addEventListener("click", ()=>{
        if(oldPassword.value && newPassword.value && newRepassword.value){
            if(newPassword.value == newRepassword.value){
                let body = `code=${code}&old_password=${oldPassword.value}&new_password=${newPassword.value}`;
                passwordButton.disabled = true;
                fetch('../api/user?type=password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: body
                })
                .then(response => response.json())
                .then(data => {
                    if(data.response == 200){
                        location.href = "../user";
                    }else if(data.response == "incorrect_password"){
                        alertEl(true, "请检查你旧的密码是否正确");
                    }
                });
            }else{
                alertEl(true, "请检查你的新密码是否重写正确");
            }
        }
    })
});