<?php
    require "header.php";
    require "class/user.php";

    $user = new User();
    $msg = "";

    if(isset($_POST['megse']))
        header('Location: index.php');

    if(isset($_POST['login'])) {
        try {
            $user->login($_POST['username'], $_POST['password']);
            header('Location: index.php');
        }catch (Exception $e) {
            $msg = $e->getMessage();
        }
    }
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-10 col-sm-9 col-md-8 col-lg-7 col-xl-6 mx-auto rounded shadow bg-light p-3 text-center logg">
                <h3 class="mt-0 mb-3">Bejelentkezés</h3>
                <?=$msg?>
                <form action="" method="post" class="form-group col-11 col-sm-9 col-md-8 col-lg-7 mx-auto">
                    <label>Felhasználónév:</label>
                    <input class="form-control mb-3" type="text" name="username" required>
                    <label>Jelszó:</label>
                    <input class="form-control mb-3" type="password" name="password" required>
                    <button type="reset" class="btn btn-secondary" name="megse">Mégse</button>
                    <button type="submit" class="btn btn-dark" name="login">Bejelentkezés</button>
                </form>
                <a href="reg.php" class="text-light">Még nem regisztráltam</a>
            </div>
        </div>
    </div>
</body>
</html>