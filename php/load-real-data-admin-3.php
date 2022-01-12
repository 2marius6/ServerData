<?php
    include 'db-conn.php';
    global $conn;
    $sql = "SELECT * FROM srv_data_t WHERE id = (SELECT MAX(id) FROM srv_data_t WHERE user='marius.nichiteanu01@e-uvt.ro') LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p> Real-time data for " . "<b>" . $row["user"] . ":</b></p>";
            echo "<p> Time of last status update: " . "<b>" . $row["time_stamp"] . "</b>";
            echo "<p> Server location: " . "<b>" . $row["town"] . ", " . $row["county"] . ", " . $row["country"] . "</b>";
            echo "<p> Ip address: " . "<b>" . $row["ip_address"] . "</b>";
            echo "<p> CPU model: " . "<b>" . $row["cpu"] . "</b>";
            echo "<p> CPU temperature: " . "<b>" . $row["cpu_temp"] . "°C" . "</b>";
            echo "<p> Number of CPU cores: " . "<b>" . $row["cpu_nof_cores"] . "</b>";
            echo "<p> CPU load: " . "<b>" . $row["cpu_load"] . "%" . "</b>";
            echo "<p> Max CPU frequency: " . "<b>" . $row["cpu_max_freq"] . " GHz" . "</b>";
            echo "<p> Total RAM size: " . "<b>" . $row["ram_total"] . " GB" . "</b>";
            echo "<p> Free RAM: " . "<b>" . $row["ram_free"] . " GB" . "</b>";
            echo "<p> Used RAM: " . "<b>" . $row["ram_used"] . " GB" . "</b>";
            echo "<p> RAM load: " . "<b>" . $row["ram_load"] . "%" . "</b>";
            echo "<p> Total storage size: " . "<b>" . $row["storage_total"] . " GB" . "</b>";
            echo "<p> Free storage: " . "<b>" . $row["storage_free"] . " GB" . "</b>";
            echo "<p> Used storage: " . "<b>" . $row["storage_used"] . " GB" . "</b>";
            echo "<p> Storage Load: " . "<b>" . $row["storage_load"] . "%" . "</b>";
        }
    } else {
        echo("No data has been found");
    }
?>
