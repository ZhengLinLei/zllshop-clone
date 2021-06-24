<main>
    <style>
    .sep{
        display: flex;
        justify-content: space-between;
    }
    </style>
    <section id="qr">
        <form enctype="multipart/form-data" method="POST" id="qrForm">
            <!-- MAX_FILE_SIZE (maximum file size in bytes) must precede the file input field used to upload the QR code image -->
            <!-- <input type="text" name="MAX_FILE_SIZE" value="1048576"> -->
            <!-- The "name" of the input field has to be "file" as it is the name of the POST parameter -->
            Choose QR code image to read/scan: <input name="file" type="file" />
            <input type="submit" value="Read QR code" />
        </form>
    </section>
    <hr>
    <hr>
    <hr>
    <section id="json">
        <form method="POST" id="jsonForm">
            <textarea name="json" cols="30" rows="10" id="textarea"></textarea>
            <input type="submit" value="Request">
        </form>
    </section>
    <hr>
    <div id="info"></div>
    <hr>
    <section id="prepare">
        <form method="POST" id="prepareForm">
            <input type="number" step="0.01" placeholder="最后价格" name="resultPrice">
            <input type="text" placeholder="差距 +12.50, -2.5" name="priceGap">
            <br>
            <input type="number" step="0.01" name="minusMoney" placeholder="用户现金减掉">
            <textarea name="priceComment" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="提交">
        </form>
    </section>
</main>
<script>
    let formQR = document.getElementById("qrForm");
    let formJSON = document.getElementById("jsonForm");
    let formPREPARE = document.getElementById("prepareForm");
    let textareaJSON = formJSON.querySelector("textarea#textarea")
    let info = document.getElementById("info");
    let jsonToServer;
    formQR.addEventListener("submit", e=>{
        e.preventDefault();
        let body = new FormData(formQR);
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("http://api.qrserver.com/v1/read-qr-code/", {
            method: "POST",
            body: body
        })
        .then(response => response.json())
        .then(json =>{
            textareaJSON.value = json[0].symbol[0].data;
            console.log(JSON.parse(json[0].symbol[0].data));
        })
    });
    formJSON.addEventListener("submit", e=>{
        e.preventDefault();
        let body = new FormData(formJSON);
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("./view/api/buy.php?type=request&code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.json())
        .then(json =>{
            if(json.response == 200){
                info.innerHTML = `<div class="sep">微信号: ${json.user.wechat_id}  金钱: ${json.user.user_money_coin}￥</div>`;
                info.innerHTML += `<div class="sep">地址: ${json.user.user_location}  <br><br>消费: ${json.user.user_buy_all_money}￥</div>`;
                json.cart.data.forEach((element, key) => {
                    info.innerHTML += `<div>
                                        <br><br>
                                        <div><b>${key}</b></div>
                                        <div><a href="../item?item=${element.id}" target="_blank">${element.item_name}</a></div>
                                        <div class="sep">
                                            <span>${element.id}: </span>
                                            <span>${element.item_price_yuan}￥ - ${element.item_price_euro}€</span>
                                            <span>x${element.number_item}</span>
                                            <span>邮:${element.item_price_ship}</span>
                                            <span>总算:${element.item_total_price}￥ - ${element.item_price_euro*element.number_item} €</span>
                                        </div>
                                        <div>${(element.text)?element.text:"没有备注"}</div>
                                    </div>`;
                });
                info.innerHTML += `<br><br><br><div class="sep">总共: ${json.cart.total_price}￥${json.cart.total_price/8}€  <br>使用金钱: ${json.cart.use_money}</div>`;
                jsonToServer = json;
                console.log(json);
            }else{
                info.innerHTML = JSON.stringify(json);
            }
        });
    });
    formPREPARE.addEventListener("submit", e=>{
        if(jsonToServer){
            e.preventDefault();
            let body = new FormData(formPREPARE);
            body.append("json", JSON.stringify(jsonToServer));
            fetch("./view/api/buy.php?type=upload&code=<?php echo $_SESSION["admin_security_token"]?>", {
                method: "POST",
                body: body
            })
            .then(response => response.text())
            .then(text =>{
                alert(text);
            })
        }else{
            alert("denied");
        }
    });
</script>