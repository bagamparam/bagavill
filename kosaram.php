<?php require "header.php"; ?>

<div id="menu">
    <?php require "menu.php" ?>
</div>

<div id="main">
    <div class="egesz cart">
        <div class="rolunk">
            <h2>Kosár tartalma</h2>
            <h4 class="error"> <?php if(!empty($kh)){echo $khS; } ?></h4>

            <table width="90%" align="center" cellspacing="8">
                <tr align='center'>
                    <th>Cikkszám</th>
                    <th>Terméknév</th>
                    <th>AmperÓra</th>
                    <th>Bruttó ár</th>
                    <th>Darabszám</th>
                    <th>Érték</th>
                    <th> <a href="kosarmuvelet.php?action=empty"> <i class="far fa-trash-alt"></i> </a> </th>
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
                                    <td>
                                        <a href='kosarmuvelet.php?id=<?php echo $ertek[0] ?>&action=add'><i class='far fa-plus-square'></i></a>
                                        <a href='kosarmuvelet.php?id=<?php echo $ertek[0] ?>&action=remove'><i class='far fa-minus-square'></i></a>
                                    </td>
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

            <?php
            if($user->loginCheck() && empty($_SESSION["cart"])){
                ?>
                <a class="orderbtn" href="akkumulatorok.php">Rendelés leadásához rakjon a kosarába terméket!</a>
                <?php
            }
            else if($user->loginCheck() && !empty($_SESSION["cart"])){
                ?>
                <a class="orderbtn" href="megrendeles.php">Megrendelem</a>
                <?php
            }
            else{
                ?>  
                <a class="orderbtn" href="login_kosar.php">Rendelés leadásához kérjük jelentkezzen be!</a>
                <?php
            }
            ?>
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