<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    include 'db-conn.php';
    global $conn;
    $coord = array(array(), array());
    $i=0;
    if($_SESSION['role']=="user"){
        $email=$_SESSION['email'];
        $sql="SELECT * FROM srv_data_t WHERE id = (SELECT MAX(id) FROM srv_data_t WHERE user='$email') LIMIT 1";
        $result = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $coord[0][0] = $row["coord_lat"];
                $coord[1][0] = $row["coord_long"];
            }
            $markers=json_encode($coord);
        }else{
            echo ("No data has been found");
        }
    }
    else if($_SESSION['role']=="admin") {
        $sql1 = "SELECT * FROM login";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result1) > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
                //array de 2 array-uri
                $email = $row['email'];
                $sql2 = "SELECT * FROM srv_data_t WHERE id = (SELECT MAX(id) FROM srv_data_t WHERE user='$email') LIMIT 1";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $coord[0][$i] = $row["coord_lat"];
                        $coord[1][$i] = $row["coord_long"];
                    }
                }
                $i++;
            }
            $markers=json_encode($coord);
        }else{
            echo("No data has been found");
        }
    }
?>
