<main>
    <form id="form" method="post">
        <input type="text" name="id" placeholder="Id/微信号">
        <br>
        <input type="text" name="role" placeholder="分组 (代理， VIP， SVIP， 大老， 合作， 投资人)">
        <input type="text" name="range" placeholder="老顾客， 新用户， 老用户">
        <br>
        <br>
        <input type="submit" value="验证">
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
        fetch("./view/api/role_range.php?code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        })
    }) 
</script>