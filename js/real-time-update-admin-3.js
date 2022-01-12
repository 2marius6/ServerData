$(document).ready(function() {
    setInterval(function() {
        $("#real-time-data-admin-3").load("php/load-real-data-admin-3.php", {
        });
    }, 1000);
});