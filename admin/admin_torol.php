<div class="admin">
    <?php require "../header.php"; ?>

<div id="adminmenu">
    <?php require "adminmenu.php" ?>
</div>

<div id="adminmain">
    <?php 
        if(isset($_GET["id"])){
            $product_id = $_GET["id"];
        }

        if(isset($_POST["delete"])){
            $user->adminTorol($product_id);
            $url = "index.php";
            echo "<META HTTP-EQUIV=Refresh CONTENT='0, URL=".$url."'/>";
        }
    ?>

<div class="container">

    <h2 class="text-center">Biztosan törli a terméket?</h2>

    <div class="row justify-content-center">

        <table class="table table-stiped text-center">
            <tr>
                <th>Terméknév</th>
                <th>AmperÓra</th>
                <th>Cikkszám</th>
                <th>Termékár(bruttó)</th>
            </tr>

        <?php
            $result = $user->kosarJelenit($product_id);
            foreach($result as $kulcs => $ertek){
                ?>
                    <tr>
                        <th><?php echo $ertek[3]; ?></th>
                        <th><?php echo $ertek[4]; ?></th>
                        <th><?php echo $ertek[1]; ?></th>
                        <th><?php echo $ertek[2]; ?></th>
                    </tr>
                <?php
            }
        ?>
        </table>

    <form action="" method="post">
        <button type="submit" name="delete" class="btn btn-danger btn-lg">Töröl</button>
    </form>

</div>
</div>
</div>
</body>
</html>
