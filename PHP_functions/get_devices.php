
<?php

//----------------------------------------sensors & ACTUATORS----------------------------------------------

/**
 * Fetches data for a given sensor or actuator from the specific txt file.
 *
 * @param string $devicePath The base path for  device's data files.
 * @return array Contains  value, data, log, and name of the device.
 */
function fetchDeviceData($devicePath) {
    $data = [];
    $data['valor'] = file_get_contents($devicePath . "/valor.txt");
    $data['data'] = file_get_contents($devicePath . "/data.txt");
    $data['log'] = file_get_contents($devicePath . "/log.txt");
    $data['nome'] = file_get_contents($devicePath . "/nome.txt");

    return $data;
}

// Base paths
$basePaths = [
    "SensorTemperatura" => "api/sensores_atuadores/SensorTemperatura",
    "SensorHumidade" => "api/sensores_atuadores/SensorHumidade",
    "SensorFumo" => "api/sensores_atuadores/SensorFumo",
    "SensorMovimento" => "api/sensores_atuadores/SensorMovimento",
    "SensorPortaPrincipal" => "api/sensores_atuadores/SensorPortaPrincipal",
    "SensorPortaTraseira" => "api/sensores_atuadores/SensorPortaTraseira",
    "SensorSismicoSul" => "api/sensores_atuadores/SensorSismicoSul",
    "SensorSismicoNorte" => "api/sensores_atuadores/SensorSismicoNorte",
    "SensorSismicoOeste" => "api/sensores_atuadores/SensorSismicoOeste",
    "SensorSismicoEste" => "api/sensores_atuadores/SensorSismicoEste",
    "PortaPrincipal" => "api/sensores_atuadores/PortaPrincipal",
    "PortaTraseira" => "api/sensores_atuadores/PortaTraseira",
    "LedPortaPrincipal" => "api/sensores_atuadores/LedPortaPrincipal",
    "LedPortaTraseira" => "api/sensores_atuadores/LedPortaTraseira",
    "Buzzer" => "api/sensores_atuadores/Buzzer"
];

// Fetch device data
$devicesData = [];
foreach ($basePaths as $name => $path) {
    $devicesData[$name] = fetchDeviceData($path);
}
