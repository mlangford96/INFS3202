<?php
    session_start();
    require "common.php";
    create_user($_POST['username'], $_POST['password'], $_POST['repassword'], $_POST['email']);
?>
