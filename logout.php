<?php
session_start();

date_default_timezone_set('Europe/Lisbon');
$timestamp = time();
$currentDate = date('Y-m-d H:i', $timestamp);

// Linha a ser adicionada
$history_newLine = "\nLogOut:#:" . gethostname() . ":#:" . $currentDate;
// Adiciona a linha ao final do arquivo
file_put_contents("credentials/" . $_SESSION["username"] . "/historico.txt", $history_newLine, FILE_APPEND);

session_destroy();
header("Location: signin.php");
exit();
?>