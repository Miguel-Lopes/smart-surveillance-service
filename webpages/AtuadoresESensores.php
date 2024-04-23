<?php include 'auth_session.php';
      include 'get_devices.php'; ?>
      
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="ourStyle.css">
    
   
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">SHADOW STRIKE</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <?php
                            if(file_exists("credentials/".$_SESSION["username"]."/photo.PNG")){
                                echo "<img class='rounded-circle' src='credentials/".$_SESSION["username"]."/photo.PNG' alt='' style='width: 40px; height: 40px;'>";
                            }else{
                                echo "<img class='rounded-circle' src='img/default_account-removebg-preview.PNG' alt='' style='width: 40px; height: 40px;'>";
                            }
                        ?>
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['username']?></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="dashboard.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.html" class="nav-item nav-link"><i class="fa fa-video me-2"></i>Surveilance Room</a>
                </div>
                <div class="navbar-nav w-100">
                    <a href="AtuadoresESensores.php" class="nav-item nav-link active"><i class="fa fa-video me-2"></i>Control room</a>
                </div>
                <div class="navbar-nav w-100">
                    <a href="accountsPanel.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Accounts Panel</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jon sent you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notifications</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <?php
                            if(file_exists("credentials/".$_SESSION["username"]."/photo.PNG")){
                                echo "<img class='rounded-circle' src='credentials/".$_SESSION["username"]."/photo.PNG' alt='' style='width: 40px; height: 40px;'>";
                            }else{
                                echo "<img class='rounded-circle' src='img/default_account-removebg-preview.PNG' alt='' style='width: 40px; height: 40px;'>";
                            }
                        ?>
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['username'] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="profile.php" class="dropdown-item">My Profile</a>
                            <a href="settings.php" class="dropdown-item">Settings</a>
                            <a href="logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/temperature.png" alt="Temperature"   
                        width="50" 
                        height="50">
                            <div class="ms-3">
                                <a href="logTemperature.php" class="nav-item nav-link active">Temperature: <?php echo $devicesData['SensorTemperatura']['valor']; ?>º</a>
                                <h6 class="mb-0">Last updated:  <?php echo $devicesData['SensorTemperatura']['data']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/humidity.png" alt="Humidity"   
                        width="50" 
                        height="50">

                            <div class="ms-3">
                            <a href="logHumidity.php" class="nav-item nav-link active">Humidity: <?php echo $devicesData['SensorHumidade']['valor']; ?>%</a>
                                <h6 class="mb-0">Last updated: <?php echo $devicesData['SensorHumidade']['data']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/smoke.png" alt="Smoke"   
                        width="50" 
                        height="50"     >
                            <div class="ms-3">
                            <a href="logSmoke.php" class="nav-item nav-link active">Smoke: <?php echo $devicesData['SensorFumo']['valor']; ?>%</a>
                                <h6 class="mb-0">Last updated: <?php echo $devicesData['SensorFumo']['data']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/movement.png" alt="Movement"   
                        width="50" 
                        height="50"     >
                            <div class="ms-3">
                            <a href="logMovement.php" class="nav-item nav-link active">Movement: <?php echo $devicesData['SensorMovimento']['valor']; ?></a>
                                <h6 class="mb-0">Last updated: <?php echo $devicesData['SensorMovimento']['data']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/east.png" alt="East seismic sensor"   
                        width="50" 
                        height="50">
                            <div class="ms-3">
                                <a href="logSeismicSensorEast.php" class="nav-item nav-link active">Seismic sensor east: <?php echo $devicesData['SensorSismicoEste']['valor']; ?></a>
                                <h6 class="mb-0">Last updated: <?php echo $devicesData['SensorSismicoEste']['data']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/north.png" alt="North seismic sensor"   
                        width="50" 
                        height="50">
                            <div class="ms-3">
                            <a href="logSeismicSensorNorth.php" class="nav-item nav-link active">Seismic sensor north: <?php echo $devicesData['SensorSismicoNorte']['valor']; ?></a>
                                <h6 class="mb-0">Last updated: <?php echo $devicesData['SensorSismicoNorte']['data']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/west.png" alt="West seismic sensor"
                        width="50" 
                        height="50"     >
                            <div class="ms-3">
                            <a href="logSeismicSensorWest.php" class="nav-item nav-link active">Seismic sensor west: <?php echo $devicesData['SensorSismicoOeste']['valor']; ?></a>
                                <h6 class="mb-0">Last updated: <?php echo $devicesData['SensorSismicoNorte']['data']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/south.png" alt="South seismic sensor"   
                        width="50" 
                        height="50"     >
                            <div class="ms-3">
                            <a href="logSeismicSensorSouth.php" class="nav-item nav-link active">Seismic sensor south: <?php echo $devicesData['SensorSismicoSul']['valor']; ?></a>
                                <h6 class="mb-0">Last updated: <?php echo $devicesData['SensorSismicoSul']['data']; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->
            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    
             
                            <div class="d-flex mb-2">
                                <input class="form-control bg-dark border-0" type="text" placeholder="Actuators">
                                <button class="buttonImportant" onclick="alert('Facility is now under lockdown!');"><span>Lockdown</span></button> 
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                    <a href="logMainDoor.php" class="nav-item nav-link active"><img id="imageToChangeDoor" src="Icons/doorOpen.png" alt="Main door" width="30px" height="30px"> Main door status: <?php echo $devicesData['PortaPrincipal']['valor']; ?> | last updated: <?php echo $devicesData['PortaPrincipal']['data']; ?></a>
                                        <button onclick="changeButtonText(this); changeImage('imageToChangeDoor', 'doorMain');" type="button" class="btn btn-primary ms-2">Lock</button> 
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                    <a href="logBackDoor.php" class="nav-item nav-link active"><img id="imageToChangeDoorSecondary" src="Icons/doorClosed.png" alt="Back door" width="30px" height="30px"> Back door status: <?php echo $devicesData['PortaTraseira']['valor']; ?> | last updated: <?php echo $devicesData['PortaTraseira']['data']; ?></a>
                                        <button onclick="changeButtonText(this); changeImage('imageToChangeDoorSecondary', 'doorSecondary');" type="button" class="btn btn-primary ms-2">Lock</button> 
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                    <a href="logBuzzer.php" class="nav-item nav-link active"><img id="imageToChangeBuzzer" src="Icons/buzzerOff.png" alt="Buzzer" width="30px" height="30px"> Buzzer status: <?php echo $devicesData['Buzzer']['valor']; ?> | last updated: <?php echo $devicesData['Buzzer']['data']; ?></a>
                                        <button onclick="changeButtonText(this); changeImage('imageToChangeBuzzer', 'buzzer');" type="button" class="btn btn-primary ms-2">On</button> 
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                    <a href="logLedMain.php" class="nav-item nav-link active"><img id="imageToChangeLedMain" src="Icons/LedOff.png" alt="Main led" width="30px" height="30px"> Main led status status: <?php echo $devicesData['LedPortaPrincipal']['valor']; ?> | last updated: <?php echo $devicesData['LedPortaPrincipal']['data']; ?></a>
                                        <button onclick="changeButtonText(this); changeImage('imageToChangeLedMain', 'ledMain');" type="button" class="btn btn-primary ms-2">On</button>
                                    </div>  
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                    <a href="logLedSecondary.php" class="nav-item nav-link active"><img id="imageToChangeLedSecondary" src="Icons/LedOff.png" alt="Secondary led" width="30px" height="30px"> Back led status status <?php echo $devicesData['LedPortaTraseira']['valor']; ?> | last updated: <?php echo $devicesData['LedPortaTraseira']['data']; ?></a>
                                        <button onclick="changeButtonText(this); changeImage('imageToChangeLedSecondary', 'ledSecondary');" type="button" class="btn btn-primary ms-2">On</button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script> 
    
    <!-- Function to make icons change when button is pressed-->
    <script>
var images = {
    doorMain: ["Icons/doorOpen.png", "Icons/doorClosed.png"],
    doorSecondary: [ "Icons/doorClosed.png", "Icons/doorOpen.png"],
    buzzer: ["Icons/buzzerOff.png", "Icons/buzzer.png"],
    ledMain: ["Icons/LedOff.png", "Icons/LedOn.png"],
    ledSecondary: ["Icons/LedOff.png", "Icons/LedOn.png"],
};

var indices = {
    doorMain: 0,
    doorSecondary: 0,
    buzzer: 0,
    ledMain: 0,
    ledSecondary: 0
};

function changeImage(elementId, type) {
    indices[type] = (indices[type] + 1) % images[type].length;
    document.getElementById(elementId).src = images[type][indices[type]];
}

function Lockdown() {
    changeImageBuzzer();
    changeImageDoorMain();
    changeImageDoorSecondary();
    changeImageLedMain();
    changeImageLedSecondary();

 //Fazer com que os botões mudem todos de estado   
}



function changeButtonText(button) {
    if (button.innerHTML == "Off") {
        button.innerHTML = "On";
    } else if(button.innerHTML == "On") {
        button.innerHTML = "Off";
    } else if(button.innerHTML == "Lock") {
        button.innerHTML = "Unlock";
    }else {
        button.innerHTML = "Lock";
    }

}
</script>

</body>

</html>