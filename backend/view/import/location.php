<main>
    <form id="form" method="post">
        <input type="text" name="user" placeholder="微信号">
        <input type="submit" value="安排">
    </form>
    <div id="info"></div>
</main>
<script>
    let form = document.getElementById("form");
    let info = document.getElementById("info");
    form.addEventListener("submit", e=>{
        e.preventDefault();
        let body = new FormData(form);
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("./view/api/location.php?code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.json())
        .then(json =>{
            info.innerHTML = `钱: ${json.user_money_coin} <br> 积分: ${json.user_points} <br> 购买: ${json.user_buy_all_money} <br> 微信: ${json.wechat_id} <br><br> 地址: ${json.user_location}`;
        })
    }) 
</script>