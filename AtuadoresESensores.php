<?php 
    session_start();
    // session_destroy();
    
    if (!isset($_SESSION['username'])) {
        header("Location: signin.php");
        exit();
    }else{
        //verificação para destruir a sessão após 10 minutos (600 segundos)
        if ((time()-$_SESSION['last_login_timestamp']) > 600) {
            header("Location: logout.php");
            exit();
        }
    }
?>
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
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="ourStyle.css">
    
    <script src="https://kit.fontawesome.com/6f6eae0546.js" crossorigin="anonymous"></script>
    <script>
var imagesDoor = [
    "Icons/doorOpen.png",
    "Icons/doorClosed.png",
];

var imagesBuzzer = [
    "Icons/buzzerOff.png",
    "Icons/buzzer.png",
];

var imagesLed = [
    "Icons/LedOff.png",
    "Icons/LedOn.png",    
];


var indexDoorMain = 0;
var indexDoorSecondary = 0;
var indexBuzzer = 0;
var indexLedMain = 0;
var indexLedSecondary = 0;


function changeImageDoorMain() {
    indexDoorMain = (indexDoorMain + 1) % imagesDoor.length;
    document.getElementById('imageToChangeDoor').src = imagesDoor[indexDoorMain];
}

function changeImageDoorSecondary() {
    indexDoorSecondary = (indexDoorSecondary + 1) % imagesDoor.length;
    document.getElementById('imageToChangeDoorSecondary').src = imagesDoor[indexDoorSecondary];
}

function changeImageBuzzer() {
    indexBuzzer = (indexBuzzer + 1) % imagesBuzzer.length;
    document.getElementById('imageToChangeBuzzer').src = imagesBuzzer[indexBuzzer];
}

function changeImageLedMain() {
    indexLedMain = (indexLedMain + 1) % imagesLed.length;
    document.getElementById('imageToChangeLedMain').src = imagesLed[indexLedMain];
   
  /* 
    if(indexLedMain % 2 == 0){ 
    file_put_contents("sensores_atuadores/LedPortaPrincipal/valor.txt", $_POST["0"]);
    
}else{
    file_put_contents("sensores_atuadores/LedPortaPrincipal/valor.txt", $_POST["1"]);
}
Fazer com que quando se carrega num botão os estados dos atuadores sejam alterados
*/
}

function changeImageLedSecondary() {
    indexLedSecondary = (indexLedSecondary + 1) % imagesLed.length;
    document.getElementById('imageToChangeLedSecondary').src = imagesLed[indexLedSecondary];
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

</head>

<body>

<?php

//----------------------------------------SENSORES----------------------------------------------    

//Sensor de temperatura
$valor_temperatura = file_get_contents("api/sensores_atuadores/SensorTemperatura/valor.txt");
$data_temperatura = file_get_contents("api/sensores_atuadores/SensorTemperatura/data.txt");
$log_temperatura = file_get_contents("api/sensores_atuadores/SensorTemperatura/log.txt");
$nome_temperatura = file_get_contents("api/sensores_atuadores/SensorTemperatura/nome.txt");


//Sensor de humidade
$valor_humidade = file_get_contents("api/sensores_atuadores/SensorHumidade/valor.txt");
$data_humidade = file_get_contents("api/sensores_atuadores/SensorHumidade/data.txt");
$log_humidade = file_get_contents("api/sensores_atuadores/SensorHumidade/log.txt");
$nome_humidade = file_get_contents("api/sensores_atuadores/SensorHumidade/nome.txt");


//Sensor de fumo
$valor_fumo = file_get_contents("api/sensores_atuadores/SensorFumo/valor.txt");
$data_fumo = file_get_contents("api/sensores_atuadores/SensorFumo/Data.txt");
$log_fumo = file_get_contents("api/sensores_atuadores/SensorFumo/log.txt");
$nome_fumo = file_get_contents("api/sensores_atuadores/SensorFumo/nome.txt");


//Sensor de movimento
$valor_movimento = file_get_contents("api/sensores_atuadores/SensorMovimento/valor.txt");
$data_movimento = file_get_contents("api/sensores_atuadores/SensorMovimento/data.txt");
$log_movimento = file_get_contents("api/sensores_atuadores/SensorMovimento/log.txt");
$nome_movimento = file_get_contents("api/sensores_atuadores/SensorMovimento/nome.txt");


//Sensores das portas (Para confirmar se estão abertas ou fechadas)
$valor_sensor_Porta_Principal = file_get_contents("api/sensores_atuadores/SensorPortaPrincipal/valor.txt");
$data_sensor_Porta_Principal = file_get_contents("api/sensores_atuadores/SensorPortaPrincipal/data.txt");
$log_sensor_Porta_Principal = file_get_contents("api/sensores_atuadores/SensorPortaPrincipal/log.txt");
$nome_sensor_Porta_Principal = file_get_contents("api/sensores_atuadores/SensorPortaPrincipal/nome.txt");

$valor_sensor_Porta_Traseira = file_get_contents("api/sensores_atuadores/SensorPortaTraseira/valor.txt");
$data_sensor_Porta_Traseira = file_get_contents("api/sensores_atuadores/SensorPortaTraseira/data.txt");
$log_sensor_Porta_Traseira = file_get_contents("api/sensores_atuadores/SensorPortaTraseira/log.txt");
$nome_sensor_Porta_Traseira = file_get_contents("api/sensores_atuadores/SensorPortaTraseira/nome.txt");


//Sensores Sismicos
$valor_SensorSismicoSul = file_get_contents("api/sensores_atuadores/SensorSismicoSul/valor.txt");
$data_SensorSismicoSul = file_get_contents("api/sensores_atuadores/SensorSismicoSul/data.txt");
$log_SensorSismicoSul = file_get_contents("api/sensores_atuadores/SensorSismicoSul/log.txt");
$nome_SensorSismicoSul = file_get_contents("api/sensores_atuadores/SensorSismicoSul/nome.txt");

$valor_SensorSismicoNorte = file_get_contents("api/sensores_atuadores/SensorSismicoNorte/valor.txt");
$data_SensorSismicoNorte = file_get_contents("api/sensores_atuadores/SensorSismicoNorte/data.txt");
$log_SensorSismicoNorte = file_get_contents("api/sensores_atuadores/SensorSismicoNorte/log.txt");
$nome_SensorSismicoNorte = file_get_contents("api/sensores_atuadores/SensorSismicoNorte/nome.txt");

$valor_SensorSismicoOeste = file_get_contents("api/sensores_atuadores/SensorSismicoOeste/valor.txt");
$data_SensorSismicoOeste = file_get_contents("api/sensores_atuadores/SensorSismicoOeste/data.txt");
$log_SensorSismicoOeste = file_get_contents("api/sensores_atuadores/SensorSismicoOeste/log.txt");
$nome_SensorSismicoOeste = file_get_contents("api/sensores_atuadores/SensorSismicoOeste/nome.txt");

$valor_SensorSismicoEste = file_get_contents("api/sensores_atuadores/SensorSismicoEste/valor.txt");
$data_SensorSismicoEste = file_get_contents("api/sensores_atuadores/SensorSismicoEste/data.txt");
$log_SensorSismicoEste = file_get_contents("api/sensores_atuadores/SensorSismicoEste/log.txt");
$nome_SensorSismicoEste = file_get_contents("api/sensores_atuadores/SensorSismicoEste/nome.txt");



//----------------------------------------ATUADORES----------------------------------------------  
//Atuadores para abrir e fechar as portas
$valor_Porta_Principal = file_get_contents("api/sensores_atuadores/PortaPrincipal/valor.txt");
$data_Porta_Principal = file_get_contents("api/sensores_atuadores/PortaPrincipal/data.txt");
$log_Porta_Principal = file_get_contents("api/sensores_atuadores/PortaPrincipal/log.txt");
$nome_Porta_Principal = file_get_contents("api/sensores_atuadores/PortaPrincipal/nome.txt");

$valor_Porta_Traseira = file_get_contents("api/sensores_atuadores/PortaTraseira/valor.txt");
$data_Porta_Traseira = file_get_contents("api/sensores_atuadores/PortaTraseira/data.txt");
$log_Porta_Traseira = file_get_contents("api/sensores_atuadores/PortaTraseira/log.txt");
$nome_Porta_Traseira = file_get_contents("api/sensores_atuadores/PortaTraseira/nome.txt");


//Leds das portas
$valor_led_Principal = file_get_contents("api/sensores_atuadores/LedPortaPrincipal/valor.txt");
$data_led_Principal = file_get_contents("api/sensores_atuadores/LedPortaPrincipal/data.txt");
$log_led_Principal = file_get_contents("api/sensores_atuadores/LedPortaPrincipal/log.txt");
$nome_led_Principal = file_get_contents("api/sensores_atuadores/LedPortaPrincipal/nome.txt");

$valor_led_Traseiro = file_get_contents("api/sensores_atuadores/LedPortaTraseira/valor.txt");
$data_led_Traseiro = file_get_contents("api/sensores_atuadores/LedPortaTraseira/data.txt");
$log_led_Traseiro = file_get_contents("api/sensores_atuadores/LedPortaTraseira/log.txt");
$nome_led_Traseiro = file_get_contents("api/sensores_atuadores/LedPortaTraseira/nome.txt");


//Alarme Sonoro
$valor_Buzzer = file_get_contents("api/sensores_atuadores/Buzzer/valor.txt");
$data_Buzzer = file_get_contents("api/sensores_atuadores/Buzzer/data.txt");
$log_Buzzer = file_get_contents("api/sensores_atuadores/Buzzer/log.txt");
$nome_Buzzer = file_get_contents("api/sensores_atuadores/Buzzer/nome.txt");


?>
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
                    <a href="AtuadoresESensores.php" class="nav-item nav-link active"><i class="fa-solid fa-tower-broadcast me-2"></i>Control room</a>
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
                                <a href="logTemperature.php" class="nav-item nav-link active">Temperature: <?php echo $valor_temperatura; ?>º</a>
                                <h6 class="mb-0">Last updated: <?php echo $data_temperatura; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/humidity.png" alt="Humidity"   
                        width="50" 
                        height="50">

                            <div class="ms-3">
                            <a href="logHumidity.php" class="nav-item nav-link active">Humidity: <?php echo $valor_humidade; ?>%</a>
                                <h6 class="mb-0">Last updated: <?php echo $data_humidade; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/smoke.png" alt="Smoke"   
                        width="50" 
                        height="50"     >
                            <div class="ms-3">
                            <a href="logSmoke.php" class="nav-item nav-link active">Smoke: <?php echo $valor_fumo; ?>%</a>
                                <h6 class="mb-0">Last updated: <?php echo $data_fumo; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/movement.png" alt="Movement"   
                        width="50" 
                        height="50"     >
                            <div class="ms-3">
                            <a href="logMovement.php" class="nav-item nav-link active">Movement: <?php echo $valor_movimento; ?></a>
                                <h6 class="mb-0">Last updated: <?php echo $data_movimento; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/east.png" alt="East seismic sensor"   
                        width="50" 
                        height="50">
                            <div class="ms-3">
                                <a href="logSeismicSensorEast.php" class="nav-item nav-link active">Seismic sensor east: <?php echo $valor_SensorSismicoEste; ?></a>
                                <h6 class="mb-0">Last updated: <?php echo $data_SensorSismicoEste; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/north.png" alt="North seismic sensor"   
                        width="50" 
                        height="50">
                            <div class="ms-3">
                            <a href="logSeismicSensorNorth.php" class="nav-item nav-link active">Seismic sensor north: <?php echo $valor_SensorSismicoNorte; ?></a>
                                <h6 class="mb-0">Last updated: <?php echo $data_SensorSismicoNorte; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/west.png" alt="West seismic sensor"
                        width="50" 
                        height="50"     >
                            <div class="ms-3">
                            <a href="logSeismicSensorWest.php" class="nav-item nav-link active">Seismic sensor west: <?php echo $valor_SensorSismicoOeste; ?></a>
                                <h6 class="mb-0">Last updated: <?php echo $data_SensorSismicoOeste; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img src="Icons/south.png" alt="South seismic sensor"   
                        width="50" 
                        height="50"     >
                            <div class="ms-3">
                            <a href="logSeismicSensorSouth.php" class="nav-item nav-link active">Seismic sensor south: <?php echo $valor_SensorSismicoSul; ?></a>
                                <h6 class="mb-0">Last updated: <?php echo $data_SensorSismicoSul; ?></h6>
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
                                    <a href="logMainDoor.php" class="nav-item nav-link active"><img id="imageToChangeDoor" src="Icons/doorOpen.png" alt="Main door" width="30" height="30"> Main door status <?php echo $valor_Porta_Principal;?> | last updated: <?php echo $data_Porta_Principal; ?></a>
                                        <button onclick="changeButtonText(this); changeImageDoorMain();" type="button" class="btn btn-primary ms-2">Lock</button> 
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                    <a href="logBackDoor.php" class="nav-item nav-link active"><img id="imageToChangeDoorSecondary" src="Icons/doorOpen.png" alt="Back door" width="30" height="30"> Back door status <?php echo $valor_Porta_Traseira;?> | last updated: <?php echo $data_Porta_Traseira; ?></a>
                                        <button onclick="changeButtonText(this); changeImageDoorSecondary();" type="button" class="btn btn-primary ms-2">Lock</button> 
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                    <a href="logBuzzer.php" class="nav-item nav-link active"><img id="imageToChangeBuzzer" src="Icons/buzzerOff.png" alt="Buzzer" width="30" height="30"> Buzzer status <?php echo $valor_Buzzer;?> | last updated: <?php echo $data_Buzzer; ?></a>
                                        <button onclick="changeButtonText(this); changeImageBuzzer();" type="button" class="btn btn-primary ms-2">On</button> 
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                    <a href="logLedMain.php" class="nav-item nav-link active"><img id="imageToChangeLedMain" src="Icons/LedOff.png" alt="Main led" width="30" height="30"> Main led status status <?php echo $valor_led_Principal;?> | last updated: <?php echo $data_led_Principal; ?></a>
                                        <button onclick="changeButtonText(this); changeImageLedMain();" type="button" class="btn btn-primary ms-2">On</button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                    <a href="logLedSecondary.php" class="nav-item nav-link active"><img id="imageToChangeLedSecondary" src="Icons/LedOff.png" alt="Secondary led" width="30" height="30"> Back led status status <?php echo $valor_led_Traseiro;?> | last updated: <?php echo $data_led_Traseiro; ?></a>
                                        <button onclick="changeButtonText(this); changeImageLedSecondary();" type="button" class="btn btn-primary ms-2">On</button> 
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

        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

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
</body>

</html>