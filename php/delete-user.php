<?php
    include 'db-conn.php';
    global $conn;
    $id=$_POST['id'];
    $sql="DELETE FROM login WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {}
?>