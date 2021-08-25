<div class="kosaram">
    <div><a href="kosaram.php" class="">Kosaram</a></div>
    <?php
        $vegosszeg = 0;
        if(isset($_SESSION["cart"])){
            foreach($_SESSION["cart"] as $product_id => $db){
                $result = $user->kosarJelenit($product_id);
                foreach($result as $kulcs=>$ertek){
                    $ertek[2]*$db; 
                }
                $vegosszeg += $ertek[2]*$db;
                }
            }
    ?>
    <tr>
        <td align="right" colspan="7" >
            <strong>Végösszeg: </strong> <?php echo number_format($vegosszeg, 0, ".", ".");  ?> Ft
        </td>
    </tr>
</div>