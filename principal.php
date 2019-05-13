<?php 
/**
 * Pagina que o usuario tem acesso quando logado.
 */
ob_start();
date_default_timezone_set("America/Sao_Paulo"); 

include "validaCookie.php";

include "verSaldo.php";


$arrayMeses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
'Setembro', 'Outubro', 'Novembro', 'Dezembro']; 

$mesAtual = date("m");


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
    <title>Save Money</title>
</head>

<body>
    <!--NavBar logado-->
    <div>
        <!-- Estrutura Dropdown -->
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="incluir.php?tipo=R">Receita</a></li>
            <li class="divider"></li>
            <li><a href="incluir.php?tipo=D">Despesa</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper">
                <a href="principal.php" class="brand-logo center"><img class="logoNavbar" src="Img/icone.png"
                        alt="img logo navbar"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="left hide-on-med-and-down">
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Adicionar<i class="material-icons right">add</i></a></li>
                    <li><a href="!#">Visualizar Receitas e Despesas<i class="material-icons right">pageview</i></a></li>
                    <li><a href="!#">Excluir Receita ou Despesa<i class="material-icons right">delete_sweep</i></a></li>
                    
                </ul>
                <ul class="right hide-on-med-and-down">
                    <li><a href="logOut.php">Sair<i class="material-icons right">exit_to_app</i></a></li>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <li><a href="incluir.php?tipo=D">Adicionar Despesa</a></li>
            <li><a href="incluir.php?tipo=R">Adicionar Receita</a></li>
            <li><a href="!#">Visualizar Receitas e Despesas</a></li>
            <li><a href="!#">Excluir Receita ou Despesa</a></li>
            <li><a href="logOut.php">Sair</a></li>
        </ul>
    </div>

    <!--Container Slide -->
    <div class="container.fluid">
        <div class="slider">
            <ul class="slides">
                <li>
                    <img src="Img/financial_data.svg" alt="undraw savings fail">
                    <div class="caption center-align">
                        <!--Pega o valor do cookie que esta armazenado o nome usuario -->
                        <h3>Olá, <?= $_COOKIE["usuarioNome"]; ?> </h3>
                    </div>
                </li>
                <li>
                    <img src="Img/calculator.svg" alt="finance fail">
                    <div class="caption left-align">
                            <h3 class="black-text">Aproveite o Save Money</h3>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!--parallax com saldo atual-->
    <div>
        <div id="index-bannerS" class="parallax-container">
            <div class="section no-pad-bot">

                <h5 class="center black-text">Saldo de <?= $arrayMeses[$mesAtual - 1] ?></h5>
                    
                <div class="container">
                    <h1 class="light center black-text">R$ <?= number_format(ver_saldo(), 2 ,',', '.'); ?></h1>
                </div>
            </div>
            <div class="parallax"><img src="Img/interface.svg" alt="Unsplashed background img 1"></div>
        </div>
    </div>
    <br>
    <!--Ultimas despesas-->
    <div class="container">
        <div class="row">
            <div class="col s12 m6">
                <center>
                    <span>Última Receita</span>
                </center>
                <div class="card blue darken-3">
                    <div class="card-content white-text">
                        <span class="center card-title"><?php echo "Salário" ?> </span>
                        <hr>
                        <p class="center"><?php echo "05/04/2019" ?> </p>
                        <p><?php echo "Sem Descrição" ?></p>
                        <hr>
                        <p class="center">Valor: R$ <?php echo "1.500,30"; ?></p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <center>
                    <span>Última Despesa</span>
                </center>
                <div class="card blue darken-3">
                    <div class="card-content white-text">
                        <span class="center card-title"><?php echo "Pão" ?> </span>
                        <hr>
                        <p class="center"><?php echo "08/04/2019" ?> </p>
                        <p><?php echo "Sem Descrição" ?></p>
                        <hr>
                        <p class="center">Valor: R$ <?php echo "20,30"; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Action part-->
    <div class="container">
        <div class="row">
            <h4 class="light center">Adicione uma Despesa ou uma Receita.</h4>
        </div>

        <div class="row">
            <div class="col s12 m6">
                <div class="hoverable card blue darken-3">
                    <div class="center card-content white-text">
                        <span class="card-title">Receitas</span>
                        <hr>
                        <p class="light">Receita é a entrada monetária, ou seja, toda entrada de monetária é uma receita, por
                            exemplo seu salário e etc.</p>
                    </div>
                    <div class="card-action">
                        <center>
                            <a href="incluir.php?tipo=R"><button
                                    class="waves-effect waves-light btn-small blue darken-2">Adicionar uma
                                    Receita</button></a>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="hoverable card blue darken-3">
                    <div class="center card-content white-text">
                        <span class="card-title">Despesas</span>
                        <hr>
                        <p class="light">Despesa é a saída monetária, ou seja, toda saída de monetária é uma receita, por exemplo:
                            conta de luz, conta de água e etc.</p>
                    </div>
                    <div class="card-action">
                        <center>
                            <a href="incluir.php?tipo=D"><button
                                    class="waves-effect waves-light btn-small blue darken-2">Adicionar uma
                                    Despesa</button></a>
                        </center>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Footer-->
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
                        <li><a class="grey-text text-lighten-3" href="index.php">Início</a></li>
                        <li><a class="grey-text text-lighten-3" href="contato.html">Contato</a></li>
                        <li><a class="grey-text text-lighten-3" href="termosDeUso.html">Termos de uso</a></li>
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

    <script type="text/javascript">
    //Slides
    $(document).ready(function() {
        $('.slider').slider({
            full_width: true
        });
    });

    //drop down
    $(".dropdown-trigger").dropdown();
    </script>

</body>
</html>

<?php

ob_end_flush();

?>