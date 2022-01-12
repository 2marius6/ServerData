<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    date_default_timezone_set('Europe/Bucharest');
    include 'db-conn.php';
    global $conn;
    $date = date('Y-m-d H:i:s', time());
    $dateMinusHour = date('Y-m-d H:i:s', time() - 3600);
    $i=0;
    if($_SESSION['role']==='admin') {
        $sql1 = "SELECT * from login WHERE role='user'";
        $result1 = mysqli_query($conn,$sql1);
        if (mysqli_num_rows($result1) > 0) {
            echo "<table class='table table-striped table-sm' id='table-history'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col'>" . "User" . "</th>";
            echo "<th scope='col'>" . "CPU temperature" . "</th>";
            echo "<th scope='col'>" . "CPU load" . "</th>";
            echo "<th scope='col'>" . "RAM load" . "</th>";
            echo "<th scope='col'>" . "Storage load" . "</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result1)) {
                $email = $row['email'];
                $sql = "SELECT AVG(cpu_temp), AVG(cpu_load), AVG(ram_load), AVG(storage_load), user FROM srv_data_t WHERE user='$email' AND (time_stamp BETWEEN '$dateMinusHour' AND '$date')";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>" . $row['user'] . "</td>";
                        echo "<td>" . round($row['AVG(cpu_temp)'],2) . "</td>";
                        echo "<td>" . round($row['AVG(cpu_load)'],2) . "</td>";
                        echo "<td>" . round($row['AVG(ram_load)'],2) . "</td>";
                        echo "<td>" . round($row['AVG(storage_load)'],2) . "</td>";
                        echo "</tr>";
                    }
                }
            }
            echo "</tbody>";
            echo "<tfoot>";
            echo "<tr>";
            echo "<th scope='col'>" . "User" . "</th>";
            echo "<th scope='col'>" . "CPU temperature" . "</th>";
            echo "<th scope='col'>" . "CPU load" . "</th>";
            echo "<th scope='col'>" . "RAM load" . "</th>";
            echo "<th scope='col'>" . "Storage load" . "</th>";
            echo "</tr>";
            echo "</tfoot>";
            echo "</table>";
            echo "<script>";
            echo "$(document).ready( function () {";
            echo "$('#table-history').DataTable();";
            echo "} );";
            echo "</script>";
        }
    }
    else{
        $email=$_SESSION['email'];
        echo "<canvas id='Chart' style='width:100%;max-width:100%'></canvas>";
        echo "<br>";
        echo "<table class='table table-striped table-sm' id='table-history'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope='col'>" . "Time" . "</th>";
        echo "<th scope='col'>" . "CPU temperature" . "</th>";
        echo "<th scope='col'>" . "CPU load" . "</th>";
        echo "<th scope='col'>" . "RAM load" . "</th>";
        echo "<th scope='col'>" . "Storage load" . "</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        $dateMinusMinute=date('Y-m-d H:i:s', time() - 60);
        echo "<script type='text/javascript'>";
        echo "var xValues = [];";
        echo "var cpuTemp = [];";
        echo "var cpuLoad = [];";
        echo "var ramLoad = [];";
        echo "var storageLoad = [];";
        echo "</script>";
        while($i<60){
            $sql="SELECT AVG(cpu_temp), AVG(cpu_load), AVG(ram_load), AVG(storage_load) FROM srv_data_t WHERE user='$email' AND (time_stamp BETWEEN '$dateMinusMinute' AND '$date') ORDER BY id DESC";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $time=json_encode(substr($date,-8,5));
                    $cpuTemp=json_encode(round($row['AVG(cpu_temp)']),2);
                    $cpuLoad=json_encode(round($row['AVG(cpu_load)']),2);
                    $ramLoad=json_encode(round($row['AVG(ram_load)']),2);
                    $storageLoad=json_encode(round($row['AVG(storage_load)']),2);
                    echo "<script type='text/javascript'>";
                    echo "xValues.push(".$time.");";
                    echo "cpuTemp.push(".$cpuTemp.");";
                    echo "cpuLoad.push(".$cpuLoad.");";
                    echo "ramLoad.push(".$ramLoad.");";
                    echo "storageLoad.push(".$storageLoad.");";
                    echo "</script>";
                }
                $result = mysqli_query($conn,$sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . substr($date,0,16) . "</td>";
                    echo "<td>" . round($row['AVG(cpu_temp)'],2) . "</td>";
                    echo "<td>" . round($row['AVG(cpu_load)'],2) . "</td>";
                    echo "<td>" . round($row['AVG(ram_load)'],2) . "</td>";
                    echo "<td>" . round($row['AVG(storage_load)'],2) . "</td>";
                    echo "</tr>";
                }
            }
            else{
                echo "No data has been found";
            }
            $i++;
            $date=$dateMinusMinute;
            $dateMinusMinute=date('Y-m-d H:i:s',(strtotime ( '-1 minute' , strtotime ($dateMinusMinute) ) ));;
        }
        echo "<script type='text/javascript'>";
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
        echo "</tbody>";
        echo "<tfoot>";
        echo "<tr>";
        echo "<th scope='col'>" . "Time" . "</th>";
        echo "<th scope='col'>" . "CPU temperature" . "</th>";
        echo "<th scope='col'>" . "CPU load" . "</th>";
        echo "<th scope='col'>" . "RAM load" . "</th>";
        echo "<th scope='col'>" . "Storage load" . "</th>";
        echo "</tr>";
        echo "</tfoot>";
        echo "</table>";
        echo "<script>";
        echo "$(document).ready( function () {";
        echo "$('#table-history').DataTable();";
        echo "} );";
        echo "</script>";
    }
?>
