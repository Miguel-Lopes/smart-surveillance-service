<?php 
session_start();

//verifica se todos os campos estão preenchidos
// if (empty($_POST["username"]) || empty($_POST["pass"]) || empty($_POST["username"])) {
//     $error_message = urlencode("Tem de preencher todos os campos!");
//     header("Location: signin.php?Message=".$error_message);
//     exit();
// }

if (isset($_POST["username"]) && isset($_POST["pass"]) && isset($_POST["mail"])) {
    
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $mail = $_POST["mail"];
    
    $handle = fopen("credentials/credentials.txt", "a+"); //para poder acrescentar credenciais
    $credentials = fread($handle, 1024);
    
    $lines=explode("\n", $credentials);

    foreach ($lines as $line) {
        list($stored_username, $stored_mail, ) = explode(":", $line);
        if ($username == $stored_username) {
            fclose($handle);
            $error_message = urlencode("Username já está a ser usado por outra conta!");
            header("Location: signup.php?error=".$error_message);
            exit();
        }
        if ($mail == $stored_mail) {
            fclose($handle);
            $error_message = urlencode("Email já está a ser usado por outra conta!");
            header("Location: signup.php?error=".$error_message);
            exit();
        }
    }

    //se chegou at+é aqui, é porque tanto o username como o mail inseridos pelo utilizador, não estão no ficheiro das credentials
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
    $newLine = "\n".$username.":".$mail.":".$hashed_password;
    fwrite($handle, $newLine);
    fclose($handle);

    //cria a pasta para o novo user
    mkdir("credentials/".$username."/", 0777, true);

    $message = urlencode("Conta criada com sucesso!");
    header("Location: signin.php?Message=".$message);
    exit();


}
