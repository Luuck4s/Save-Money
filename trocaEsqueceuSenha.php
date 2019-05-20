<?php 
    /**
     * Arquivo que troca a senha do usuario caso ele esqueça
     */
    ob_start();

    include "conectaBanco.php";

    $email = $_POST['email'];
    $senha = $_POST['senhaNova'];
    $selectSegu = $_POST['selectSegu'];
    $respostaSegu = $_POST['respostaSegu'];

    $senha = md5($senha);
    $respostaSegu = md5($respostaSegu);

    $sql = "SELECT *
                FROM `tb_usuario`
                    WHERE `cd_email` = '$email'
                        AND `cd_pergunta_seguranca` = $selectSegu
                            AND `resposta_seguranca` = '$respostaSegu'";
    
    $query = $con->query($sql);

    $linhasQuery = $query->fetchAll();

    $numLinhas = sizeof($linhasQuery);

    if($numLinhas != 0){
         
        $update = "UPDATE tb_usuario
                        SET cd_senha = '$senha'
                            WHERE cd_email = '$email'";
        
        $execUpdate = $con->exec($update);
        $con = null;

        header("Location: index.php?troca=Y");
    }else{
        
        header("Location: esqueceuSenha.php?Erro=Y");
        $con = null;
        exit;
    }

    ob_end_flush();
?>