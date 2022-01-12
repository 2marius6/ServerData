$(document).ready(function() {
    setInterval(function() {
        $("#real-time-data-admin-2").load("php/load-real-data-admin-2.php", {
        });
    }, 1000);
});