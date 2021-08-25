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

    if(isset($_POST["upload"])){
        $cikkszam = $_POST["cikkszam"];
        $ar = $_POST["termekar"];
        $nev = $_POST["termeknev"];
        $parameterek =$_POST["parameterek"];
        $kep = $_FILES["kep"]["name"];
        $keszlet = $_POST["keszlet"];
        $amper_ora = $_POST["ah"];


    $user->adModosit($cikkszam,$ar,$nev,$parameterek,$kep,$keszlet,$amper_ora,$product_id);
  }
?>

<div class="container ">

    <h2 class="text-center mb-3">Termék módosítása</h2>

    <div class="row justify-content-center">

        <form enctype="multipart/form-data" method="post" class="form-group text-center p-5 rounded" >
    
            <?php

                if(isset($_GET["id"])){

                    $product_id = $_GET["id"];
                }

                $result = $user->termKetto($product_id);
                foreach($result as $kulcs => $ertek){                    
                    ?>

                        <label for="">Cikkszám</label>
                        <input type="text" name="cikkszam" class="form-control mb-3" value="<?php echo $ertek[2] ?>">

                        <label for="">Termékár</label>
                        <input type="text" name="termekar" class="form-control mb-3" value="<?php echo $ertek[3] ?>">

                        <label for="">Termék név</label>
                        <input type="text" name="termeknev" class="form-control mb-3" value="<?php echo $ertek[4] ?>">

                        <label for="">Termék paraméterei</label>
                        <textarea name="parameterek" class="form-control mb-3" cols="50" rows="10" ><?php echo $ertek[5] ?></textarea>

                        <label for="">Termékkép</label>
                        <input type="file" name="kep" class="form-control mb-3">

                        <label for="">Készlet</label>
                        <input type="text" name="keszlet" class="form-control mb-3" value="<?php echo $ertek[7] ?>">

                        <label for="">Amperóra</label>
                        <input type="text" name="ah" class="form-control mb-3" value="<?php echo $ertek[8] ?>">

                        <button tpye="submit" name="upload" class="btn btn-primary">Termék módosítása</button>

                    <?php
                }
            ?>
        </form>
    </div>
</div> 
</div>
</div>
</body>
</html>