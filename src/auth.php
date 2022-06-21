<?php
    session_start();
    if(!isset($_SESSION["username"])) {
        echo "<script>alert('Login atau Register dulu ya untuk create, update, dan delete!');window.location='login.php';</script>";
        exit();
    }
?>