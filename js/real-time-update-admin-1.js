$(document).ready(function() {
    setInterval(function() {
        $("#real-time-data-admin-1").load("php/load-real-data-admin-1.php", {
        });
    }, 1000);
});