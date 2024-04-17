<?php

header('Content-Type: text/html; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required POST parameters are set
    if (isset($_POST['valor'], $_POST['nome'], $_POST['data'])) {
        file_put_contents("sensores_atuadores/" . $_POST['nome'] . "/valor.txt", $_POST['valor']);
        file_put_contents("sensores_atuadores/" . $_POST['nome'] . "/nome.txt", $_POST['nome']);
        file_put_contents("sensores_atuadores/" . $_POST['nome'] . "/data.txt", $_POST['data']);
        file_put_contents("sensores_atuadores/" . $_POST['nome'] . "/log.txt", $_POST['data'] . " " . $_POST['valor'] . PHP_EOL, FILE_APPEND);
        
        echo "Recebi um POST: " . $_POST['valor'];
        http_response_code(200); // OK
    } else {
        echo "Missing parameters in POST request.";
        http_response_code(400); // Bad Request
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['nome'])) {
        $path = "sensores_atuadores/" . $_GET['nome'] . "/valor.txt";
        if (file_exists($path)) {
            echo file_get_contents($path);
            http_response_code(200); // OK
        } else {
            echo "File not found.";
            http_response_code(404); // Not Found
        }
    } else {
        echo "Missing parameters in GET request.";
        http_response_code(400); // Bad Request
    }
} else {
    echo "Method Not Allowed";
    http_response_code(405); // Method Not Allowed
}
?>