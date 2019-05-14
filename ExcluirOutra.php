<?php
/**
 * Pagina para perguntar se deseja excluir outra despesa ou receita.
 */
include "validaCookie.php";

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
    <title>Excluir Outra</title>
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
        <!-- NavBar -->
        <nav>
            <div class="nav-wrapper">
                <a href="principal.php" class="brand-logo center"><img class="logoNavbar" src="Img/icone.png"
                        alt="img logo navbar"></a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="left hide-on-med-and-down">
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Adicionar<i
                                class="material-icons right">add</i></a></li>
                    <li>
                        <a class="dropdown-trigger" href="!#" data-target="dropdown3">Visualizar<i class="material-icons left">pageview</i></a>
                    </li>
                    <li><a href="excluir.php">Excluir Receita ou Despesa<i
                                class="material-icons right">delete_sweep</i></a></li>

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
                    <a href="perfil.php"><img class="circle" src="Img/proffile.svg"></a>
                    <a href="#!"><span class="black-text name"><?= $_COOKIE['nomeCompleto'] ?></span></a>
                    <a href="#!"><span class="black-text email"><?= $_COOKIE['usuarioEmail'] ?></span></a>
                </div>
            </li>
            <li>
                <a href="index.php">Início<i class="material-icons left">home</i></a>
            </li>
            <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown2">Adicionar<i
                        class="material-icons left">add</i></a>
            </li>
            <li>
                <a class="dropdown-trigger" href="!#" data-target="dropdown4">Visualizar<i class="material-icons left">pageview</i></a>
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

    <!-- Message Sucess -->
    <div class="container">
        <h5 class="center">Pronto, o que você escolheu foi excluido com sucesso!</h5>
        <br>
        <center>
            <a href="excluir.php">
                <button class="btn blue darken-3 waves-effect waves-light">Excluir Outra <i class="material-icons right">delete</i>
                </button>
            </a>
            <a href="index.php">
                <button class="btn blue darken-3 waves-effect waves-light"><i class="material-icons center">home</i>
                </button>
            </a>
            <br><br><br>
            <div>
                <img class="responsive-img" src="Img/insert block.svg" width="500" alt="insert block img fail">
            </div>
        </center>
    </div>    

    <script type="text/javascript">
    
        //drop down
        $(".dropdown-trigger").dropdown();

        //sidenav
        $(document).ready(function() {
            $('.sidenav').sidenav();
        });

    </script>

</body>

</html>