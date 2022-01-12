<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    if(session_destroy()) {
        header("Location: http://localhost/IP/index.php");
        exit;
    }
?>
