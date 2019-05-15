<?php 
ob_start();

include "validaCookie.php";

date_default_timezone_set("America/Sao_Paulo"); 

$mesAtual = date("m");
$arrayMeses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto','Setembro', 'Outubro', 'Novembro', 'Dezembro']; 

?>
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
    <title>Perfil</title>
</head>

<body>
    <!--NavBar logado-->
    <div>
        <!-- Estrutura Dropdown Desk -->
        <ul id="dropdown1" class="dropdown-content">
            <li>
                <a href="incluir.php?tipo=R">Receita</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="incluir.php?tipo=D">Despesa</a>
            </li>
        </ul>
        <!-- Estrutura Dropdown mobile -->
        <ul id="dropdown2" class="dropdown-content">
            <li>
                <a href="incluir.php?tipo=R">Receita</a>
            </li>
            <li>
                <a href="incluir.php?tipo=D">Despesa</a>
            </li>
        </ul>
        <!-- Estrutura Dropdown Receitas -->
        <ul id="dropdown3" class="dropdown-content">
            <li>
                <a href="visualizar.php?q=T">Todas Receitas e Despesas</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="visualizar.php?q=M">Receitas e Despesas de <?= $arrayMeses[$mesAtual - 1] ?></a>
            </li>
        </ul>

        <!-- Estrutura Dropdown Receitas Mobile -->
        <ul id="dropdown4" class="dropdown-content">
            <li>
                <a href="visualizar.php?q=T">Todas Receitas e Despesas</a>
            </li>
            <li>
                <a href="visualizar.php?q=M">Receitas e Despesas de <?= $arrayMeses[$mesAtual - 1] ?></a>
            </li>
        </ul>
        <!-- NavBar -->
        <nav>
            <div class="nav-wrapper">
                <a href="principal.php" class="brand-logo center">
                    <img class="logoNavbar" src="Img/icone.png" alt="img logo navbar">
                </a>
                <a href="#" data-target="slide-out" class="sidenav-trigger">
                    <i class="material-icons">menu</i>
                </a>
                <ul class="left hide-on-med-and-down">
                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="dropdown1">Adicionar
                            <i class="material-icons left">add</i>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-trigger" href="!#" data-target="dropdown3">Visualizar
                            <i class="material-icons left">pageview</i>
                        </a>
                    </li>
                    <li>
                        <a href="excluir.php">Excluir Receita ou Despesa
                            <i class="material-icons left">delete_sweep</i>
                        </a>
                    </li>

                </ul>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a href="perfil.php">Perfil
                            <i class="material-icons right">account_circle</i>
                        </a>
                    </li>
                    <li>
                        <a href="logOut.php">Sair
                            <i class="material-icons right">exit_to_app</i>
                        </a>
                    </li>
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
                    <a href="perfil.php">
                        <img class="circle" src="Img/wallet.svg">
                    </a>
                    <a href="#!">
                        <span class="black-text name"><?= $_COOKIE['nomeCompleto'] ?></span>
                    </a>
                    <a href="#!">
                        <span class="black-text email"><?= $_COOKIE['usuarioEmail'] ?></span>
                    </a>
                </div>
            </li>
            <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown2">Adicionar
                    <i class="material-icons left">add</i>
                </a>
            </li>
            <li>
                <a class="dropdown-trigger" href="!#" data-target="dropdown4">Visualizar
                    <i class="material-icons left">pageview</i>
                </a>
            </li>
            <li>
                <a href="excluir.php">Excluir Receita ou Despesa
                    <i class="material-icons left">delete_sweep</i>
                </a>
            </li>
            <li>
                <div class="divider"></div>
            </li>
            <li>
                <a href="perfil.php">Perfil
                    <i class="material-icons left">account_circle</i>
                </a>
            </li>
            <li>
                <a href="logOut.php">Sair
                    <i class="material-icons left">exit_to_app</i>
                </a>
            </li>
        </ul>
    </div>
    <br>
    <!-- Informações do usuario atual --->
    <div class="container">
        <center>
            <img class="circle responsive-img" src="Img/wallet.svg" width="250" alt="proffile img fail">
        </center>
        <br>
        <div class="container">
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <input disabled value="<?= $_COOKIE['nomeCompleto'] ?>" id="disabledNome" type="text" class="validate" />
                <label for="disabledNome">Nome</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <input disabled value="<?= $_COOKIE['usuarioEmail'] ?>" id="disabled" type="text" class="validate" />
                <label for="disabled">Email</label>
            </div>
            <center>
                <span>Alterar Senha</span>
            <center>
            <form class="col s12" name="formulario" action="trocaSenha.php" method="POST" onSubmit="return valida_dadosAlteSenha(this)">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock_outline</i>
                        <input id="passwordAnt" type="password" name="senhaAtual" class="validate">
                        <label for="passwordAnt">Senha Atual</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">enhanced_encryption</i>
                        <input id="passwordNew" type="password" name="senhaNova" class="validate">
                        <label for="passwordNew">Nova Senha</label>
                    </div>
                </div>
                <div class="center">
                    <button class="btn blue waves-effect waves-light darken-2">Alterar Senha
                        <i class="material-icons right">arrow_forward</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <br><br>
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

    <script type="text/javascript">
    //dropdown
    $(".dropdown-trigger").dropdown();

    //sidenav
    $(document).ready(function() {
        $('.sidenav').sidenav();
    });

    //Valida campos do alterar Senha
    function valida_dadosAlteSenha(formulario) {
            if (formulario.passwordAnt.value == "" || formulario.passwordAnt.value.length < 4) {

                document.getElementById("passwordAnt").focus();
                return false;
            }
            if (formulario.passwordNew.value == "" || formulario.passwordNew.value.length < 4) {

                document.getElementById("passwordNew").focus();
                return false;
        }
        return true;
    }
    </script>

</body>

</html>

<?php
@$Erro = $_GET["Erro"];


if($Erro == 'Y'){
    ?>
    <script>
        M.toast({html: 'A senha informada está incorreta !'});
    </script>
    
    <?php 
}


ob_end_flush();

?>