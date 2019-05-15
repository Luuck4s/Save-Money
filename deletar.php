<?php 

/**
 * Arquivo que recebe o id da receita/despesa que vem do excluir e realiza o delete
 */

    include "validaCookie.php";
    include "conectaBanco.php";

    $usuarioEmail = $_COOKIE["usuarioEmail"];
    $idValor = $_GET["id"];

    $delete = "DELETE FROM tb_valores 
                    WHERE cd_email_usuario = '$usuarioEmail' 
                        AND id_valor = '$idValor'";

    $query = $con->exec($delete);

    $con = null;

    header("Location: ExcluirOutra.php");
?>