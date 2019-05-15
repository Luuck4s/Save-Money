<?php
/**
 * Verifica se o usuario esta logado, apenas utilizado na pagina inicial para realizar o 
 * redirecionamento quando o usuario estiver logado.
 */

ob_start();
date_default_timezone_set("America/Sao_Paulo"); 

if(IsSet($_COOKIE["usuarioEmail"])){
    $emailLogin = $_COOKIE["usuarioEmail"];
}
    
if(IsSet($_COOKIE["usuarioSenha"])){
    $senha = $_COOKIE["usuarioSenha"];
}

if(!(empty($emailLogin) OR empty($senha)))
{
    include "conectaBanco.php";

    $select = "SELECT cd_email,cd_senha 
                    FROM tb_usuario 
                        WHERE cd_email='$emailLogin' 
                            AND cd_senha='$senha'";

    $querySelect = $con->query($select);
    $linhaSelect = $querySelect->fetchAll();

    $numLinhas = sizeof($linhaSelect);

	if($numLinhas != 0){

        $con = null;
        header("Location: principal.php");
        exit;
    }
}


$con = null;
ob_end_flush();

?>