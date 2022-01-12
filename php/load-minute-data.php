<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    include 'db-conn.php';
    global $conn;
    date_default_timezone_set('Europe/Bucharest');
    $date = date('Y-m-d H:i:s', time());
    $dateMinusMinute = date('Y-m-d H:i:s', time() - 60);
    if($_SESSION['role']=='admin')
        $sql = "SELECT * FROM srv_data_t WHERE time_stamp BETWEEN '$dateMinusMinute' AND '$date' ORDER BY id DESC";
    else{
        $email=$_SESSION['email'];
        $sql="SELECT * FROM srv_data_t WHERE user='$email' AND (time_stamp BETWEEN '$dateMinusMinute' AND '$date') ORDER BY id DESC";
        $result = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<canvas id='Chart' style='width:100%;max-width:100%'></canvas>";
            echo "<br>";
            echo "<script type='text/javascript'>";
            echo "var xValues = [];";
            echo "var cpuTemp = [];";
            echo "var cpuLoad = [];";
            echo "var ramLoad = [];";
            echo "var storageLoad = [];";
            while ($row = mysqli_fetch_assoc($result)) {
                $time=json_encode(substr($row['time_stamp'],-8));
                $cpuTemp=json_encode($row['cpu_temp']);
                $cpuLoad=json_encode($row['cpu_load']);
                $ramLoad=json_encode($row['ram_load']);
                $storageLoad=json_encode($row['storage_load']);
                echo "xValues.push(".$time.");";
                echo "cpuTemp.push(".$cpuTemp.");";
                echo "cpuLoad.push(".$cpuLoad.");";
                echo "ramLoad.push(".$ramLoad.");";
                echo "storageLoad.push(".$storageLoad.");";
            }
            echo "xValues=xValues.reverse();";
            echo "cpuTemp=cpuTemp.reverse();";
            echo "cpuLoad=cpuLoad.reverse();";
            echo "ramLoad=ramLoad.reverse();";
            echo "storageLoad=storageLoad.reverse();";
            echo "new Chart('Chart', {";
            echo "type: 'line',";
            echo "data: {";
            echo "labels: xValues,";
            echo "datasets: [{";
            echo "label:'CPU temp (°C)',";
            echo "data: cpuTemp,";
            echo "borderColor: 'red',";
            echo "fill: false";
            echo "}, {";
            echo "label:'CPU load',";
            echo "data: cpuLoad,";
            echo "borderColor: 'green',";
            echo "fill: false";
            echo "}, {";
            echo "label:'RAM load',";
            echo "data: ramLoad,";
            echo "borderColor: 'blue',";
            echo "fill: false";
            echo "},{";
            echo "label:'Storage load',";
            echo "data: storageLoad,";
            echo "borderColor: 'yellow',";
            echo "fill: false";
            echo "}]";
            echo "},";
            echo "options: {";
            echo "legend: {display: true}";
            echo "}";
            echo "});";
            echo "</script>";
            echo "<br>";
        }else{
            echo "No graph can be created";
        }
    }
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table table-striped table-sm' id='table-history'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope='col'>" . "Time" . "</th>";
        echo "<th scope='col'>" . "CPU temperature" . "</th>";
        echo "<th scope='col'>" . "CPU load" . "</th>";
        echo "<th scope='col'>" . "RAM load" . "</th>";
        echo "<th scope='col'>" . "Storage load" . "</th>";
        if ($_SESSION['role'] == 'admin')
            echo "<th scope='col'>" . "User" . "</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['time_stamp'] . "</td>";
            echo "<td>" . $row['cpu_temp'] . "°C" . "</td>";
            echo "<td>" . $row['cpu_load'] . "%" . "</td>";
            echo "<td>" . $row['ram_load'] . "%" . "</td>";
            echo "<td>" . $row['storage_load'] . "%" . "</td>";
            if ($_SESSION['role'] == 'admin')
                echo "<td>" . $row['user'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "<tfoot>";
        echo "<tr>";
        echo "<th scope='col'>" . "Time" . "</th>";
        echo "<th scope='col'>" . "CPU temperature" . "</th>";
        echo "<th scope='col'>" . "CPU load" . "</th>";
        echo "<th scope='col'>" . "RAM load" . "</th>";
        echo "<th scope='col'>" . "Storage load" . "</th>";
        if ($_SESSION['role'] == 'admin')
            echo "<th scope='col'>" . "User" . "</th>";
        echo "</tr>";
        echo "</tfoot>";
        echo "</table>";
        echo "<script>";
        echo "$(document).ready( function () {";
            echo "$('#table-history').DataTable();";
        echo "} );";
        echo "</script>";
    }else{
        echo "<br>No data has been found";
    }
?>
