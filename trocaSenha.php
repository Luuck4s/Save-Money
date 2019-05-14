<?php 
ob_start();

include "validaCookie.php";
include "conectaBanco.php";

$senhaAtual = $_POST["senhaAtual"];
$senhaNova = $_POST["senhaNova"];

// Criptografando as senhas 
$senhaAtual = md5($senhaAtual);
$senhaNova = md5($senhaNova);

$emailUsuario = $_COOKIE['usuarioEmail'];

$sql = "SELECT * FROM tb_usuario WHERE cd_senha = '$senhaAtual'";

$query = $con->query($sql);

$linhasQuery = $query->fetchAll();

$numLinhas = sizeof($linhasQuery);

if($numLinhas != 0){

    $update = "UPDATE tb_usuario SET cd_senha = '$senhaNova' WHERE cd_email = '$emailUsuario'";
    $execUpdate = $con->exec($update);
    $con = null;
    header("Location: index.php?troca=Y");

}else{
    $con = null;
    header("Location: perfil.php?Erro=Y");
    exit;
}


ob_end_flush();

?>