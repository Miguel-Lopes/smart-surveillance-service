<?php
session_start();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se há um arquivo enviado
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == UPLOAD_ERR_OK) {
        // Pasta onde a imagem será armazenada
        $target_dir = "credentials/".$_SESSION["username"]."/";
        
        // Define o novo nome da imagem (Photo.PNG)
        $new_file_name = "photo.PNG";
        
        // Caminho completo do novo arquivo
        $target_file = $target_dir . $new_file_name;
        
        // Move a imagem para a pasta de destino
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
            echo "A imagem foi enviada com sucesso.";
            header("Location: profile.php");
        } else {
            echo "Desculpe, ocorreu um erro ao enviar a imagem.";
        }
    } else {
        echo "Desculpe, nenhum arquivo de imagem foi enviado.";
    }
}
?>
