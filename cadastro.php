<?php
    ob_start();

    include_once "conectaBanco.php";

    $nome = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['password'];


    $select = "SELECT * FROM tb_usuario WHERE cd_email='$email'";

    $querySelect = $con->query($select);
    $linhaSelect = $querySelect->fetchAll();

    $numLinhas = sizeof($linhaSelect);

    if($numLinhas != 0){
        header("Location: erroCadastro.html");
        $con = null;
    }

    
    ob_end_flush();
?>