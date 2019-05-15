<?php
    ob_start();
    /**
     * Arquivo utilizado para realizar a verificacao e login no sistema.
     */
    require_once "conectaBanco.php";

    $emailLogin = $_POST['emailLogin'];
    $senha = $_POST['senhaLogin'];

    $senha = md5($senha);
    
    $select = "SELECT * 
                    FROM tb_usuario 
                        WHERE cd_email='$emailLogin' 
                            AND cd_senha='$senha'";

    $querySelect = $con->query($select);
    $linhaSelect = $querySelect->fetchAll();

    $numLinhas = sizeof($linhaSelect);

    if($numLinhas == 0){
        $con = null;
        header("Location: index.php?Erro=1");
    }else{
    
        foreach($linhaSelect as $dados){
            $nome = $dados['nm_usuario'];

            setcookie("nomeCompleto",$nome); // Nome completo 

            $firstName = explode(" ", $nome);
            setcookie("usuarioNome",$firstName[0]); // Apenas o primeiro nome
        }

        setcookie("usuarioEmail",$emailLogin);
        setcookie("usuarioSenha",$senha);

        $con = null;
        
        header("Location: principal.php");
    }
    
    ob_end_flush();
?>