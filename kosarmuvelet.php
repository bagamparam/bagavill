<div id="menu">
    <?php require "menu.php" ?>
</div>

<?php 
    $action = $_GET["action"];
    $product_id = $_GET["id"];

    $user->kosarMuv($action, $product_id)

    
?>