<?php

    // error_reporting(E_ALL); 
    // ini_set('display_errors', 1);

    session_start();

    // $_SESSION['username']=$_POST['username'];
    // header("Location: index.php");

    //verifica se os campos têm dados
    if (isset($_POST['username']) && isset($_POST['password'])) {
        //guarda os dados do formulário em variaveis
        $username = $_POST['username'];
        $pass = $_POST['password'];

        if (empty($pass) || empty($username)){
            $error_message = urlencode("Preencha todos os campos!");
            header("Location: signin.php?error=".$error_message);
            exit();
        }

        $handle = fopen("credentials/credentials.txt", "r");
        $credentials = fread($handle, 1024);
        $lines=explode("\n", $credentials);

        foreach ($lines as $line) {
            list($stored_username, ,$stored_hash_pass) = explode(":", $line);
            if ($stored_username === $username) {
                if (password_verify($pass, $stored_hash_pass)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['last_login_timestamp'] = time();
                    header("Location: dashboard.php");
                    exit();
                }else {
                    $error_message = urlencode("Password Inválida!".$stored_hash_pass);
                    header("Location: signin.php?error=".$error_message);
                    exit();
                }
            }
        }
        
        $error_message = urlencode("Conta não encontrada!");
        header("Location: signin.php?error=".$error_message);
        exit();
        
       
    }
?>