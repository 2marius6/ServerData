<?php
    include 'db-conn.php';
    global $conn;
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $name=$_POST['name'];
    $sql="INSERT INTO login (email, pass, name, role) VALUES ('$email', MD5('$pass'), '$name', 'user')";
    if (mysqli_query($conn, $sql)) {
        echo "<br><div class='alert alert-success' role='alert'>";
            echo "User registered succesfully";
        echo "</div>";
    }
    else{
        echo "<br><div class='alert alert-danger' role='alert'>";
            echo "There was an error registering the new user, please try again";
        echo "</div>";
    }
?>
