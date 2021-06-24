<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BACKEND ZLLshop</title>
    <style>
        body > div[style="text-align:right;position:fixed;bottom:3px;right:3px;width:100%;z-index:999999;cursor:pointer;line-height:0;display:block;"]{
            display: none !important;
        }
    </style>
</head>
<body>
    <?php
    $arr = ["new_item", "new_coupon", "verify_account", "buy", "buyStatus", "role_range", "location", "sql"];
    if(isset($_GET["page"]) && in_array($_GET["page"], $arr)){
        $mvc = new MVCcontroller();
        $mvc->include_modules($_GET["page"]);
    }else{
    ?>
        <a href="./new_item">添加新物品</a><br>
        <a href="./new_coupon">新折扣码</a><br>
        <a href="./verify_account">验证注册号</a><br>
        <a href="./buy">购买</a><br>
        <a href="./buyStatus">跟踪</a><br>
        <a href="./role_range">权力</a><br>
        <a href="./location">地址</a><br>
        <a href="./sql">SQL</a>
    <?php
    }
    ?>
</body>
</html>