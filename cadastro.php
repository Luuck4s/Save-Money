<?php
/**
* Arquivo Utilizado para realizar a verificação e cadastro de novos usuarios.
*/
    ob_start();

    include_once "conectaBanco.php"; 

    $nome = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $selectSegu = $_POST['selectSegu'];
    $respostaSegu = $_POST['respostaSegu'];

    $senha = md5($senha);
    $respostaSegu = md5($respostaSegu);

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
        try{
            $insert = "INSERT INTO tb_usuario
                                (
                                    `cd_email`,
                                    `nm_usuario`,
                                    `cd_senha`,
                                    `cd_pergunta_seguranca`,
                                    `resposta_seguranca`
                                    ) 
                            VALUES 
                                (
                                    '$email',
                                    '$nome',
                                    '$senha',
                                    $selectSegu,
                                    '$respostaSegu'
                                    )";
                        
            $execInsert = $con->exec($insert);
            $con = null;
            header("Location: sucessCadastro.html");
        }catch(PDOException $e){}
        
    }
    
    ob_end_flush();
?>