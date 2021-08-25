<?php require "header.php"; ?>

<div id="menu">
    <?php require "menu.php" ?>
</div>

<div id="main">
    <div class="egesz">
        <div class="rolunk">
        <h2>Kosár tartalma</h2>

        <table width="90%" align="center" cellspacing="8">
            <tr align='center'>
                <th>Cikkszám</th>
                <th>Terméknév</th>
                <th>AmperÓra</th>
                <th>Bruttó ár</th>
                <th>Darabszám</th>
                <th>Érték</th>
            </tr>

            <?php
            $vegosszeg = 0;
            if(isset($_SESSION["cart"])){
                foreach($_SESSION["cart"] as $product_id => $db){
                    $result = $user->kosarJelenit($product_id);
                    foreach($result as $kulcs=>$ertek){
                        ?>
                        <tr align='center'>
                            <td><?php echo $ertek[1]; ?></td>
                            <td><?php echo $ertek[3]; ?></td>
                            <td><?php echo $ertek[4]; ?></td>
                            <td><?php echo number_format($ertek[2],0,".",".");  ?> Ft </td>
                            <td><?php echo $db?></td>
                            <td><?php echo $ertek[2]*$db; ?></td>
                        </tr>
                        <?php
                        $vegosszeg += $ertek[2]*$db;
                    }
                }
            }
            ?>
            <tr>
                <td align="right" colspan="7" >
                    <strong>Végösszeg: </strong> <?php echo number_format($vegosszeg, 0, ".", ".");  ?> Ft
                </td>
            </tr>
        </table>
        </div>

        <?php
        $error1 = "";
        $error2 = "";

        if(isset($_POST["megrendel"]) && (isset($_POST["check"]) == 1)){

            $userId = $_SESSION["userId"];
            $nev = $_POST["nev"];
            $telefon = $_POST["telefon"];
            $email = $_POST["email"];
            $szmod = $_POST["szmod"];
            $fizmod = $_POST["fizmod"];
            $irsz = $_POST["irsz"];
            $varos = $_POST["varos"];
            $utca = $_POST["utca"];
            $hsz = $_POST["hsz"];
            $megj = $_POST["megj"];
            
            $return = $user->rendelAdatVizsgal($userId, $nev, $telefon, $email, $szmod, $fizmod, $irsz, $varos, $utca, $hsz, $megj);
            if(!$return){
                $error1="Rendelés leadásához minden mező kitöltése kötelező!";
            }else{
                $user->rendLeadOsszesito($userId, $szmod, $fizmod, $vegosszeg);
                $utolsoRendId=$user->rendIdLeker();
                $user->rendLeadAdatok($userId, $user->rendIdLeker(), $nev, $telefon, $email, $irsz, $varos, $utca, $hsz, $megj);
                foreach($_SESSION["cart"] as $product_id => $db){
                    $user->rendLeadTermekek($utolsoRendId, $product_id, $db);
                    $user->keszlLevon($product_id, $db);
                }
                unset($_SESSION["cart"]);
                $url = "user_adat.php";
                echo "<META HTTP-EQUIV=Refresh CONTENT='0, URL=".$url."'/>";
            }
        }else if(isset($_POST["megrendel"]) && (isset($_POST["check"]) == 0)){

            $userId = $_SESSION["userId"];
            $nev = $_POST["nev"];
            $telefon = $_POST["telefon"];
            $email = $_POST["email"];
            $szmod = $_POST["szmod"];
            $fizmod = $_POST["fizmod"];
            $irsz = $_POST["irsz"];
            $varos = $_POST["varos"];
            $utca = $_POST["utca"];
            $hsz = $_POST["hsz"];
            $megj = $_POST["megj"];
            
            $return = $user->rendelAdatVizsgal($userId, $nev, $telefon, $email, $szmod, $fizmod, $irsz, $varos, $utca, $hsz, $megj);
            if(!$return){
                $error1="Rendelés leadásához minden mező kitöltése kötelező!";
                $error2="Vásárlási feltételek elfogadása kötelező!";
            }
        }
        ?>
        
        <div class="rolunk">
            <form action="" method="post">

            <h4 class="error"> <?php if(!empty($error1)){echo $error1; } ?></h4>
            <h4 class="error"> <?php if(!empty($error2)){echo $error2; } ?></h4>

                <div class="adatok1">
                    <input type="text" name="nev" class="bevit form-control" placeholder="Teljes név">
                    <input type="text" name="telefon" class="bevit form-control" placeholder="Telefonszám">
                    <input type="text" name="email" class="bevit form-control" placeholder="E-mail cím">


                    <select name="szmod" class="bevit form-control">
                        <option value="gls">GLS futárral</option>
                        <option value="posta">Postai kiszállítással</option>
                    </select>

                    <select name="fizmod" class="bevit form-control">
                        <option value="utanvet">Utánvét</option>
                        <option value="atutalas">Átutalás</option>
                    </select>
                </div>

                <div class="adatok2">
                    <input type="text" name="irsz" class="bevit form-control" placeholder="Irányítószám">
                    <input type="text" name="varos" class="bevit form-control" placeholder="Város">
                    <input type="text" name="utca" class="bevit form-control" placeholder="Utca">
                    <input type="text" name="hsz" class="bevit form-control" placeholder="Házszám">
                    <input type="text" name="megj" class="bevit form-control" placeholder="(emelet / ajtó ...)">
                </div>

                <div class="vf">
                    <input type="checkbox" name="check">
                    <a href="tajekoztato.php">Elfogadom a vásárlási feltételeket</a>

                    <button type="submit" name="megrendel" class="vesz">Rendelés Leadása</button>
                </div>
            </form>
        </div>
    </div>  
</div>


<div id="kapcsolat">
    <?php require "kapcsolat.php" ?>
</div>

<div id="kosar">
    <?php require "kosar.php" ?>
</div>

</body>
</html>