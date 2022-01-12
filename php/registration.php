<?php
    echo "<form action='' method='' name='registerUser' id='registerUser'>";
    echo "<div class='form-group'>";
    echo "<h4>Register new user</h4>";
    echo "<br>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label for='email'>New user's email:</label>";
    echo "<input type='email' class='form-control' id='email' name='email' placeholder='Enter user email' required>";
    echo "</div>";
    echo "<br>";
    echo "<div class='form-group'>";
    echo "<label for='name'>New user's name:</label>";
    echo "<input type='text' class='form-control' id='name' name='name' placeholder='Enter user name'>";
    echo "</div>";
    $pass=require 'pass-generator.php';
    echo "<br>";
    echo "<div class='form-group'>";
    echo "<label for='pass'>Generated password(please write it down!)</label>";
    echo "<input type='text' class='form-control' id='pass' name='pass' value=".$pass." readonly>";
    echo "</div>";
    echo "<br>";
    echo "<button type='submit' class='btn btn-dark-blue' id='submitChange' onclick='new_user()'>Register</button>&nbsp&nbsp";
    echo "<button type='button' class='btn' onclick='close_options()'><i class='fa fa-times-circle'></i></button>";
    echo "</form>";
    echo "<p id='modMsj'></p>";
    echo "<br>";
?>