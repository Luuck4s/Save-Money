<?php 
/**
 * Arquivo de logout 
 */

    ob_start();
    
    setcookie("usuarioEmail");
    setcookie("usuarioSenha");
    setcookie("usuarioNome");
    setcookie("nomeCompleto");
    
    header ("Location: index.php");
    
    ob_end_flush();
?>