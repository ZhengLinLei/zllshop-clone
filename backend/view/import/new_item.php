<main>
    <form id="form" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="标题" id="title" required>
        <textarea id="description" name="decription" cols="30" rows="10" placeholder="介绍" required></textarea><br><br>
        <div>["**海关**", "**电**", "**价钱**", "**征税**"]</div>
        <input type="number" name="price" step="0.01" placeholder="人民币价格" required>
        <select name="ship" required>
            <option selected>运费</option>
            <option value="1">包邮</option>
            <option value="0">不包邮</option>
        </select><br><br>
        <input required name="images[]" type="file" id="images" placeholder="最后的照片" accept="image/*" multiple>
        <input name="images2[]" type="file" id="images2" placeholder="照片" accept="image/*" multiple>
        <input name="image_name" type="text" id="image_name" placeholder="照片名字"><br><br>
        <select name="class" required>
        <!-- beauty, bag, accessories, clothes, shoe, electronic, toy, sport, furniture, entertainment -->
            <option selected>什么物品</option>
            <option value="beauty">美妆</option>
            <option value="bag">背包</option>
            <option value="accessories">饰品</option>
            <option value="clothes">服装</option>
            <option value="shoe">鞋子</option>
            <option value="electronic">电品</option>
            <option value="toy">玩具</option>
            <option value="sport">运动</option>
            <option value="furniture">家具</option>
            <option value="entertainment">娱乐</option>
        </select><br>
        <hr>
        <textarea name="words" cols="30" rows="10" placeholder="搜索词语 ',' 分割" required></textarea>
        <hr>
        <label>Tags</label>
        <input type="text" name="tag1" placeholder="Tag" required>
        <input type="text" name="tag2" placeholder="Tag" required>
        <input type="text" name="tag3" placeholder="Tag" required>
        <br><br>
        <input type="text" name="user_ship" placeholder="卖家微信号" required>
        <hr>

        <input type="submit" value="Submit">
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
        fetch("./view/api/item_shop.php?code=<?php echo $_SESSION["admin_security_token"]?>", {
            method: "POST",
            body: body
        })
        .then(response => response.text())
        .then(text =>{
            info.innerHTML = text;
        })
    }) 
</script>