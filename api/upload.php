<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o arquivo foi enviado e se não ocorreu nenhum erro
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        // Define variáveis úteis
        $fileTmpPath = $_FILES['imagem']['tmp_name'];
        $fileName = $_FILES['imagem']['name'];
        $fileSize = $_FILES['imagem']['size'];
        $fileType = $_FILES['imagem']['type'];
        $fileNameCmps = pathinfo($fileName);
        $fileExtension = strtolower($fileNameCmps['extension']);

        // Define um novo nome seguro para o arquivo
        $newFileName = 'webcam.jpg';

        // Diretório de destino
        $uploadFileDir = '../img/';
        $dest_path = $uploadFileDir . $newFileName;

        // Verifica se o diretório de destino existe e é gravável
        if (!is_dir($uploadFileDir) || !is_writable($uploadFileDir)) {
            echo json_encode(['error' => 'Upload directory is not writable or does not exist.']);
            http_response_code(500); // Internal Server Error
            exit();
        }

        // Verifica a extensão do arquivo
        $allowedfileExtensions = array('jpg', 'png');
        if (!in_array($fileExtension, $allowedfileExtensions)) {
            echo json_encode(['error' => 'File type not allowed. Only .jpg and .png are accepted.']);
            http_response_code(400); // Bad Request
            exit();
        }

        // Verifica o tamanho do arquivo (máximo 1000 kB)
        $maxFileSize = 1000 * 1024; // 1000 kB
        if ($fileSize > $maxFileSize) {
            echo json_encode(['error' => 'File size exceeds the 1000 kB limit.']);
            http_response_code(400); // Bad Request
            exit();
        }

        // Move o arquivo para o destino final
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            echo json_encode(['success' => 'File uploaded successfully.']);
            http_response_code(200); // OK
        } else {
            echo json_encode(['error' => 'There was an error moving the uploaded file.']);
            http_response_code(500); // Internal Server Error
        }
    } else {
        $error_message = 'No file uploaded or file upload error.';
        if (isset($_FILES['imagem']['error'])) {
            $error_message = 'File upload error code: ' . $_FILES['imagem']['error'];
        }
        echo json_encode(['error' => $error_message]);
        http_response_code(400); // Bad Request
    }
} else {
    echo json_encode(['error' => 'Method Not Allowed']);
    http_response_code(405); // Method Not Allowed
}