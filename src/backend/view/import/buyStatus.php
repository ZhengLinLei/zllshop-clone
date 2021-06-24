<main>
    <style>
    .sep{
        display: flex;
        justify-content: space-between;
    }
    </style>
    未处理
    <section id="searchId">
        <form method="POST" id="checkIdHistory">
            <input type="submit" value="查看">
        </form>
    </section>
    未运送
    <section id="searchId">
        <form method="POST" id="checkIdHistoryNOTFly">
            <input type="submit" value="查看">
        </form>
    </section>
    已运送
    <section id="searchId">
        <form method="POST" id="checkIdHistoryYESFly">
            <input type="submit" value="查看">
        </form>
    </section>
    <hr>
    单号查看
    <section id="searchId">
        <form method="POST" id="searchIdHistory">
            <input type="text" name="id">
            <input type="submit" value="查看">
        </form>
    </section>
    用户查看
    <section id="search">
        <form method="POST" id="searchUserHistory">
            <input type="text" name="user">
            <input type="submit" value="查看">
        </form>
    </section>
    跟踪
    <section id="updateStatus">
        <form method="POST" id="updateStatusF">
            <input type="text" name="id">
            <select name="value" id="value">
                <option value="未发货">未发货</option>
                <option value="已入仓库">已入仓库</option>
                <option value="已批准">已批准</option>
                <option value="已运送">已运送</option>
                <option value="已到达国家">已到达国家</option>
                <option value="等待签收">等待签收</option>
                <option value="已签收">已签收</option>
                <option value="已取消">已取消</option>
            </select>
            <input type="submit" value="更新">
        </form>
    </section>
    物流
    <section id="updateCode">
        <form method="POST" id="updateCodeF">
            <input type="text" name="id">
            <input type="text" name="value">
            <input type="submit" value="物流号">
        </form>
    </section>
    运送
    <section id="updateShipCode">
        <form method="POST" id="updateShipCodeF">
            <input type="text" name="id">
            <input type="text" name="value">
            <input type="submit" value="运送号">
        </form>
    </section>
    <hr>
    <div id="info"></div>
</main>
<script>
    let formCheckId = document.getElementById("checkIdHistory");
    let formCheckIdYESFly = document.getElementById("checkIdHistoryYESFly");
    let formCheckIdNOTFly = document.getElementById("checkIdHistoryNOTFly");
    let formSearchId = document.getElementById("searchIdHistory");
    let formSearch = document.getElementById("searchUserHistory");
    let formStatus = document.getElementById("updateStatusF");
    let formCode = document.getElementById("updateCodeF");
    let formShipCode = document.getElementById("updateShipCodeF");

    let info = document.getElementById("info");
    formCheckId.addEventListener("submit", e=>{
        e.preventDefault();
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("./view/api/buyStatus.php?type=todo_id&code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "GET",
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        });
    });
    formCheckIdYESFly.addEventListener("submit", e=>{
        e.preventDefault();
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("./view/api/buyStatus.php?type=todo_id_fly&status=yes&code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "GET",
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        });
    });
    formCheckIdNOTFly.addEventListener("submit", e=>{
        e.preventDefault();
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("./view/api/buyStatus.php?type=todo_id_fly&status=no&code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "GET",
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        });
    });
    formSearchId.addEventListener("submit", e=>{
        e.preventDefault();
        let body = new FormData(formSearchId);
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("./view/api/buyStatus.php?type=check_id&code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        });
    });
    formSearch.addEventListener("submit", e=>{
        e.preventDefault();
        let body = new FormData(formSearch);
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("./view/api/buyStatus.php?type=check_user&code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        });
    });
    formStatus.addEventListener("submit", e=>{
        e.preventDefault();
        let body = new FormData(formStatus);
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("./view/api/buyStatus.php?type=status&code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        });
    });
    formCode.addEventListener("submit", e=>{
        e.preventDefault();
        let body = new FormData(formCode);
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("./view/api/buyStatus.php?type=code&code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        });
    });
    formShipCode.addEventListener("submit", e=>{
        e.preventDefault();
        let body = new FormData(formShipCode);
        info.innerHTML = "请耐心等待上传， 上传完会显示";
        fetch("./view/api/buyStatus.php?type=ship_code&code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        });
    });
</script>