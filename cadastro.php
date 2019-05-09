<?php
    ob_start();

    include_once "conectaBanco.php";

    $nome = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['password'];


    $select = "SELECT * FROM tb_usuario WHERE cd_email='$email'";

    $querySelect = mysqli_query($con,$select);

    $linhaSelect = mysqli_num_rows($querySelect);

    if($linhaSelect != 0){
        header("Location: erroCadastro.html");
        mysqli_close($con);
    }

    ob_end_flush();
?>