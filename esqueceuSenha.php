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
    <title>Save Money</title>
</head>

<body>
    <!--NavBar-->
    <div>
        <nav>
            <div class="nav-wrapper">
                <a href="index.php" class="brand-logo center">
                    <img class="logoNavbar" src="Img/icone.png" alt="img logo navbar">
                </a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger">
                    <i class="material-icons">menu</i>
                </a>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <li>
                <a href="index.php">Início
                    <i class="material-icons left">home</i>
                </a>
            </li>
        </ul>
    </div>
    <br><br><br>
    <!-- Form de entrada de email e pergunta de seguranca -->
    <div class="container">
        <form class="col s12" action="trocaEsqueceuSenha.php" method="POST" onSubmit="return valida_dadosEsqueceu(this)">
            <!--Valor do tipo de dado -->
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <input id="email" type="email" name="email" class="validate">
                    <label for="email">Email</label>
                    <span class="helper-text" id="messagemEmail"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">text_fields</i>
                    <select id="selectSegu" name="selectSegu">
                        <option value="" disabled selected>Selecione uma pergunta</option>
                        <option value="1">Qual cidade você nasceu ?</option>
                        <option value="2">Cor favorita ?</option>
                    </select>
                    <label>Pergunta de Segurança</label>
                    <span class="helper-text" id="messagemSelct"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">short_text</i>
                    <textarea id="respostaSegu" name="respostaSegu" data-length="40"
                        class="materialize-textarea"></textarea>
                    <label for="respostaSegu">Resposta</label>
                    <span class="helper-text" id="respostaSeguSpan"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">enhanced_encryption</i>
                    <input id="passwordNew" type="password" name="senhaNova" class="validate">
                    <label for="passwordNew">Nova Senha</label>
                    <span class="helper-text" id="senhaNovaSpan"></span>
                </div>
            </div>
            <br><br>
            <div class="center">
                <button class="btn blue waves-effect waves-light">Enviar
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
    <br><br><br><br><br><br>
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
    <body>
</html>
<?php 
    @$Erro = $_GET["Erro"];

    if($Erro == "Y"){
        ?>
        <script>
            M.toast({html: 'Email ou pergunta de segurança incorretos!!'});
        </script>
        <?php
    }
?>