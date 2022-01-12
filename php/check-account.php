<?php
    include 'db-conn.php';
    global $conn;
    session_start();
    $password = md5($_POST['pass']);
    $email = $_POST['email'];
    $sql="SELECT * FROM login WHERE email='$email' AND pass='$password'";
    if($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION["name"] = $row["name"];
                $_SESSION["role"] = $row["role"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["id"] = $row["id"];
                $_SESSION["pass"] = $row["pass"];
            }
            mysqli_free_result($result);
            echo "<br><div class='alert alert-success' role='alert'>";
                echo "Welcome ".$_SESSION["name"].", you will soon be redirected";
            echo "</div>";
        }
        else{
            echo "<br><div class='alert alert-danger' role='alert'>";
                echo "Username/password incorrect, please try again in 3 seconds";
            echo "</div>";
        }
    }
?>
