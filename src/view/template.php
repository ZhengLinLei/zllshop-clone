<!DOCTYPE html>
<html lang="zh-Hans">

<head>
    <title>🛒 郑林磊 · 小卖部</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Own Font -->
    <link rel="stylesheet" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/font/font.css">
    <!-- Own Style -->
    <link rel="stylesheet" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/css/index.css?v=<?php echo $_SESSION['PWA']['version']?>">
    <link rel="icon" type="image/ico" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/favicon.ico">
    <!-- APPLE, SUPPORT -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/appleIcon57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/appleIcon60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/appleIcon72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/appleIcon76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/appleIcon114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/appleIcon120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/appleIcon144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/appleIcon152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/appleIcon180x180.png">
    <!-- NORMAL PHONE PC -->
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/androidIcon192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/favicon32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/favicon96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/favicon16x16.png">
    <!-- OLD BROWNSER -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/resource/img/web/favicon/msIcon144x144.png">
    <meta name="theme-color" content="#756c83">
    <!-- MANIFEST JSON -->
    <link rel="manifest" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/manifest.json?v=<?php echo $_SESSION['PWA']['version']?>">
    <link rel="manifest" href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>view/manifest.webmanifest?v=<?php echo $_SESSION['PWA']['version']?>">
</head>

<body>
    <?php
    $mvc = new MVCcontroller();

    if (isset($_GET["page"])) {
        ##Individual Page
        $mvc->include_modules($_GET["page"]);
    } else {
        if (empty($_GET)) {
            ##Welcome
            $mvc->include_modules('welcome');
        }
        ##Individual Page
        $mvc->include_modules('category');
    }

    ?>
    <footer class="footer fixed-bottom d-flex m-0 py-4 pb-4 px-2 justify-content-around align-items-center h5" id="footer">
        <div class="<?php echo (!isset($_GET["page"]) || $_GET["page"] == "category") ? "active" : "disabled" ?>">
            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>category">
                <i class="fas fa-search"></i>
            </a>
        </div>
        <div class="<?php echo (isset($_GET["page"]) && $_GET["page"] == "recommend") ? "active" : "disabled" ?>">
            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>recommend">
                <i class="fas fa-gem"></i>
            </a>
        </div>
        <div id="footer-cart" class="<?php echo (isset($_GET["page"]) && $_GET["page"] == "cart") ? "active" : "disabled" ?>">
            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>cart">
                <i class="fas fa-shopping-bag"></i>
                <?php
                if (isset($_SESSION["item_cart"]) && !empty($_SESSION["item_cart"])) :
                ?>
                    <span class="badge badge-pill badge-danger small" id="notification"><?php echo count($_SESSION["item_cart"]); ?></span>
                <?php
                endif;
                ?>
            </a>
        </div>
        <?php
        if(isset($_SESSION["user"]) && !empty($_SESSION["user"]) && $_SESSION["user"]["login"] && $_SESSION["user"]["data"]["user_role"] === "代理"){
        ?>
        <div class="disabled">
            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>setting/history">
                <i class="fas fa-history"></i>
                <span class="badge badge-pill badge-danger small" id="notification_role">代理区</span>
            </a>
        </div>
        <?php
        }
        ?>
        <div class="<?php echo (isset($_GET["page"]) && $_GET["page"] == "user") ? "active" : "disabled" ?>">
            <a href="<?php echo (isset($_GET['type'])) ? '../' : './' ?>user">
                <i class="fas fa-user"></i>
            </a>
        </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Font-Awesome-JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" integrity="sha512-F5QTlBqZlvuBEs9LQPqc1iZv2UMxcVXezbHzomzS6Df4MZMClge/8+gXrKw2fl5ysdk4rWjR0vKS7NNkfymaBQ==" crossorigin="anonymous" async></script>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('<?php echo (isset($_GET['type'])) ? '../' : './' ?>sw.min.js?v=<?php echo $_SESSION['PWA']['version']?>')
                .then(function(registration) {
                    // Registration was successful
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    // registration failed :(
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
</body>

</html>