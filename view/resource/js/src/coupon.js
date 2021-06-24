window.addEventListener("load", ()=>{
    const alert_dom = document.getElementById("alert");
    function alertEl(active, text){
        if(active){
            alert_dom.querySelector("div > span#text").innerHTML = text;
            alert_dom.classList.remove("d-none");
        }else{
            alert_dom.classList.add("d-none");
        }
    }

    let button_add_code = document.querySelector("button#button_add_code");
    let input_code = document.querySelector("input#coupon-input");
    button_add_code.addEventListener("click", ()=>{
        if(input_code.value){
            let body = `coupon_code=${input_code.value}&code=${code}`;
            fetch('./api/coupon', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: body
            })
            .then(response => response.json())
            .then(data => {
                if(data.response == 200){
                    let yuan = document.getElementById("yuan");
                    let euro = document.getElementById("euro");

                    yuan.innerHTML = parseFloat(data.data.yuan);
                    euro.innerHTML = parseFloat(data.data.euro);
                    input_code.value = "";
                }else if(data.response == "empty"){
                    alertEl(true, `你使用的折扣码无效`);
                }else if(data.response == "used"){
                    alertEl(true, `此折扣码已被人使用`);
                }
            });
        }
    })
})