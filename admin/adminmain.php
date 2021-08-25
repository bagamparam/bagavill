<div class="container">
    <div class="row justify-content-center">

        <h2 class="text-center p-5">Termékek</h2>

        <table class="table table-striped mt-3 text-center">
            <tr>
                <th>Terméknév</th>
                <th>AmperÓra</th>
                <th>Cikkszám</th>
                <th>Készlet</th>
                <th>Termékár(bruttó)</th>
                <th>Műveletek</th>
            </tr>

            <?php
                $result = $user->shTermekekAdmin();
                foreach($result as $kulcs => $ertek){
                    if($ertek[6]){
                    ?>
                        <tr>
                            <th><?php echo $ertek[3]; ?></th>
                            <th><?php echo $ertek[5]; ?></th>
                            <th><?php echo $ertek[1]; ?></th>
                            <th><?php echo $ertek[4]; ?></th>
                            <th><?php echo $ertek[2]; ?></th>
                            <th>
                                <a href="admin_modosit.php?id=<?php echo $ertek[0]; ?>">Módosítás</a>
                                <a href="admin_torol.php?id=<?php echo $ertek[0]; ?>">Törlés</a>
                            </th>
                        </tr>
                    <?php
                    }
                }
            ?>
            
        </table>
    </div>
</div>

