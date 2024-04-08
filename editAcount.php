<?php
session_start();
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se há um arquivo enviado
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == UPLOAD_ERR_OK) {
        // Pasta onde a imagem será armazenada
        $target_dir = "credentials/" . $_SESSION["username"] . "/";
        // Define o novo nome da imagem (Photo.PNG)
        $new_file_name = "photo.PNG";
        // Caminho completo do novo arquivo
        $target_file = $target_dir . $new_file_name;

        // Move a imagem para a pasta de destino
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
            $_SESSION["successAlerts"][] = "Foto de perfil atualizada!";
        } else {
            $_SESSION["errorAlerts"][] = "Erro ao submeter foto!";
        }
    }//caso não haja nenhum ficheiro submetido, simplesmente ignora

    if (!empty($_POST["newUsername"]) || !empty($_POST["newMail"])) {

        if (!($_POST["newUsername"] == $_SESSION["username"] && $_POST["newMail"] == $_SESSION["mail"])) { //caso contrário, significa que não alterou nada então ignora o processo de edição

            //variaveis auxiliares, para saber que variaveis usar
            //Inicialmente são declaradas com os valores inseridos pelo user 
            //(Mas no foreach a seguir, caso encontrem uma conta já com esse valor, ignora e volta a guardar com o $stored_mail)
            $mail_to_use = $_POST["newMail"];
            $username_to_use = $_POST["newUsername"];

            //variaveis auxiliares para saber se é necessário mostrar mensagem de atualização 
            $mail_atualizado = true;
            $username_atualizado = true;

            //abre o ficheiro e verifica se não existe nenhuma conta com o NewNome (supostamente, o username é único neste ecossistema),
            // fazer o mesmo para o email
            $handle = fopen("credentials/credentials.txt", "r+");
            $credentials = fread($handle, 1024);
            $lines = explode("\n", $credentials);
            foreach ($lines as $line) {
                list($stored_username, $stored_mail, ) = explode(":", $line);
                // caso encontre uma conta com o mesmo nome, o nome da conta atual permanesse igual ignorando a linha do seu username(a unica que pode ter dados iguais e impossibilita o invio de uma mensagem)
                if ($_POST["newUsername"] == $stored_username && $_POST["newUsername"] != $_SESSION['username']) {
                    $username_to_use = $_SESSION['username'];
                    $_SESSION["errorAlerts"][] = "Username já está a ser usado por outra conta!";
                    $username_atualizado = false; // caso chegue aqui, é porque o username não será atualizado
                }
                // caso encontre uma conta com o mesmo mail, o mail da conta atual permanesse igual ignorando a linha do seu username(a unica que pode ter dados iguais e impossibilita o invio de uma mensagem)
                if ($_POST["newMail"] == $stored_mail && $_POST["newMail"] != $_SESSION['mail']) {
                    $mail_to_use = $_SESSION['mail'];
                    $_SESSION["errorAlerts"][] = "Email já está a ser usado por outra conta!";
                    $mail_atualizado = false; // caso chegue aqui, é porque o email não será atualizado
                }
            }

            //como o foreach anterior ignora a linha do user em questão, 
            //verificamos se o email e username submetidos são iguais ao do user atual,
            //e se for, ignora e não mada a mensagem de atualização 


            if ($username_to_use != $_SESSION['username'] && $username_atualizado) {
                $_SESSION["successAlerts"][] = "Username Atualizado!";
            }

            if ($mail_to_use != $_SESSION['mail'] && $mail_atualizado) {
                $_SESSION["successAlerts"][] = "Email Atualizado!";
            }

            //volta para a primeira linha do ficheiro aberto
            rewind($handle);

            //cria uma handle auxiliar
            $newHandle = '';

            //percorre o arquivo para encontrar e linha com os dados do utilidador
            foreach ($lines as $index => $line) {
                list($stored_username, $stored_mail, $stored_hash) = explode(":", $line);
                //para encontrar a linha a editar
                if ($_SESSION["username"] == $stored_username) {
                    if ($index == count($lines) - 1) { //verifica se é a ultima linha (assim escusa de aumentar um "\n" que estava a causar uma adição de linha vazia cada vez que uma conta era editada)
                        $newLine = $username_to_use . ":" . $mail_to_use . ":" . $stored_hash;
                    } else {
                        $newLine = $username_to_use . ":" . $mail_to_use . ":" . $stored_hash . "\n";
                    }
                    $newHandle = $newHandle . $newLine;
                } else {
                    //caso não seja a linha no user, apenas adiciona a linha á variavel AUX
                    if ($index == count($lines) - 1) {//verifica se é a ultima linha
                        $newHandle = $newHandle . $line;
                    } else {
                        $newHandle = $newHandle . $line . "\n";
                    }
                }
            }

            $newHandle = rtrim($newHandle);//para retirar caracteres como o "\n" do fim da linha

            fclose($handle);

            $handle = fopen("credentials/credentials.txt", "w");

            if ($handle) {
                // Escreve o conteudo atualizado no ficheiro credentials
                fwrite($handle, $newHandle);
                // Fecha o arquivo após a escrita
                fclose($handle);
            } else {
                $_SESSION["errorAlerts"][] = "Erro ao abrir o arquivo para escrita, contacte um Administrador!"; // Adiciona um erro á lista errorAlerts
            }

            //! ERRO AQUI - Por alguma razão, ao eliminar um caracter no email, depois de fazer fwrite, altera os ultimos caracteres do hash
            //!             mas só faz isso na última linha do ficheiro
            //! Solução - Em vez de abrir o ficheiro em modo de leitura e escrita (que alterava o resultado da ultima 
            //!           linha e corrumpia os dados do ficheiro) abro em modo de leitura para ler o ficheiro e fazer todas as verificações,
            //!           e depois abro em modo de escrita (que apaga o conteudo anterior) e escrevo o newHandle no ficheiro em questão.

            // Aqui mudar o nome da pasta para newUsername
            rename("credentials/" . $_SESSION["username"] . "/", "credentials/" . $username_to_use . "/");
            $_SESSION["username"] = $username_to_use;
            $_SESSION["mail"] = $mail_to_use;

            header("Location: settings.php");
            exit();

        } else {
            header("Location: settings.php");
            exit();
        }
    } else {
        $_SESSION["errorAlerts"][] = "Todos os campos têm de estar preenchidos!"; // Adiciona um erro á lista errorAlerts
        header("Location: settings.php");
        exit();
    }
}
?>