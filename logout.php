<?php 
    ob_start();

    setcookie("usuarioEmail");
    setcookie("usuarioSenha");
    setcookie("usuarioNome");

    header ("Location: index.html");
    
    ob_end_flush();
?>