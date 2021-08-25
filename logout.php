<?php

    require "class/user.php";
    $user = new User();
    $user->logout();
    header('Location: index.php');

?>