<main>
    <form method="post" id="form">
        <input type="number" name="value" step="0.01" placeholder="钱价" required><br><br>
        <input type="date" name="expire" required><br>
        <br>
        <br>
        <input type="submit" value="submit">
    </form>
    <br>
    <br>
    <br>
    <form method="post" id="form2">
        <input type="submit" value="查看未使用的">
    </form>
    <form method="post" id="form3">
        <input type="submit" value="查看未使用过期的">
    </form>
    <div id="info"></div>
</main>
<script>
    let form = document.getElementById("form");
    let form2 = document.getElementById("form2");
    let form3 = document.getElementById("form3");
    let info = document.getElementById("info");
    form.addEventListener("submit", e=>{
        e.preventDefault();
        let body = new FormData(form);
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("./view/api/coupon.php?type=new&code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        })
    }) 
    form2.addEventListener("submit", e=>{
        e.preventDefault();
        let body = new FormData(form);
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("./view/api/coupon.php?type=check&code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        })
    })
    form3.addEventListener("submit", e=>{
        e.preventDefault();
        let body = new FormData(form);
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("./view/api/coupon.php?type=check_expired&code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        })
    }) 
</script>