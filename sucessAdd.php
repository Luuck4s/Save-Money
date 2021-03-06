<?php
/**
 * Pagina que exibe em tela uma mensagem de sucesso ao adicionar uma receita ou despesa
 */ 
include_once "validaCookie.php";

$tipo = $_GET["tipo"];

$tipoCrip = $tipo;

if($tipo == md5("R")){
    $tipo = "R";
}else{
    $tipo = "D";
}

if($tipoCrip == md5("R")){
    $titulo = "Receita";
}else{
    $titulo = "Despesa";
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="Img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="Img/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <title>Sucesso</title>
</head>

<body>
    <!--NavBar-->
    <div>
        <nav>
            <div class="nav-wrapper">
                <a href="index.php" class="brand-logo center"><img class="logoNavbar" src="Img/icone.png" alt="img logo navbar"></a>
            </div>
        </nav>
    </div>

    <!-- Message Sucess -->
    <div class="container">
        <h5 class="center">Cadastro de <?= $titulo ?> realizado com sucesso.</h5>
        <h6 class="center">Caso deseja inserir outra <?= $titulo ?>, clique no botão abaixo.</h6>
        <br>
        <center>
            <a href="incluir.php?tipo=<?= $tipoCrip ?>">
                <button class="btn blue darken-3 waves-effect waves-light">Inserir outra <?= $titulo ?>
                    <i class="material-icons right">add_circle_outline</i>
                </button>
            </a>
            <a href="index.php">
                <button class="btn blue darken-3 waves-effect waves-light">
                    <i class="material-icons center">home</i>
                </button>
            </a>
            <br><br><br>
            <div>
                <img class="responsive-img" src="Img/all data.svg" width="500" alt="done img fail">
            </div>
        </center>
    </div>

    <!-- Footer-->
    <br><br><br><br><br>
    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Save Money</h5>
                    <p class="grey-text text-lighten-4">“ A única maneira de fazer um excelente trabalho é amar o que
                        você faz. Se ainda não encontrou, continue procurando. ” - Steve Jobs</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <ul>
                        <li>
                            <a class="grey-text text-lighten-3" href="index.php">Início</a>
                        </li>
                        <li>
                            <a class="grey-text text-lighten-3" href="contato.html">Contato</a>
                        </li>
                        <li>
                            <a class="grey-text text-lighten-3" href="termosDeUso.html">Termos de uso</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="center container">
                Save Money © 2019
            </div>
        </div>
    </footer>
</body>

</html>