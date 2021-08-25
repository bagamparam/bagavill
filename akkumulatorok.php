<?php require "header.php"; ?>

<div id="menu">
    <?php require "menu.php" ?>
</div>

<div id="main">
    <div class="egesz">

    <?php 
    if(isset($_POST["search"])){
        $keres = $_POST["termek"];

        if(!empty($user->nevKereso($keres))){
            $result = $user->nevKereso($keres);
            foreach($result as $kulcs =>$ertek){
                if($ertek[9])
                    ?>
                    <div class="akksik">
                        <div> <img src="img/<?php echo $ertek[6]; ?>" alt="" title=""> </div>
                        <div class="akar"> Ár: <?php echo number_format($ertek[3],0,".",".");  ?> Ft </div>
                        <a href="kosarmuvelet.php?id=<?php echo $ertek[0] ?>&action=add" class="vesz">Kosárba</a>
                        <div class="aknev"> Név: <?php echo $ertek[4];  ?> </div>
                        <div class="akcikk"><h4 > <?php if(!empty($error1)){echo $error1; } ?></h4></div>
                        <div class="akcikk"> Cikkszám: <?php echo $ertek[2];  ?> </div>
                        <div class="akkesz"> Keszlet: <?php echo $ertek[7];  ?> db</div>
                        <div> Amperóra: <strong class="akamper"><?php echo $ertek[8];  ?></strong>Ah </div>
                        <div class="akparam"> Paraméterek: <?php echo $ertek[5];  ?> </div>
                    </div>
                <?php
            }
        }else if(!empty($user->amperKereso($keres))){
            $result = $user->amperKereso($keres);
            foreach($result as $kulcs =>$ertek){
                if($ertek[9])
                    ?>
                    <div class="akksik">
                        <div> <img src="img/<?php echo $ertek[6]; ?>" alt="" title=""> </div>
                        <div class="akar"> Ár: <?php echo number_format($ertek[3],0,".",".");  ?> Ft </div>
                        <a href="kosarmuvelet.php?id=<?php echo $ertek[0] ?>&action=add" class="vesz">Kosárba</a>
                        <div class="aknev"> Név: <?php echo $ertek[4];  ?> </div>
                        <div class="akcikk"><h4 > <?php if(!empty($error1)){echo $error1; } ?></h4></div>
                        <div class="akcikk"> Cikkszám: <?php echo $ertek[2];  ?> </div>
                        <div class="akkesz"> Keszlet: <?php echo $ertek[7];  ?> db</div>
                        <div> Amperóra: <strong class="akamper"><?php echo $ertek[8];  ?></strong>Ah </div>
                        <div class="akparam"> Paraméterek: <?php echo $ertek[5];  ?> </div>
                    </div>
                <?php
            }
        }else if(!empty($user->paramKereso($keres))){
            $result = $user->paramKereso($keres);
            foreach($result as $kulcs =>$ertek){
                if($ertek[9])
                    ?>
                    <div class="akksik">
                        <div> <img src="img/<?php echo $ertek[6]; ?>" alt="" title=""> </div>
                        <div class="akar"> Ár: <?php echo number_format($ertek[3],0,".",".");  ?> Ft </div>
                        <a href="kosarmuvelet.php?id=<?php echo $ertek[0] ?>&action=add" class="vesz">Kosárba</a>
                        <div class="aknev"> Név: <?php echo $ertek[4];  ?> </div>
                        <div class="akcikk"><h4 > <?php if(!empty($error1)){echo $error1; } ?></h4></div>
                        <div class="akcikk"> Cikkszám: <?php echo $ertek[2];  ?> </div>
                        <div class="akkesz"> Keszlet: <?php echo $ertek[7];  ?> db</div>
                        <div> Amperóra: <strong class="akamper"><?php echo $ertek[8];  ?></strong>Ah </div>
                        <div class="akparam"> Paraméterek: <?php echo $ertek[5];  ?> </div>
                    </div>
                <?php
            }
        }else{
            ?>
            <div class="rolunk">
            <p>Nincs a keresésnek megfelelő akkumulátor :( ... </p>
            </div>
            <?php
        }
    }
?>
        <div class="rolunk keress">
        <form action="" method="post">
            <input type="text" name="termek" placeholder="Írja be a termék nevét,paraméterét, vagy amperóráját." class="keres">
            <button type="submit" name="search" class="vesz">Keresés</button>
        </form>
        </div>

        <?php 
        $result = $user->shAkksi();
        foreach($result as $kulcs =>$ertek){
            if($ertek[9])
                ?>
                <div class="akksik">
                    <div> <img src="img/<?php echo $ertek[6]; ?>" alt="" title=""> </div>
                    <div class="akar"> Ár: <?php echo number_format($ertek[3],0,".",".");  ?> Ft </div>
                    <a href="kosarmuvelet.php?id=<?php echo $ertek[0] ?>&action=add" class="vesz">Kosárba</a>
                    <div class="aknev"> Név: <?php echo $ertek[4];  ?> </div>
                    <div class="akcikk"><h4 > <?php if(!empty($error1)){echo $error1; } ?></h4></div>
                    <div class="akcikk"> Cikkszám: <?php echo $ertek[2];  ?> </div>
                    <div class="akkesz"> Keszlet: <?php echo $ertek[7];  ?> db</div>
                    <div> Amperóra: <strong class="akamper"><?php echo $ertek[8];  ?></strong>Ah </div>
                    <div class="akparam"> Paraméterek: <?php echo $ertek[5];  ?> </div>
                </div>
            <?php
        }
        ?>

        <div class="rolunk">
            Mindhárom márka akkumulátoraira <strong class="kiemel">2 ÉV garanciát</strong> vállalunk. Ez a 3 márka teljesen lefedi az összes autós igényét. Szervízünkben kimérjük az akkumulátorának állapotát, és <strong class="kiemel">INGYENesen</strong> beszereljük Önnek az újat, amennyiben a régit nálunk hagyja. Használt, de jól működő akkumulátorokat is árulunk, amire <strong class="kiemel">1 HÓNAP garanciát</strong> vállalunk.
        </div>

        <div class="akksileir1">
            <p>Ha a gépjárműve a sok járulékos fogyasztó miatt hosszú ideig nagy energiát igényel, ez a legjobb választás. Ezekben a <strong class="kiemel">BANNER</strong> akkumulátorokban a legújabb AGM technológia van.</p>
        </div>

        <div class="akksileir2">
            <p>Akár családi start-stop funkcióval rendelkező autóval, vagy magas energiaigényű, jól felszerelt járművel rendelkezik, a <strong class="kiemel">VARTA</strong> akkumulátorokkal mindig célba ér.</p>
        </div>

        <div class="akksileir3">
            <p>Tudta hogy az Apollo űrhajókhoz is az <strong class="kiemel">EXIDE</strong> szállította a speciális akkumulátort? Miért ne hajthatná akár ez a márka az Ön autóját is a világon bárhová?</p>
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