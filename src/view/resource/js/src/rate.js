window.addEventListener("load", ()=>{
    const alert_dom = document.getElementById("alert");
    function alertEl(active){
        if(active){
            alert_dom.classList.remove("d-none");
        }else{
            alert_dom.classList.add("d-none");
        }
    }
    let rateApp = document.querySelector("button#rateApp");
    let rateBuy = document.querySelector("button#rateBuy");
    if(rateApp){
        rateApp.addEventListener("click", ()=>{
            if(AppRate.rate > 0 && AppRate.rate <= 5){
                let body = `rate=${AppRate.rate}&code=${code}&comment=${document.querySelector("#argue > textarea").value}`;
                rateApp.disabled = true;
                fetch('../api/rate?type=app', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: body
                })
                .then(response => response.json())
                .then(data => {
                    if(data.response == 200){
                        alertEl(true);
                        setTimeout(()=>{
                            alertEl(false);
                        }, 5000);
                        document.getElementById("closeModal").click();
                        document.querySelector("header#rateSection").innerHTML = "";
                        document.querySelector('main main').insertAdjacentHTML('afterBegin', data.data);
                    }else{
                        document.querySelector("div#advert").innerHTML = "<small class='text-danger'>发生不可描述的事情，请重新发送</small>";
                    }
                });
            }
        });
    }else
    if(rateBuy){
        rateBuy.addEventListener("click", ()=>{
            if(AppRate.rate > 0 && AppRate.rate <= 5 && document.querySelector("#day > input").value){
                let body = `rate=${AppRate.rate}&code=${code}&id=${rateItem}&day=${document.querySelector("#day > input").value}&comment=${document.querySelector("#argue > textarea").value}`;
                rateBuy.disabled = true;
                fetch('../api/rate?type=buy', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: body
                })
                .then(response => response.json())
                .then(data => {
                    if(data.response == 200){
                        location.href = "./buy";
                    }else{
                        document.querySelector("div#advert").innerHTML = "<small class='text-danger'>发生不可描述的事情，请重新发送</small>";
                    }
                });
            }
        });
    }
});
const AppRate = {
    rate: 0,
    star: {
        up: '<i class="fas fa-star"></i>',
        down: '<i class="far fa-star"></i>'
    }
}
function getStar(item){
    for (let i = 1; i <= item.getAttribute('star'); i++) {
        let el = document.querySelector(`.star${i}`);
        el.classList.add("anim");
        setTimeout(()=>{
            el.classList.remove("anim");
        }, 600);
        el.innerHTML = AppRate.star.up;
    }
    for (let i = parseInt(item.getAttribute('star'))+1; i <= 5; i++) {
        let el = document.querySelector(`.star${i}`);
        el.classList.remove("anim");
        el.innerHTML = AppRate.star.down;
    }
    AppRate.rate = item.getAttribute('star');
}