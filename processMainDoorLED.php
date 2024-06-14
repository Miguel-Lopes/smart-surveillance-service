<?php
// Caminho do arquivo
$filePath = 'api/sensores_atuadores/LedPortaPrincipal';

function getCurrentValue($filePath) {
    if (file_exists($filePath)) {
        $value = file_get_contents($filePath."/valor.txt");
        return trim($value);
    } else {
        return "0"; // Valor padrão se o arquivo não existir
    }
}
function switchBinaryValues($filePath) {
    $currentValue = getCurrentValue($filePath);
    $newValue = ($currentValue == "0") ? "1" : "0";
    file_put_contents($filePath . "/valor.txt", $newValue);
    file_put_contents($filePath . "/data.txt", date('Y-m-d H:i:s'));
    file_put_contents($filePath . "/log.txt", $newValue . " " . date('Y-m-d H:i:s'));
    return $newValue;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Altera o valor
    $newValue = switchBinaryValues($filePath);
    header("Location: " . $_SERVER['PHP_SELF']); 
    exit;
}

// Obtém o valor atual para exibição
$currentValue = getCurrentValue($filePath);



header("Location: AtuadoresESensores.php");
        exit();