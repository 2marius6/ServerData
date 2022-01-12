<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    include 'php/db-conn.php';
    global $conn;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ServerInfo - Main page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="js/real-time-update.js"></script>
    <script src="js/real-time-update-admin-1.js"></script>
    <script src="js/real-time-update-admin-2.js"></script>
    <script src="js/real-time-update-admin-3.js"></script>
    <script src="js/real-time-update-admin-4.js"></script>
    <script src="js/data-table-minute.js"></script>
    <script src="js/data-table-hour.js"></script>
    <script src="js/data-table-day.js"></script>
    <script src="js/data-table-week.js"></script>
    <script src="js/data-table-month.js"></script>
    <script src="js/data-table-year.js"></script>
    <script src="js/user-options.js"></script>
    <script src="js/delete-user.js"></script>
    <script src="js/close-options.js"></script>
    <script src="js/registration.js"></script>
    <script src="js/new-user.js"></script>
    <script src="js/modify.js"></script>
    <script src="js/change-pass.js"></script>
    <script src="js/sort-table.js"></script>
    <script src="https://kit.fontawesome.com/67ce579b40.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css"/>

</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark-blue flex-md-nowrap p-0">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3">
            <?php
                if($_SESSION['role']=='admin')
                    echo 'Admin dashboard';
                else
                    echo "Welcome, " . $_SESSION['name']
            ?>
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light-blue sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#home">
                                <span class="fas fa-house-user"></span>
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#dataHistory">
                                <span class="fas fa-history"></span>
                                Data history
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#settings">
                                <span class="fas fa-cogs"></span>
                                User settings
                            </a>
                        </li>
                        <?php
                        if($_SESSION['role']=='admin'){
                            echo "<li class='nav-item'>" .
                            "<a class='nav-link' href='#admin'>".
                                "<span class='fas fa-user-shield'></span>".
                                " Admin area".
                            "</a>".
                            "</li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">
                                <span class="fas fa-info-circle"></span>
                                About
                            </a>
                        </li>
                        <li class="nav-item fixed-bottom">
                            <a class="nav-link" href="php/logout.php">
                                <span class="fas fa-sign-out-alt"></span>
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2" id="home">Home</h1>
                </div>
                <div id="home">
                    <?php include 'php/grab-coord.php';?>
                    <script type="text/javascript">
                        <?php echo "var markers=$markers;\n";?>
                        size = Object.keys(markers[0]).length;
                        var i=0;
                        function initMap() {
                            var coord_lat = 45.756261;
                            var coord_long = 21.228476;
                            var location = {lat: parseFloat(coord_lat), lng: parseFloat(coord_long)};
                            const map = new google.maps.Map(document.getElementById("map"), {
                                mapId: '7c8f707e01e71fad',
                                zoom: 12,
                                center: location,
                            });
                            while(i<=size){
                                var contentString;
                                if(i==1){
                                    contentString="<div id='real-time-data-admin-1'>" +
                                        "<?php include 'php/load-real-data-admin-1.php'?>" +
                                        "</div>";
                                }else if(i==2){
                                    contentString="<div id='real-time-data-admin-2'>" +
                                        "<?php include 'php/load-real-data-admin-2.php'?>" +
                                        "</div>";
                                }else if(i==3){
                                    contentString="<div id='real-time-data-admin-3'>" +
                                        "<?php include 'php/load-real-data-admin-3.php'?>" +
                                        "</div>";
                                }else if(i==4){
                                    contentString="<div id='real-time-data-admin-4'>" +
                                        "<?php include 'php/load-real-data-admin-4.php'?>" +
                                        "</div>";
                                }

                                location = {lat: parseFloat(markers[0][i]), lng: parseFloat(markers[1][i])};
                                const marker = new google.maps.Marker({
                                    position: location,
                                    map,
                                    title: "Server",
                                    animation: google.maps.Animation.DROP
                                });
                                if(size==1){
                                    const infowindow = new google.maps.InfoWindow({
                                        content: "<div id='real-time-data'>" +
                                            "<?php include 'php/load-real-data.php'?>" +
                                            "</div>",
                                    });
                                    marker.addListener("click", () => {
                                        infowindow.close();
                                        infowindow.open({
                                            anchor: marker,
                                            map,
                                            shouldFocus: false,
                                        });
                                    });
                                }
                                else{
                                    const infowindow = new google.maps.InfoWindow({
                                        content: contentString,
                                    });
                                    marker.addListener("click", () => {
                                        infowindow.close();
                                        infowindow.open({
                                            anchor: marker,
                                            map,
                                            shouldFocus: false,
                                        });
                                    });
                                }
                                i++;
                            }
                        }
                    </script>
                    <div id="map">
                        <script src="https://maps.googleapis.com/maps/api/js?key=API_KEY&callback=initMap&libraries=&v=weekly" async>
                        </script>
                    </div>
                    <br>
                </div>
                <br>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>
                        <a id="dataHistory">
                            Data History
                        </a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-dark-blue" onclick="table_update_minute()">All records from past minute</button>
                            <button type="button" class="btn btn-dark-blue dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#!" onclick="table_update_hour()">Past hour</a></li>
                                <li><a class="dropdown-item" href="#!" onclick="table_update_day()">Past 24 hours</a></li>
                                <li><a class="dropdown-item" href="#!" onclick="table_update_week()">Past 7 days</a></li>
                                <li><a class="dropdown-item" href="#!" onclick="table_update_month()">Past 30 days</a></li>
                                <li><a class="dropdown-item" href="#!" onclick="table_update_year()">Past 12 months</a></li>
                            </ul>
                        </div>
                    </h2>
                </div>
                <div id="data-history">
                    <?php include "php/load-minute-data.php"; ?>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2><a id="settings">User settings</a></h2>
                </div>
                <div>
                    <form id="passChange">
                        <div class="form-group">
                            <h4>Change password</h4>
                        </div>
                        <div class="form-group">
                            <label for="oldPass">Enter old password</label>
                            <input type="password" class="form-control" id="oldPass" aria-describedby="emailHelp" placeholder="Old password" required>
                        </div>
                        <div class="form-group">
                            <label for="newPass">Enter new password</label>
                            <input type="password" class="form-control" id="newPass" placeholder="New password" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassConf">Confirm new password</label>
                            <input type="password" class="form-control" id="newPassConf" placeholder="New password confirmation" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-dark-blue" onclick='change_pass_user()'>Submit</button>
                    </form>
                    <p id='passMsj'></p>
                </div>
                <div id="admin-box">
                <?php
                    if($_SESSION['role']=='admin'){include 'php/admin-area.php';}
                ?>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2><a id="about">About</a></h2>
                </div>
                <p>This app has the purpose to display diverse data about a number of servers (when logged in as admin) or a single server (when logged in as user). Here you can see data about CPU, RAM, storage and more, displayed real-time on the map and historically on a graph (only users) and in a table.</p>
                <p>From here all users (including the admin) can change it's own password, and the admin can manage user accounts (change their name or email, delete or register new users).</p>
                <p>What you see right now is the final product. This means that this version can look or behave different from the beta one.</p>
            </main>
        </div>
    </div>
</body>
</html>
