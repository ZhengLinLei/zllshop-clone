<main>
    <form id="form" method="post">
        <textarea name="sql" cols="30" rows="10"></textarea>
        <div style="font-size:10px;">
            <p>SELECT * FROM `[tabla]` WHERE ...</p>
            <p>INSERT INTO `[tabla]` (`1`, `2`, ...) VALUES("1", "2", ...)</p>
            <p>UPDATE `[tabla]` SET `1`="1", ... WHERE ...</p>
            <p>DELETE FROM `[tabla]` WHERE ...</p>
        </div>
        <input type="text" name="password" placeholder="MySql密码">
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
        fetch("./view/api/sql.php?code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        })
    }) 
</script>