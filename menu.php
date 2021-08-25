<?php
    require "header.php";
    require "class/user.php";
    $user = new User();

    if($user->loginCheck()) {
?>

    <nav>
    <form action="" method="post">
        <a href="index.php">Kezdőoldal</a>
        <a href="szolgaltatasok.php">Szolgáltatások</a>
        <a href="akkumulatorok.php">Akkumulátorok</a>
        <a href="aszf.php">ÁSZF & AT</a>
        <div class="bej">
            <a href="user_adat.php" > <?=$user->username?></a>
            <a href="logout.php">Kijelentkezés</a>
        </div>
    </form>
    </nav>
        
<?php
    }else{
?>

    <nav>
    <form action="" method="post">
        <a href="index.php">Kezdőoldal</a>
        <a href="szolgaltatasok.php">Szolgáltatások</a>
        <a href="akkumulatorok.php">Akkumulátorok</a>
        <a href="aszf.php">ÁSZF & AT</a>
        <div class="bej">
            <a href="login.php">Bejelentkezés</a>
            <a href="reg.php">Regisztráció</a>
        </div>
    </form>   
    </nav>
<?php
    }
?>