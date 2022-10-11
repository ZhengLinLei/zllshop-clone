function deleteFnc(id){
    let body = "id="+id+"&code="+code;
    
    fetch('./api/item?type=remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: body
    })
    .then(response => response.json())
    .then(data => {
        if(data.response == 200){
            location.href = location.href;
        }
    });
}
function deleteAll(){
    let body = "code="+code;
    
    fetch('./api/item?type=delete_all', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: body
    })
    .then(response => response.json())
    .then(data => {
        if(data.response == 200){
            location.href = location.href;
        }
    });
}
function buyCart(){
    if(buyCode){
        let money = document.querySelector("input#use_money");
        if(money.checked){
            location.href = `./cart/buy?cart=${buyCode}&use_money=true`;
        }else{
            location.href = `./cart/buy?cart=${buyCode}`;
        }
    }
}