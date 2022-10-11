<?php
$_SESSION["security_token"] = rand();
if(isset($_SESSION["user"]) && !empty($_SESSION["user"]) && $_SESSION["user"]["login"]){
?>
<main class="mt-5 text-center">
        <div class="adv mt-5">对不起，你已在登录状态中 (º﹏º)</div>
        <a href="javascript:window.history.back()" class="d-block mt-5 h5 font-weight-bold u"><u>回去</u></a>
</main>
<?php
}else{
?>
<section id="account">
    <header class="text-center mt-4 mb-4">
        <span class="font-weight-bold h5"><?php echo ($_GET["type"] == "register")?"注册":"登录"?></span>
    </header>
    <div class="container d-none" id="alert">
        <div class="alert alert-danger mx-3">
            <i class="fas fa-exclamation"></i>
            <span id="text" class="ml-2 font-weight-bold"></span>
        </div>
    </div>
<?php
    $mvc = new MVCcontroller();
    
    $mvc->include_submodules($_GET["page"], $_GET["type"]);
?>
</section>
<script>
    const code = "<?php echo $_SESSION["security_token"];?>";

    function openPassword(dom, active){
        dom.querySelector((active)?"#close":"#open").classList.add("d-none");
        dom.querySelector((active)?"#open":"#close").classList.remove("d-none");
        dom.previousElementSibling.type = (active)?"text":"password";
        dom.onclick = ()=>{
            openPassword(dom, !active);
        }
    }

    const alert_dom = document.getElementById("alert");
    function alertEl(active, text){
        if(active){
            alert_dom.querySelector("div > span#text").innerHTML = text;
            alert_dom.classList.remove("d-none");
        }else{
            alert_dom.classList.add("d-none");
        }
    }
</script>
<script src="../view/resource/js/min/<?php echo $_GET["type"]?>.min.js?v=<?php echo $_SESSION['PWA']['version']?>" defer async></script>
<?php
}
?>