<section id="setting">
<?php
$_SESSION["security_token"] = rand();
if(isset($_SESSION["user"]) && !empty($_SESSION["user"]) && $_SESSION["user"]["login"]){
?>
    <div class="container">
        <header class="d-flex justify-content-between align-items-center py-2 pt-4 h4">
            <a href="javascript:(history.length >= 3)?window.history.back():location.href='../user';">
                <i class="fas fa-chevron-left"></i>
            </a>
            <?php $arr_type = ["history" => "购买记录", "location" => "地址", "invite" => "邀请朋友", "password" => "更改密码", "profile" => "个人资料"];?>
            <span class="h5 font-weight-bold mr-3 mb-0"><?php echo $arr_type[$_GET["type"]]?></span>
        </header>
        <?php
        $mvc = new MVCcontroller();
        $mvc->include_submodules($_GET["page"], $_GET["type"]);
        if($_GET["type"] != "history"){
        ?>
            <script>
                const code = <?php echo $_SESSION["security_token"];?>;
            </script>
            <script src="../view/resource/js/min/setting_<?php echo $_GET["type"]?>.min.js?v=<?php echo $_SESSION['PWA']['version']?>" defer async></script>
        <?php
        }
        ?>
    </div>
<?php
}else{
?>
    <main class="mt-5 text-center">
        <div class="adv mt-5">你未登录，无法查看</div>
        <a href="<?php echo (isset($_SESSION["pre_url"]))?(($_SESSION["pre_url"] != $_SERVER['REQUEST_URI'])?$_SESSION["pre_url"]:"../user"):"../user"?>" class="d-block mt-5 h5 font-weight-bold u"><u>回去</u></a>
    </main>
<?php
}
?>
</section>