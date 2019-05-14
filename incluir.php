<?php
ob_start();

/**
 * Arquivo utilizado para pegar os valores atraves de um formulario e enviar para realizar a inserção no banco.
 */

include_once "validaCookie.php";

$tipo = $_GET["tipo"];

if($tipo == "R"){
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
    <title>Adicionar <?= $titulo ?></title>
</head>
<body>
    <!--NavBar logado-->
    <div>
        <nav>
            <div class="nav-wrapper">
                <a href="index.php" class="brand-logo center"><img class="logoNavbar" src="Img/icone.png"
                        alt="img logo navbar"></a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="left hide-on-med-and-down">
                    <li><a href="principal.php"><i class="material-icons left">arrow_back</i></a></li>
                </ul>
                <ul class="right hide-on-med-and-down">
                    <li><a href="perfil.php">Perfil<i class="material-icons right">account_circle</i></a></li>
                    <li><a href="logOut.php">Sair<i class="material-icons right">exit_to_app</i></a></li>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <li><a href="index.php">Início<i class="material-icons left">home</i></a></li>
            <li><a href="perfil.php">Perfil<i class="material-icons left">account_circle</i></a></li>
            <li><a href="logOut.php">Sair<i class="material-icons left">exit_to_app</i></a></li>
        </ul>

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
                <a href="perfil.php">Perfil<i class="material-icons left">account_circle</i></a>
            </li>
            <li>
                <a href="logOut.php">Sair<i class="material-icons left">exit_to_app</i></a>
            </li>
        </ul>
    </div>
    <br><br>
    <!--Formulario de entrada -->
    <div class="container">
        <form class="col s12" action="gravar.php" method="POST" onSubmit="return valida_dados(this)">
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
    </div>
    <br><br><br><br><br><br><br>
    </form>
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
    <script language="javascript">

    function valida_dados(formulario) {

        if (formulario.tituloArea.value == "") {

            document.getElementById("tituloArea").focus();

            return false;
        }
        if (formulario.descricaoArea.value.length > 60) {

            document.getElementById("descricaoArea").focus();

            return false;
        }
        if (formulario.icon_valor.value == "") {

            document.getElementById("icon_valor").focus();

            return false;
        }
        if (formulario.icon_date.value == "") {

            document.getElementById("icon_date").focus();

            var messageDataElement = document.getElementById("dataMessage");
            messageDataElement.innerHTML = "Clique no campo para abrir o calendario.";
            return false;
        }
        return true;
    }
    </script>
    <script>
    //imput descricao
    $(document).ready(function() {
        $('input#input_text, textarea#descricaoArea').characterCounter();
    });

    //imput data
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            i18n: {
                months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                    'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ],
                monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out',
                    'Nov', 'Dez'
                ],
                weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
                weekdaysAbbrev: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
                today: 'Hoje',
                clear: 'Limpar',
                close: 'Pronto',
                labelMonthNext: 'Próximo mês',
                labelMonthPrev: 'Mês anterior',
                labelMonthSelect: 'Selecione um mês',
                labelYearSelect: 'Selecione um ano',
                selectMonths: true,
                selectYears: 15,
                cancel: 'Cancelar',
                clear: 'Limpar'
            }
        });
    });

    //function value
    function moeda(i) {
        var v = i.value.replace(/\D/g, '');
        v = (v / 100).toFixed(2) + '';
        v = v.replace(",", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
        v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
        i.value = v;
    }
    </script>
</body>
</html>
<?php 

ob_end_flush();

?>