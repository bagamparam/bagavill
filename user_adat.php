<?php require "header.php"; ?>

<div id="menu">
    <?php require "menu.php" ?>
</div>

<div id="main">
    <div class="egesz cart">
        <div class="rolunk">
        <h2> <?=$user->username?> rendeléseinek megtekintése: </h2>
        <table width="95%" align="center" cellpadding="7">

        <tr align='center'>
            <th>Terméknév</th>
            <th>AmperÓra</th>
            <th>Termékár</th>
            <th>Darabszám</th>
            <th>Érték</th>
            <th>Dátum</th>
            <th>Státusz</th>
        </tr>

        <?php 
            $userId = $_SESSION['userId'];
            $result = $user->userRendelesei($userId);
            foreach($result as $kulcs =>$ertek){
                ?>
                <tr align='center'>
                    <td><?php echo $ertek[4]; ?></td>
                    <td><?php echo $ertek[5]; ?></td>
                    <td><?php echo number_format($ertek[6],0,".",".");  ?> Ft </td>
                    <td><?php echo $ertek[0]; ?></td>
                    <td><?php echo number_format($ertek[2],0,".",".");  ?> Ft </td>
                    <td><?php echo $ertek[1]; ?></td>
                    <td><?php echo $ertek[3]; ?></td>              
                </tr>
                <?php
            }
            ?>

        </table>
        </div>
    </div>    
</div>

<div class="jobb">
    <div id="kapcsolat">
        <?php require "kapcsolat.php" ?>
    </div>

    <div id="kosar">
        <?php require "kosar.php" ?>
    </div>
</div>
 
</body>
</html>