<?php
/**
* Arquivo Utilizado para realizar a verificação e cadastro de novos usuarios.
*/
    ob_start();

    include_once "conectaBanco.php"; 

    $nome = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $senha = md5($senha);

    $select = "SELECT * 
                    FROM tb_usuario 
                        WHERE cd_email='$email'";

    $querySelect = $con->query($select);
    $linhaSelect = $querySelect->fetchAll();

    $numLinhas = sizeof($linhaSelect);

    if($numLinhas != 0){
        $con = null;
        header("Location: index.php?Erro=2");
    }else{
        
        $insert = "INSERT INTO tb_usuario
                                (
                                    cd_email,
                                    nm_usuario,
                                    cd_senha) 
                            VALUES 
                                (
                                    '$email',
                                    '$nome',
                                    '$senha')";
                        
        $execInsert = $con->exec($insert);
        $con = null;
        header("Location: sucessCadastro.html");
    }
    
    ob_end_flush();
?>