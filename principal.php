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
        <!-- Estrutura Dropdown Desk -->
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="incluir.php?tipo=R">Receita</a></li>
            <li class="divider"></li>
            <li><a href="incluir.php?tipo=D">Despesa</a></li>
        </ul>
        <!-- Estrutura Dropdown mobile -->
        <ul id="dropdown2" class="dropdown-content">
            <li><a href="incluir.php?tipo=R">Receita</a></li>
            <li><a href="incluir.php?tipo=D">Despesa</a></li>
        </ul>

        <!-- Estrutura Dropdown Receitas -->
        <ul id="dropdown3" class="dropdown-content">
            <li><a href="visualizar.php?q=T">Receitas e Despesas</a></li>
            <li class="divider"></li>
            <li><a href="visualizar.php?q=M">Receitas e Despesas deste mês</a></li>
        </ul>
        <!-- Estrutura Dropdown Receitas Mobile -->
        <ul id="dropdown4" class="dropdown-content">
            <li><a href="visualizar.php?q=T">Receitas e Despesas</a></li>
            <li><a href="visualizar.php?q=M">Receitas e Despesas deste mês</a></li>
        </ul>


        <!-- Estrutura Dropdown Grafico -->
        <ul id="dropdown5" class="dropdown-content">
            <li><a href="grafico.php?Tempo=M">Mês Atual</a></li>
            <li class="divider"></li>
            <li><a href="grafico.php?Tempo=T">Todas Receitas e Despesas</a></li>
        </ul>
        <!-- Estrutura Dropdown Grafico Mobile -->
        <ul id="dropdown6" class="dropdown-content">
            <li><a href="grafico.php?Tempo=M">Mês Atual</a></li>
            <li><a href="grafico.php?Tempo=T">Todas Receitas e Despesas</a></li>
        </ul>
        <!-- NavBar -->
        <nav>
            <div class="nav-wrapper">
                <a href="principal.php" class="brand-logo center"><img class="logoNavbar" src="Img/icone.png"
                        alt="img logo navbar"></a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="left hide-on-med-and-down">
                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="dropdown1">Adicionar<i class="material-icons left">add</i></a>
                    </li>
                    <li>
                        <a class="dropdown-trigger" href="!#" data-target="dropdown3">Visualizar<i class="material-icons left">pageview</i></a>
                    </li>
                    <li>
                        <a class="dropdown-trigger" href="!#" data-target="dropdown5">Gerar Gráfico<i class="material-icons left">donut_large</i></a>
                    </li>
                    <li>
                        <a href="excluir.php">Excluir Receita ou Despesa<i class="material-icons left">delete_sweep</i></a>
                    </li>
                </ul>
                <ul class="right hide-on-med-and-down">
                    <li><a href="perfil.php">Perfil<i class="material-icons right">account_circle</i></a></li>
                    <li><a href="logOut.php">Sair<i class="material-icons right">exit_to_app</i></a></li>
                </ul>
            </div>
        </nav>

        <!-- sidenav mobile -->
        <ul id="slide-out" class="sidenav">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="Img/specs.svg">
                    </div>
                    <a href="perfil.php"><img class="circle" src="Img/wallet.svg"></a>
                    <a href="#!"><span class="black-text name"><?= $_COOKIE['nomeCompleto'] ?></span></a>
                    <a href="#!"><span class="black-text email"><?= $_COOKIE['usuarioEmail'] ?></span></a>
                </div>
            </li>
            <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown2">Adicionar<i class="material-icons left">add</i></a>
            </li>
            <li>
                <a class="dropdown-trigger" href="!#" data-target="dropdown4">Visualizar<i class="material-icons left">pageview</i></a>
            </li>
            <li>
                <a class="dropdown-trigger" href="!#" data-target="dropdown6">Gerar Gráfico<i class="material-icons left">donut_large</i></a>
            </li>
            <li>
                <a href="excluir.php">Excluir Receita ou Despesa<i class="material-icons left">delete_sweep</i></a>
            </li>
            <li>
                <div class="divider"></div>
            </li>
            <li>
                <a href="perfil.php">Perfil<i class="material-icons left">account_circle</i></a>
            </li>
            <li>
                <a href="logOut.php">Sair<i class="material-icons left">exit_to_app</i></a>
            </li>
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
                    <img src="Img/teasure.svg" alt="undraw savings fail">
                    <div class="caption center-align">
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

                <h5 class="center black-text"><?= $arrayMeses[$mesAtual - 1] ?></h5>
                    
                <div class="container">
                    <h1 class="light center black-text">R$ <?= number_format(ver_saldo(), 2 ,',', '.'); ?></h1>
                </div>
            </div>
            <div class="parallax"><img src="Img/tesouro.svg" alt="Unsplashed background img 1"></div>
        </div>
    </div>
    <br>
    <!--Ultima receita-->
    <div class="container">
        <div class="row">
            <div class="col s12 m6">
                <center>
                    <span class="light">A sua última receita deste mês</span>
                </center>
                <div class="card blue darken-3">
                    <div class="card-content white-text">
                    <?php
                     /**
                     * Realizando a busca no banco para pegar a ultima receita adicionada no mes atual.
                     */
                        require "conectaBanco.php";

                        $usuarioEmail = $_COOKIE["usuarioEmail"];

                        $sql = "SELECT titulo_valor,DATE_FORMAT(data_valor,'%d/%m/%Y') as 'data_valor',desc_valor,vl_valor FROM tb_valores WHERE cd_email_usuario = '$usuarioEmail' AND
                        extract(month from data_valor) = $mesAtual AND tipo_valor = 'R' ORDER BY id_valor DESC LIMIT 1";

                        $querySelect = $con->query($sql);
                        $linhaSelect = $querySelect->fetchAll();
                        
                        foreach($linhaSelect as $dadosReceita):
                    ?>
                        <span class="center card-title"><?= $dadosReceita['titulo_valor'] ?></span>
                        <p class="light right"><?= $dadosReceita['data_valor'] ?></p>
                        <hr>
                        <p class="light" ><?= $dadosReceita['desc_valor'] ?></p>
                        <p class="light center">Valor: R$ <?= number_format($dadosReceita['vl_valor'], 2 ,',', '.'); ?></p>
                    <?php
                        endforeach;
                        $con = null;
                    ?>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <center>
                    <span class="light">A sua última despesa deste mês</span>
                </center>
                <div class="card blue darken-3">
                    <div class="card-content white-text">
                    <?php
                     /**
                     * Realizando a busca no banco para pegar a ultima despesa adicionada no mes atual.
                     */
                        require "conectaBanco.php";

                        $usuarioEmail = $_COOKIE["usuarioEmail"];

                        $sql = "SELECT titulo_valor,DATE_FORMAT(data_valor,'%d/%m/%Y') as 'data_valor',desc_valor,vl_valor FROM tb_valores 
                        WHERE cd_email_usuario = '$usuarioEmail' AND extract(month from data_valor) = $mesAtual AND tipo_valor = 'D' 
                        ORDER BY id_valor DESC LIMIT 1";

                        $querySelect = $con->query($sql);
                        $linhaSelect = $querySelect->fetchAll();
                        
                        foreach($linhaSelect as $dadosDespesa):
                    ?>
                        <span class="center card-title"><?= $dadosDespesa['titulo_valor'] ?></span>
                        <p class="light right"><?= $dadosDespesa['data_valor'] ?></p>
                        <hr>
                        <p class="light"><?= $dadosDespesa['desc_valor'] ?></p>
                        <p class="light center">Valor: R$ <?= number_format($dadosDespesa['vl_valor'], 2 ,',', '.'); ?></p>
                    <?php
                        endforeach;
                        $con = null;
                    ?>
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

        //dropdown
        $(".dropdown-trigger").dropdown();

        //sidenav
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
        
    </script>

</body>
</html>

<?php

ob_end_flush();

?>