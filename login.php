<?php

session_start();

//verifica se os campos têm dados
if (isset($_POST['username']) && isset($_POST['password'])) {
    //guarda os dados do formulário em variaveis
    $username = $_POST['username'];
    $pass = $_POST['password'];

    if (empty($pass) || empty($username)) {
        $error_message = urlencode("Preencha todos os campos!");
        header("Location: signin.php?error=" . $error_message);
        exit();
    }

    $handle = fopen("credentials/credentials.txt", "r");
    $credentials = fread($handle, 1024);
    $lines = explode("\n", $credentials);

    foreach ($lines as $line) {
        list($stored_username, $stored_mail, $stored_hash_pass) = explode(":", $line);
        if ($stored_username === $username) {

            $stored_hash_pass = trim($stored_hash_pass);
            if (password_verify($pass, $stored_hash_pass)) {
                $_SESSION['username'] = $username;
                $_SESSION['mail'] = $stored_mail;
                $_SESSION['last_login_timestamp'] = time();
                fclose($handle);



                date_default_timezone_set('Europe/Lisbon');
                $timestamp = time();
                $currentDate = date('Y-m-d H:i', $timestamp);

                // Linha a ser adicionada
                $history_newLine = "\nLogin:#:" . gethostname() . ":#:" . $currentDate;
                // Adiciona a linha ao final do arquivo
                file_put_contents("credentials/" . $_SESSION['username'] . "/historico.txt", $history_newLine, FILE_APPEND);
                    
                //! adicionar successMessage a dizer "Welcome" para usar no dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                fclose($handle);

                date_default_timezone_set('Europe/Lisbon');
                $timestamp = time();
                $currentDate = date('Y-m-d H:i', $timestamp);

                // Linha a ser adicionada
                $history_newLine = "\nFailedLogin:#:" . gethostname() . ":#:" . $currentDate;
                // Adiciona a linha ao final do arquivo
                file_put_contents("credentials/" . $username . "/historico.txt", $history_newLine, FILE_APPEND);

                //!Mudar a forma de passar os erros (guardar na sessão)
                $error_message = urlencode("Password Inválida!" . $stored_hash_pass);
                header("Location: signin.php?error=" . $error_message);
                exit();
            }
        }
    }

    fclose($handle);

    $error_message = urlencode("Conta não encontrada!");
    header("Location: signin.php?error=" . $error_message);
    exit();


}
?>