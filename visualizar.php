<?php
    /**
     * Arquivo para visualizar em tabela as receitas do mes ou todas as receitas
     */
    ob_start();

    date_default_timezone_set("America/Sao_Paulo"); 

    include "validaCookie.php";
    include "conectaBanco.php";

    //Variavel que verifica quais dados ira buscar, T = tudo, M = mes
    $q = $_GET['q'];

    $usuarioEmail = $_COOKIE["usuarioEmail"];
    $mesAtual = date("m");
    
    $arrayMeses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto','Setembro', 'Outubro', 'Novembro', 'Dezembro']; 
    
    if($q == "T"){
        $select = "SELECT titulo_valor,tipo_valor,desc_valor,DATE_FORMAT(data_valor,'%d/%m/%Y') as 'data_valor',vl_valor FROM tb_valores 
        WHERE cd_email_usuario = '$usuarioEmail' ORDER BY data_valor";

        $titulo = "Todas as Despesa e Receitas";
    }else{
        $select = "SELECT titulo_valor,tipo_valor,desc_valor,DATE_FORMAT(data_valor,'%d/%m/%Y') as 'data_valor',vl_valor FROM tb_valores 
        WHERE cd_email_usuario = '$usuarioEmail' AND extract(month from data_valor) = $mesAtual ORDER BY data_valor";

        $titulo = "Despesa e Receitas do Mês de {$arrayMeses[$mesAtual - 1]}";
    }

    $querySelect = $con->query($select);
    $linhaSelect = $querySelect->fetchAll();
    $numLinhas = sizeof($linhaSelect);
    
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
    <title>Visualizar</title>
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
                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="dropdown1">Adicionar<i
                                class="material-icons left">add</i></a>
                    </li>
                    <li>
                        <a class="dropdown-trigger" href="!#" data-target="dropdown3">Visualizar<i
                                class="material-icons left">pageview</i></a>
                    </li>
                    <li>
                        <a href="excluir.php">Excluir Receita ou Despesa<i
                                class="material-icons left">delete_sweep</i></a>
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
                <a href="index.php">Início<i class="material-icons left">home</i></a>
            </li>
            <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown2">Adicionar<i
                        class="material-icons left">add</i></a>
            </li>
            <li>
                <a class="dropdown-trigger" href="!#" data-target="dropdown4">Visualizar<i
                        class="material-icons left">pageview</i></a>
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
    <div class="container.fluid">
        <?php if($numLinhas == 0): ?>
        <br>
        <center>
            <h4 class="center light">Está tão vazio aqui, adicione algumas receitas e despesas para visualizá las.</h4>
            <img class="responsive-img" src="Img/empty.svg" width="400" alt="empty img fail">
        </center>
        <?php else: ?>
    </div>
    <!-- Identifica o que esta sendo exibido atraves da varivel titulo que vem do php -->
    <div>
        <div id="index-bannerSA" class="parallax-container">
            <div class="section no-pad-bot">
                <div class="container">
                    <h4 class="center-align black-text"><?= $titulo ?></h4>
                </div>
            </div>
            <div class="parallax"><img src="Img/table.svg" alt="Unsplashed background img 1"></div>
        </div>
    </div>
    <div class="container.fluid">
        <table class="responsive-table striped centered">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($linhaSelect as $dadosPesquisa):?>

            <?php  // Faz a conversão de tipo da despesa para melhor entendimento
            if($dadosPesquisa['tipo_valor'] == 'D'){
                
                $dadosPesquisa['tipo_valor'] = 'Despesa';

            }else{

                $dadosPesquisa['tipo_valor'] = 'Receita';

            }
            ?>
                <tr>
                    <td><?= $dadosPesquisa['titulo_valor'] ?></td>
                    <td><?= $dadosPesquisa['tipo_valor'] ?></td>
                    <td><?= $dadosPesquisa['desc_valor'] ?></td>
                    <td><?= $dadosPesquisa['data_valor'] ?></td>
                    <td>R$ <?= number_format($dadosPesquisa['vl_valor'], 2 ,',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        <?php  endif; ?>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

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

        //dropdown
        $(".dropdown-trigger").dropdown();

        //sidenav
        $(document).ready(function() {
            $('.sidenav').sidenav();
        });

    </script>

</body>
</html>
<?php 

$con = null;
ob_end_flush();

?>