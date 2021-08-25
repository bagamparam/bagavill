<div class="admin">

<div id="adminmenu">
    <?php require "adminmenu.php" ?>
</div>

<?php

    $error = "";

    if(isset($_POST["feltolt"])){

        $result = $user->katAtalakit($_POST["kategoriaSelect"]);
        $kategoriaSelect = $result;
        $cikkszam = $_POST["cikkszam"];
        $termekar = $_POST["termekar"];
        $termeknev = $_POST["termeknev"];
        $parameter =$_POST["parameter"];
        $kep = $_FILES["kep"]["name"];
        $keszlet = $_POST["keszlet"];
        $ah = $_POST["ah"];

        try{
            $user->insAkku($kategoriaSelect,$cikkszam,$termekar,$termeknev,$parameter,$kep,$keszlet,$ah);
        }catch(Exception $e){
            $error = $e->getMessage();
        }
    }
?>

<div id="adminmain">
    <div class="container">
        <div class="row justify-content-center">
            <form enctype="multipart/form-data" action="" method="post" class="form-group text-center p-5 rounded">

                <p class="text-danger mb-3"> <?php  if(!empty($error)){ echo $error;}  ?> </p>

                <h1 class="mb-3">Termék feltöltése</h1>

                <label for="">Kategória</label>
                <select name="kategoriaSelect" class="form-control mb-3">
                <?php
                    //$res = $user->kategoriaSelectId();
                    $result = $user->kategoriaSelect();
                    foreach($result as $res =>$ertek)
                        echo "<option value='$ertek[0]'>$ertek[0]</option>";
                    
                ?>
                </select>

                <label for="">Cikkszám</label>
                <input type="text" name="cikkszam" class="form-control mb-3">

                <label for="">Termékár</label>
                <input type="text" name="termekar" class="form-control mb-3">

                <label for="">Termék név</label>
                <input type="text" name="termeknev" class="form-control mb-3">

                <label for="">Termék paraméterei</label>
                <textarea name="parameter" class="form-control mb-3" cols="50" rows="10"></textarea>

                <label for="">Termékkép</label>
                <input type="file" name="kep" class="form-control mb-3">
                
                <label for="">Készlet</label>
                <input type="text" name="keszlet" class="form-control mb-3">
                
                <label for="">Amperóra</label>
                <input type="text" name="ah" class="form-control mb-3">

                <button tpye="submit" name="feltolt" class="btn btn-primary">Termék feltöltése</button>

            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>