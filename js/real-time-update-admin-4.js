$(document).ready(function() {
    setInterval(function() {
        $("#real-time-data-admin-4").load("php/load-real-data-admin-4.php", {
        });
    }, 1000);
});