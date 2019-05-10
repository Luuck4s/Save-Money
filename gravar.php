<?php 
    include_once "validaCookie.php";
    require "conectaBanco.php";

    $usuarioEmail = $_COOKIE["usuarioEmail"];
    $tipo = $_POST["tipo"];
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $valor = $_POST["valor"];
    $data = $_POST["data"];

    if($descricao == ""){
        $descricao = "Sem descrição";
    }
    
    $comandoSQL = "INSERT INTO tb_valores (titulo_valor,tipo_valor,desc_valor,data_valor,vl_valor,cd_email_usuario) VALUES ('$titulo','$tipo','$descricao','$data',$valor,'$usuarioEmail')";

    $query = $con->exec($comandoSQL);

    $con=null;

    
    header("Location: sucessAdd.php?tipo=$tipo");
?>