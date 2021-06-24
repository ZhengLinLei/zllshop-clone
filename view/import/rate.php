<section id="rate">
    <div class="container">
        <header class="d-flex justify-content-between align-item-center py-2 pt-4 h4">
            <a href="javascript:window.history.back()">
                <i class="fas fa-chevron-left"></i>
            </a>
            <span class="h5 font-weight-bold mr-3 mb-0"><?php echo ($_GET["type"] == "app")?"APP评价":"购买评价"?></span>
        </header>
        <?php
            $_SESSION["security_token"] = rand();
            $mvc = new MVCcontroller();
            $mvc->include_submodules($_GET["page"], $_GET["type"]);
        ?>
    </div>
</section>