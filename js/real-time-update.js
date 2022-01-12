$(document).ready(function() {
    setInterval(function() {
        $("#real-time-data").load("php/load-real-data.php", {
        });
    }, 1000);
});