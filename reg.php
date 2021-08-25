<?php
    require "header.php";   
    require "class/user.php";
    
    $user = new User();
    $msg = "";

    if(isset($_POST['reg'])) {
        $msg = $user->registrateandCheck($_POST['name'], $_POST['username'], $_POST['email'], $_POST['pwd1'], $_POST['pwd2']);
    }
?>

<body >
    <div class="container">
        <div class="row">
            <div class="col-10 col-sm-9 col-md-8 col-lg-7 col-xl-6 mx-auto rounded shadow bg-light p-3 text-center logg">
                <h3 class="mt-0 mb-3">Regisztráció</h3>
                <?=$msg?>
                <form action="" method="post" class="form-group col-11 col-sm-9 col-md-8 col-lg-7 mx-auto">
                    <label>Teljes név:</label>
                    <input class="form-control mb-3" type="text" name="name" required>
                    <label>Felhasználónév:</label>
                    <input class="form-control mb-3" type="text" name="username" required>
                    <label>E-mail cím:</label>
                    <input class="form-control mb-3" type="email" name="email" required>
                    <label>Jelszó:</label>
                    <input class="form-control mb-3" type="password" name="pwd1" required>
                    <label>Jelszó megerősítése:</label>
                    <input class="form-control mb-3" type="password" name="pwd2" required>
                    <button type="reset" class="btn btn-secondary">Mégse</button>
                    <button type="submit" class="btn btn-dark" name="reg">Regisztráció</button>
                </form>
                <a href="login.php" class="text-light">Már regisztráltam</a>
            </div>
        </div>
    </div>
</body>
</html>