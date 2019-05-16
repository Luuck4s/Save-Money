<?php
/**
 * Arquivo utilizado para pegar os valores atraves de um formulario e enviar para realizar a inserção no banco.
*/

include_once "validaCookie.php";

ob_start();
$tipo = $_GET["tipo"];

date_default_timezone_set("America/Sao_Paulo"); 

$anoAtual = date("Y");
$mesAtual = date("m");
$arrayMeses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto','Setembro', 'Outubro', 'Novembro', 'Dezembro']; 

$tipoCrip = $tipo;

/**
 * Pego o valor que esta criptografado e realizado a conversao para poder salvar no banco
 */
if($tipo == md5("R")){
    $tipo = "R";
}else{
    $tipo = "D";
}

/**
 * $tempoM, $tempoT and $tempoP - cria uma criptografia a letra M, T e P que vai como paramentro para o grafico e define qual valores deve mostar
 */
$tempoT = md5("T");
$tempoM = md5("M");
$tempoP = md5("P");

/**
 * $tipoR and $tipoD - cria uma criptografia com a letra R e D que vai como parametro 
 */
$tipoR = md5("R");
$tipoD = md5("D");

/**
 * $qM, $qT and $qP - cria uma criptografia com a letra M, T e P que vai como parametro via get
 */
$qM = md5("M");
$qT = md5("T");
$qP = md5("P");


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
    <script src="js/validatorDate.js"></script>
    <title>Adicionar <?= $titulo ?></title>
</head>
<body>
    <!--NavBar logado-->
    <div>
         <!-- Estrutura Dropdown Desk -->
         <ul id="dropdown1" class="dropdown-content">
            <li>
                <a href="incluir.php?tipo=<?= $tipoR ?>">Receita</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="incluir.php?tipo=<?= $tipoD ?>">Despesa</a>
            </li>
        </ul>
        <!-- Estrutura Dropdown mobile -->
        <ul id="dropdown2" class="dropdown-content">
            <li>
                <a href="incluir.php?tipo=<?= $tipoR ?>">Receita</a></li>
            <li>
                <a href="incluir.php?tipo=<?= $tipoD ?>">Despesa</a>
            </li>
        </ul>

       <!-- Estrutura Dropdown Receitas -->
       <ul id="dropdown3" class="dropdown-content">
            <li>
                <a href="visualizar.php?q=<?= $qT ?>">Receitas e Despesas de <?= $anoAtual ?></a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="visualizar.php?q=<?= $qM ?>">Receitas e Despesas de <?= $arrayMeses[$mesAtual - 1] ?></a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="visualizar.php?q=<?= $qP ?>">Visualização Avançada</a>
            </li>
        </ul>
        <!-- Estrutura Dropdown Receitas Mobile -->
        <ul id="dropdown4" class="dropdown-content">
            <li>
                <a href="visualizar.php?q=<?= $qT ?>">Todas Receitas e Despesas de <?= $anoAtual ?></a>
            </li>
            <li>
                <a href="visualizar.php?q=<?= $qM ?>">Receitas e Despesas de <?= $arrayMeses[$mesAtual - 1] ?></a>
            </li>
            <li>
                <a href="visualizar.php?q=<?= $qP ?>">Visualização Avançada</a>
            </li>
        </ul>

        <!-- Estrutura Dropdown Grafico -->
        <ul id="dropdown5" class="dropdown-content">
            <li>
                <a href="grafico.php?Tempo=<?= $tempoM ?>">Mês de <?= $arrayMeses[$mesAtual - 1] ?></a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="grafico.php?Tempo=<?= $tempoT ?>">Todas Receitas e Despesas de <?= $anoAtual ?></a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="grafico.php?Tempo=<?= $tempoP ?>">Pesquisa Avançada</a>
            </li>
        </ul>
        <!-- Estrutura Dropdown Grafico Mobile -->
        <ul id="dropdown6" class="dropdown-content">
            <li>
                <a href="grafico.php?Tempo=<?= $tempoM ?>">Mês de <?= $arrayMeses[$mesAtual - 1] ?></a>
            </li>
            <li>
                <a href="grafico.php?Tempo=<?= $tempoT ?>">Todas Receitas e Despesas de <?= $anoAtual ?></a>
            </li>
            <li>
                <a href="grafico.php?Tempo=<?= $tempoP ?>">Pesquisa Avançada</a>
            </li>
        </ul>
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
                <a href="index.php">Início
                    <i class="material-icons left">home</i>
                </a>
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
                <a class="dropdown-trigger" href="!#" data-target="dropdown6">Gerar Gráfico
                    <i class="material-icons left">donut_large</i>
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
    <br><br>
    <!--Formulario de entrada -->
    <div class="container">
        <form class="col s12" action="gravar.php" method="POST" onSubmit="return valida_dadosEntrada(this)">
            <!--Valor do tipo de dado -->
            <input type="hidden" name="tipo" value="<?php echo $tipo; ?>"/>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">title</i>
                    <textarea id="tituloArea" class="materialize-textarea"  name="titulo"></textarea>
                    <label for="tituloArea">Nome da <?= $titulo ?></label>
                    <span class="helper-text">O nome da <?= $titulo ?> é para
                        indentificação.</span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">info</i>
                    <textarea id="descricaoArea" class="materialize-textarea" data-length="60" name="descricao"></textarea>
                    <label for="descricaoArea">Descrição (Opcional)</label>
                    <span class="helper-text">Você pode adicionar uma pequena descrição do que foi sua <?= $titulo ?>.</span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">attach_money</i>
                    <input id="icon_valor" placeholder="Valor" class="validate" name="valor" onkeyup="moeda(this);">
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">date_range</i>
                    <input id="icon_date" type="text" class="datepicker" name="data">
                    <label for="icon_date">Data</label>
                    <span class="helper-text" id="dataMessage"></span>
                </div>
            </div>
            <br><br><br>
            <div class="center">
                <button class="btn blue waves-effect waves-light">Adicionar <?= $titulo ?>
                    <i class="material-icons right">add</i>
                </button>
            </div>
        </form>
    </div>
    <br><br><br><br><br><br><br>
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
</body>
</html>
<?php 

ob_end_flush();

?>