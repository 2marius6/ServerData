<?php
    include 'db-conn.php';
    global $conn;
    echo "<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>";
    echo "<h2><a id='admin'>Admin area</a></h2>";
    echo "</div>";
    $sql="SELECT * FROM login WHERE role='user'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<button type='button' class='btn btn-dark-blue' onclick='user_options(".$row['id'].")'>" .
                "Options for ".$row['email']." (".$row['name'].
                ")</button>";
            echo "<br><br>";
        }
    }
    else{
        echo "<br>No users found";
    }
    echo "<button type='button' class='btn btn-success' onclick='register()'>";
    echo "Register a new user";
    echo "</button>";
    echo "<br><br>";
    echo "<div id='userOptions'></div>";
    echo"<div id='messageBox'></div>";
?>
