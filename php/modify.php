<?php
    include 'db-conn.php';
    global $conn;
    $emailOld=$_POST['currEmail'];
    $email=$_POST['email'];
    $name=$_POST['name'];
    if(strlen($email)>0&&strlen($name)>0) {
        $sql="UPDATE login SET email = '$email', name='$name' WHERE email='$emailOld'";
        if (mysqli_query($conn, $sql)) {
            echo "<br><div class='alert alert-success' role='alert'>";
                echo "Email and name changed succesfully";
            echo "</div>";
        }
    }
    else if(strlen($email)>0&&strlen($name)==0){
        $sql="UPDATE login SET email = '$email' WHERE email='$emailOld'";
        if (mysqli_query($conn, $sql)) {
            echo "<br><div class='alert alert-success' role='alert'>";
                echo "Email changed succesfully";
            echo "</div>";
        }
    }
    else if(strlen($email)==0&&strlen($name)>0){
        $sql="UPDATE login SET name = '$name' WHERE email='$emailOld'";
        if (mysqli_query($conn, $sql)) {
            echo "<br><div class='alert alert-success' role='alert'>";
                echo "Name changed succesfully";
            echo "</div>";
        }
    }
    else{
        echo "<br><div class='alert alert-danger' role='alert'>";
            echo "There was an error changing name/email, please try again";
        echo "</div>";
    }
?>