<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    if(!empty($_SESSION["name"])) {
        require_once 'main.php';
    } else {
        require_once 'login.php';
    }
?>