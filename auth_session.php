<?php
   session_start();
   // session_destroy();
   
   if (!isset($_SESSION['username'])) {
       header("Location: signin.php");
       exit();
   }else{
       //verificação para destruir a sessão após 10 minutos (600 segundos)
       if ((time()-$_SESSION['last_login_timestamp']) > 600) {
           header("Location: logout.php");
           exit();
       }
   }