<?php

header('Content-Type: text/html; charset=utf-8');

if($_SERVER["REQUEST_METHOD"] == "POST"){  

    echo "recebi um POST";

    echo $_POST['valor'];
    
file_put_contents("sensores_atuadores/".$_POST['nome']."/valor.txt", $_POST['valor']);

file_put_contents("sensores_atuadores/".$_POST['nome']."/nome.txt", $_POST['nome']);

file_put_contents("sensores_atuadores/".$_POST['nome']."/data.txt", $_POST['data']);

file_put_contents("sensores_atuadores/".$_POST['nome']."/log.txt",$_POST['data'] ,PHP_EOL . $_POST['valor']);
http_response_code(200);
/*
file_put_contents("files/".$_POST['nome']."/data.txt", PHP_EOL . date("Y-m-d H:i:s"));

file_put_contents("files/".$_POST['nome']."/log.txt", PHP_EOL . date("Y-m-d H:i:s"), $_POST['valor']);
*/
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // SE (Array GET tem um elemento "nome") ENTÃO
    if (isset($_GET['nome'])) {
        // Imprime no ecrã o conteúdo do ficheiro "valor.txt" correspondente sensor pedido (nome).
        $nome = $_GET['nome'];
        $file = file_get_contents("valor.txt");
        $lines = explode("\n", $file);
        foreach ($lines as $line) {
            $parts = explode(" ", $line);
            if ($parts[0] == $nome) {
                echo $parts[1];
                break;
            }
        }
    } else {
        // Imprime erro no ecrã: "faltam parametros no GET".
        echo "faltam parametros no GET";
    }
} else{     
http_response_code(403);
}



