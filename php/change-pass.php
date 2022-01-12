<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    include 'db-conn.php';
    global $conn;
    $passOld=$_POST['currPass'];
    $pass=$_POST['newPass'];
    $passConf=$_POST['newPassConf'];
    $id=$_SESSION['id'];
    if(md5($passOld)!==$_SESSION['pass']){
        echo "<br><div class='alert alert-danger' role='alert'>";
            echo "The old password is incorrect, please try again";
        echo "</div>";
    }
    else if($pass!==$passConf){
        echo "<br><div class='alert alert-danger' role='alert'>";
            echo "The new password and the confirmation are not the same, please try again";
        echo "</div>";
    }
    else{
        $sql="UPDATE login SET pass = MD5('$pass') WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo "<br><div class='alert alert-success' role='alert'>";
            echo "Password changed succesfully";
            echo "</div>";
        }
        else{
            echo "<br><div class='alert alert-danger' role='alert'>";
            echo "There was an error changing password, please try again";
            echo "</div>";
        }
    }

?>
