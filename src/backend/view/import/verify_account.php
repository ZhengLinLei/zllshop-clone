<main>
    <form id="form" method="post">
        <textarea name="text_verify" cols="30" rows="10"></textarea><br>
        <input type="checkbox" name="admin">
        Admin
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
        fetch("./view/api/verify_account.php?code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        })
    }) 
</script>