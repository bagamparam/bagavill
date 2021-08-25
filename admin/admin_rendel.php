<div class="admin">
<?php require "../header.php"; ?>

<div id="adminmenu">
    <?php require "adminmenu.php" ?>
</div>

<?php
    $id = "0";
    if(isset($_POST["elkuldve"]) && (isset($_POST["check"]) == 1)){
        $result = $user->rendAdmin();
        foreach($result as $kulcs => $ertek){
            $id = $ertek[0];
        }
        $user->statuszFrissit($id);
        $url = "admin_rendel.php";
        echo "<META HTTP-EQUIV=Refresh CONTENT='0, URL=".$url."'/>";
    }
        ?>

<div id="adminmain">
  <div class="container">
      <h2 class="text-center mb-3 p-5">Rendelések megjelenítése</h2>
      <div class="row justify-content-center">
        <table class="table table-striped text-center betu">
            <tr>
                <th>Rendelés ID</th>
                <th>Vevő neve</th>
                <th>Telefonszáma</th>
                <th>Email címe</th>
                <th>IRSZ</th>
                <th>Város</th>
                <th>Utca</th>
                <th>Házszám</th>
                <th>Megj</th>
                <th>Szállítsái mód</th>
                <th>Fizetési mód</th>
                <th>Dátum</th>
                <th>Végösszeg</th>
                <th>Státusz</th>
                <th>Műv.</th>
            </tr>

        <?php
        $result = $user->rendAdmin();
        foreach($result as $kulcs => $ertek){
            $user->statuszFrissit($ertek[0]);  
            ?>
            <tr align='center'>
                <td><?php echo $ertek[0]; ?></td>
                <td><?php echo $ertek[1]; ?></td>
                <td><?php echo $ertek[2]; ?></td>
                <td><?php echo $ertek[3]; ?></td>
                <td><?php echo $ertek[4]; ?></td>
                <td><?php echo $ertek[5]; ?></td>
                <td><?php echo $ertek[6]; ?></td>
                <td><?php echo $ertek[7]; ?></td>
                <td><?php echo $ertek[8]; ?></td>
                <td><?php echo $ertek[9]; ?></td>
                <td><?php echo $ertek[10]; ?></td>
                <td><?php echo $ertek[11]; ?></td>
                <td><?php echo number_format($ertek[12],0,".",".");  ?> Ft </td>
                <td><?php echo $ertek[13]; ?></td>
                <td><input type="checkbox" name="check"></td>
            </tr>
            <?php
        }
        ?>
        </table>

            <div class="frissit">
                <button tpye="submit" name="elkuldve" class="btn btn-primary">Csomag(ok) elküldve</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>