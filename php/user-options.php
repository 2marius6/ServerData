<?php
    include 'db-conn.php';
    global $conn;
    $id=$_POST['id'];
    $sql="SELECT name FROM login WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name=$row['name'];
        }
    }
        echo "<form action='' method='' name='infoChange' id='infoChange'>";
            echo "<div class='form-group'>";
                echo "<h4>Change info for ".$name."</h4>";
                echo "<br>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<input type='email' class='form-control' id='oldEmail' name='emailOld' aria-describedby='emailHelp' placeholder='Enter current email (mandatory for any change)' required>";
            echo "</div>";
            echo "<br>";
            echo "<div class='form-group'>";
                echo "<input type='email' class='form-control' id='newEmail' name='email' aria-describedby='emailHelp' placeholder='Change email'>";
            echo "</div>";
            echo "<br>";
            echo "<div class='form-group'>";
                echo "<input type='text' class='form-control' id='newName' name='name' placeholder='Change name'>";
            echo "</div>";
            echo "<br>";
            echo "<button type='submit' class='btn btn-dark-blue' id='submitChange' onclick='user_modify()'>Save changes</button>&nbsp&nbsp";
    echo "<button type='button' class='btn btn-danger' onclick='delete_user(".$id.")'>Delete account</button>     ";
    echo "<button type='button' class='btn' onclick='close_options()'><i class='fa fa-times-circle'></i></button>";
        echo "</form>";
    echo "<p id='modMsj'></p>";
    echo "<br>";
?>
