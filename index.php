<?php
    require_once "validaLogin.php";

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
    <!--NavBar-->
    <div>
        <nav>
            <div class="nav-wrapper">
                <a href="index.php" class="brand-logo center"><img class="logoNavbar" src="Img/icone.png"
                        alt="img logo navbar"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a class="waves-effect waves-light modal-trigger" href="#cadastro">Cadastrar<i class="material-icons right">add_box</i></a></li>
                    <li><a class="waves-effect waves-light modal-trigger" href="#login">Acessar sua conta<i class="material-icons right">account_circle</i></a></li>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <li><a class="waves-effect waves-light modal-trigger" href="#cadastro">Cadastrar<i class="material-icons left">add_box</i></a></li>
            <li><a class="waves-effect waves-light modal-trigger" href="#login">Acessar sua conta<i class="material-icons left">account_circle</i></a></li>
        </ul>
    </div>

    <!--Modal Cadastro-->
    <div id="cadastro" class="modal">
        <div class="modal-content">
            <div class="row">
                <div class="center">
                    <i class="medium material-icons">add_box</i>
                </div>
                <form class="col s12" action="cadastro.php" method="POST" name="formularioCadastro"
                    onSubmit="return valida_dadosCadastro(this)">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="name" type="text" name="name" class="validate">
                            <label for="name">Nome</label>
                            <span class="helper-text" id="messagemNome"></span>
                        </div>
                        <div class="input-field col s6">
                            <input id="password" type="password" name="password" class="validate">
                            <label for="password">Senha</label>
                            <span class="helper-text" id="messagemSenha"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" name="email" class="validate">
                            <label for="email">Email</label>
                            <span class="helper-text" id="messagemEmail"></span>
                        </div>
                    </div>
                    <div class="center">
                        <button class="btn blue waves-effect waves-light">Cadastrar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="center">Ao se cadastrar você concorda com os <a href="termosDeUso.html">Termos de Uso e Políticas
                    de Privacidade.</a></p>
            </div>
        </div>
    </div>

    <!--Modal Login-->
    <div id="login" class="modal">
        <div class="modal-content">
            <div class="row">
                <div class="center">
                    <i class="medium material-icons">account_circle</i>
                </div>
                <form class="col s12" action="login.php" method="POST" name="formularioLogin"
                    onSubmit="return valida_dados(this)">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="emailLogin" type="email" class="validate" name="emailLogin">
                            <label for="emailLogin">Email</label>
                            <span class="helper-text" id="messagemEmailLogin"></span>
                        </div>
                        <div class="input-field col s6">
                            <input id="passwordLogin" type="password" class="validate" name="senhaLogin">
                            <label for="passwordLogin">Senha</label>
                            <span class="helper-text" id="messagemSenhaLogin"></span>
                        </div>
                    </div>
                    <div class="center">
                        <button class="btn blue waves-effect waves-light">Acessar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--initial slides -->
    <div class="container.fluid">
        <div class="slider">
            <ul class="slides">
                <li>
                    <img src="Img/undraw_savings.svg" alt="undraw savings fail">
                    <div class="caption center-align">
                        <h3>Bem vindo ao Save Money</h3>
                        <h5 class="light grey-text text-lighten-3">Controle os seus gastos agora!</h5>
                    </div>
                </li>
                <li>
                    <img src="Img/financial_data.svg" alt="financial data fail">
                    <div class="caption left-align">
                        <h2>Tenha o controle do seu Money.</h2>
                    </div>
                </li>
                <li>
                    <img src="Img/word.svg" alt="projection fail">
                    <div class="caption right-align">
                        <h2>Juntos podemos economizar.</h2>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- icon row-->
    <div class="row">
        <div class="col s12 m6">
            <div class="icon-block">
                <h2 class="center blue-text"><i class="material-icons">attach_money</i></h2>
                <h4 class="center">Tempo é dinheiro</h4>
                <p class="flow-text">Aqui você vai organizar sua vida financeira e saber para onde está indo seu
                    dinheiro de maneira prática e rapida sem enrolação.
                </p>
            </div>
        </div>

        <div class="col s12 m6">
            <div class="icon-block">
                <h2 class="center blue-text"><i class="material-icons">phonelink</i></h2>
                <h4 class="center">Chega de planilhas</h4>
                <p class="flow-text">O tempo de usar cadernos e planilhas complicadas e bagunçadas acabou, tenha o
                    controle total de suas vida financeira de forma online e a qualquer momento.</p>
            </div>
        </div>
    </div>
    <!-- Paralax-->
    <div id="index-banner" class="parallax-container">
        <div class="section no-pad-bot">
            <div class="container">
                <h1 class="header center white-text ">Alcance Suas Metas</h1>
            </div>
        </div>
        <div class="parallax"><img src="Img/projection.svg" alt="Unsplashed background img 1"></div>
    </div>
    <br><br>

    <!-- container -->
    <div class="container">
        <div class="row">
            <div class="col m8">
                <h4>Quem não quer que sobre uma graninha no final do mês ne ? </h4>
                <p class="flow-text">O Save Money vai te ajudar com isso de maneira prática e fácil, e além disso
                    todas as funcionalidades são gratuitas. Crie sua conta agora mesmo e comece a utilizar o sistema, e
                    caso curta compartilha com seus amigos.</p>
            </div>
            <div class="col m4">
                <img src="Img/Graf.gif" class="responsive-img">
            </div>
        </div>
    </div>

    <!-- Paralax-->
    <div id="index-banner" class="parallax-container">
        <div class="section no-pad-bot">
            <div class="container">
                <h2 class="header center white-text ">Juntos podemos mais.</h2>
            </div>
        </div>
        <div class="parallax"><img src="Img/productive.svg" alt="Unsplashed background img 1"></div>
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
        $(document).ready(function () {
            $('.slider').slider({ full_width: true });
        });
        //Paralax
        $(document).ready(function () {
            $('.parallax').parallax();
        });
        //Modal
        $(document).ready(function () {
            $('.modal').modal();
        });
        //Formulario
        function valida_dados(formulario) {
            if (formulario.emailLogin.value == "") {

                document.getElementById("emailLogin").focus();

                var messageEmailElementLogin = document.getElementById("messagemEmailLogin");
                messageEmailElementLogin.innerHTML = "Digite o seu Email.";
                
                return false;
            }
            if (formulario.passwordLogin.value == "") {

                document.getElementById("passwordLogin").focus();

                var messageSenhaElementLogin = document.getElementById("messagemSenhaLogin");
                messageSenhaElementLogin.innerHTML = "Digite sua senha.";

                return false;
            }
            return true;
        }
        //formulario Cadastro
        function valida_dadosCadastro(formulario) {
            if(formulario.name.value == ""){

                document.getElementById("name").focus();

                var messageNomeElement = document.getElementById("messagemNome");
                messageNomeElement.innerHTML = "É obrigatorio digitar um nome.";

                return false;
            }
            if (formulario.password.value == "" || formulario.password.value.length < 4) {

                document.getElementById("password").focus();
                var messageElement = document.getElementById("messagemSenha");
                messageElement.innerHTML = "A senha deve ter no minino 4 caracteres.";

                return false;
            }
            if (formulario.email.value == "") {
                
                document.getElementById("email").focus();

                var messageEmailElement = document.getElementById("messagemEmail");
                messageEmailElement.innerHTML = "O Email é obrigatorio para realizar o cadastro.";

                return false;
            }
            
            return true;
        }

    </script>
</body>
</html>
<?php 
/**
 * Resposta de Erro e confirmação de alteracao de Senha.
 */
@$troca = $_GET["troca"];
@$Erro = $_GET["Erro"];

if($troca == 'Y'){
    ?>
    <script>
        M.toast({html: 'Senha Alterada com Sucesso!'});
    </script>
    
    <?php 
}


if($Erro == 1){
?>
<script>
    M.toast({html: 'Email ou senha incorretos!!'});
</script>
<?php
}else if ($Erro == 2){
?>
<script>
    M.toast({html: 'Este email já está cadastrado.'});
</script>
<?php
}


?>