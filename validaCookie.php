<?php
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
    require "conectaBanco.php";

    $select = "SELECT * FROM tb_usuario WHERE cd_email='$emailLogin' AND cd_senha='$senha'";

    $querySelect = $con->query($select);
    $linhaSelect = $querySelect->fetchAll();

    $numLinhas = sizeof($linhaSelect);

	if($numLinhas == 0){

        $con = null;
        header("Location: erroGenerics.html");
        exit;
    }
}
else
{
    header("Location: erroGenerics.html");
    exit;
}

$con = null;
ob_end_flush();
?>
