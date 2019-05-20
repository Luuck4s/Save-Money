<?php 
/**
 * Arquivo para listar todos as receitas e despesas do usuario para ele escolher qual quer excluir
 */
include "validaCookie.php";
include "conectaBanco.php";

$usuarioEmail = $_COOKIE["usuarioEmail"];

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

date_default_timezone_set("America/Sao_Paulo"); 
$anoAtual = date("Y");
$mesAtual = date("m");
$arrayMeses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto','Setembro', 'Outubro', 'Novembro', 'Dezembro']; 

$usuarioEmail = $_COOKIE["usuarioEmail"];


$select = "SELECT id_valor,titulo_valor,DATE_FORMAT(data_valor,'%d/%m/%Y') AS 'data_valorFor',desc_valor,vl_valor,tipo_valor 
                FROM tb_valores 
                    WHERE cd_email_usuario='$usuarioEmail' 
                        ORDER BY data_valor DESC";

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
    <script src="js/validatorDate.js"></script>
    <title>Excluir</title>
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

        <!-- Estrutura Dropdown Visualizar -->
        <ul id="dropdown3" class="dropdown-content">
            <li>
                <a href="visualizar.php?q=<?= $qM ?>">Mês de <?= $arrayMeses[$mesAtual - 1] ?></a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="visualizar.php?q=<?= $qT ?>">Todas Receitas e Despesas de <?= $anoAtual ?></a>
            </li>
            <li class="divider"></li>
            <li>
                <a class="waves-effect waves-light modal-trigger" href="#PesQuery">Pesquisa Avançada</a>
            </li>
        </ul>
        <!-- Estrutura Dropdown Visualizar Mobile -->
        <ul id="dropdown4" class="dropdown-content">
            <li>
                <a href="visualizar.php?q=<?= $qM ?>">Mês de <?= $arrayMeses[$mesAtual - 1] ?></a>
            </li>
            <li>
                <a href="visualizar.php?q=<?= $qT ?>">Todas Receitas e Despesas de <?= $anoAtual ?></a>
            </li>
            <li>
                <a class="waves-effect waves-light modal-trigger" href="#PesQuery">Pesquisa Avançada</a>
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
                <a class="waves-effect waves-light modal-trigger" href="#formQuery">Pesquisa Avançada</a>
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
                <a class="waves-effect waves-light modal-trigger" href="#formQuery">Pesquisa Avançada</a>
            </li>
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
                    <li>
                        <a href="perfil.php">Perfil
                            <i class="material-icons right">account_circle</i>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">Sair
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
                <a href="logout.php">Sair
                    <i class="material-icons left">exit_to_app</i>
                </a>
            </li>
        </ul>
    </div>
    <!--Modal Pesquisa Avancada Grafico-->
    <div id="formQuery" class="modal">
        <div class="modal-content">
            <div class="row">
                <div class="center">
                    <i class="medium material-icons">search</i>
                </div>
               <form class="col s12" action="grafico.php?Tempo=<?= $tempoP ?>" method="POST" name="formulario" onSubmit="return validaPesquisa(this)">
                    <div class="row">
                        <div class="input-field col s6">
                            <select name="ano" id="ano">
                                <option value="" disabled selected>Ano</option>
                                <?php 
                                    require "conectaBanco.php";

                                    $sqlAno = "SELECT DISTINCT(extract(year FROM `data_valor`)) as Ano 
                                                FROM tb_valores 
                                                    WHERE cd_email_usuario = '$usuarioEmail' 
                                                        ORDER BY Ano DESC";

                                    $queryAno = $con->query($sqlAno);

                                    foreach($queryAno as $Ano):
                                ?>
                                <option value="<?= $Ano['Ano'] ?>"><?= $Ano['Ano'] ?></option>
                                <?php
                                    
                                    $con = null;
                                    endforeach;
                                ?>
                            </select>
                            <label>Ano</label>
                            <span id="anoSpan"></span>
                        </div>
                        <div class="input-field col s6">
                            <select name="mes" id="mes">
                                <option value="" disabled selected>Mês</option>
                                <?php 
                                    require "conectaBanco.php";

                                    $sqlMes = "SELECT DISTINCT(extract(month FROM `data_valor`)) as Mes 
                                                    FROM tb_valores 
                                                        WHERE cd_email_usuario = $usuarioEmail''
                                                                ORDER BY Mes ASC";

                                    $queryMes = $con->query($sqlMes);

                                    foreach($queryMes as $Mes):
                                ?>
                                <option value="<?= $Mes['Mes'] ?>"><?= $arrayMeses[$Mes['Mes'] - 1] ?></option>
                                <?php 
                                    $con = null;
                                    endforeach;
                                ?>
                            </select>
                            <label>Mês</label>
                            <span id="mesSpan"></span>
                        </div>
                    </div>
                    <div class="center">
                        <button class="btn blue waves-effect waves-light">Pesquisar
                            <i class="material-icons right">search</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Pesquisa Avancada -->
    <div id="PesQuery" class="modal">
        <div class="modal-content">
            <div class="row">
                <div class="center">
                    <i class="medium material-icons">search</i>
                </div>
               <form class="col s12" action="visualizar.php?q=<?= $qP ?>" method="POST" name="formulario" onSubmit="return validaPesquisa(this)">
                    <div class="row">
                        <div class="input-field col s6">
                            <select name="ano" id="ano">
                                <option value="" disabled selected>Ano</option>
                                <?php 
                                    require "conectaBanco.php";

                                    $sqlAno = "SELECT DISTINCT(extract(year FROM `data_valor`)) as Ano 
                                                FROM tb_valores 
                                                    WHERE cd_email_usuario = '$usuarioEmail' 
                                                        ORDER BY Ano DESC";

                                    $queryAno = $con->query($sqlAno);

                                    foreach($queryAno as $Ano):
                                ?>
                                <option value="<?= $Ano['Ano'] ?>"><?= $Ano['Ano'] ?></option>
                                <?php
                                    
                                    $con = null;
                                    endforeach;
                                ?>
                            </select>
                            <label>Ano</label>
                            <span id="anoSpan"></span>
                        </div>
                        <div class="input-field col s6">
                            <select name="mes" id="mes">
                                <option value="" disabled selected>Mês</option>
                                <?php 
                                    require "conectaBanco.php";

                                    $sqlMes = "SELECT DISTINCT(extract(month FROM `data_valor`)) as Mes 
                                                    FROM tb_valores 
                                                        WHERE cd_email_usuario = '$usuarioEmail'
                                                            ORDER BY Mes ASC";

                                    $queryMes = $con->query($sqlMes);

                                    foreach($queryMes as $Mes):
                                ?>
                                <option value="<?= $Mes['Mes'] ?>"><?= $arrayMeses[$Mes['Mes'] - 1] ?></option>
                                <?php 
                                    $con = null;
                                    endforeach;
                                ?>
                            </select>
                            <label>Mês</label>
                            <span id="mesSpan"></span>
                        </div>
                    </div>
                    <div class="center">
                        <button class="btn blue waves-effect waves-light">Pesquisar
                            <i class="material-icons right">search</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br><br>
    <div class="container.fluid">
        <?php if($numLinhas == 0): ?> <!--Caso nao tenha nenhum registro no banco -->
        <div>
            <br>
            <h5 class="center-align">Está muito vazio aqui, adicione alguma receita ou despesa para poder apagar.</h5>
            <br>
            <center>
                <img class="responsive-img" src="Img/empty.svg" width="500" alt="empty img fail">
            </center>
        </div>
        <?php else: ?>
        <div class="row">
            <div>
                <center>
                    <h5 class="ligth">Atenção, depois que você excluir não tem como recuperar..</h5>
                    <br><br>
                    <img class="responsive-img" src="Img/warning.svg" width="250" alt="warning img fail">
                </center>
            </div>
        <br><br>    
            <?php foreach($linhaSelect as $dadosRD): //Caso tenha me retorna os valores

            // Conversão para facilitar a leitura do usuario
            if($dadosRD['tipo_valor'] == 'D'){
                
                $dadosRD['tipo_valor'] = 'Despesa';

            }else{

                $dadosRD['tipo_valor'] = 'Receita';

            }
        ?>
            <div class="col s12 m3">
                <div class="card blue darken-2">
                    <div class="card-content white-text">
                        <span class="center card-title"><?= $dadosRD['titulo_valor'] ?></span>
                        <p>
                            <i class="material-icons left">info_outline</i><?= $dadosRD['tipo_valor'] ?>
                        </p>
                        <hr>
                        <p class="light right"><?= $dadosRD['data_valorFor'] ?></p>
                        <p><?= $dadosRD['desc_valor'] ?></p>
                        <p class="center">Valor: R$ <?= number_format($dadosRD['vl_valor'], 2 ,',', '.'); ?></p>
                        <a href="deletar.php?id=<?=$dadosRD['id_valor']?>">
                            <i class="material-icons right" style="color:#000;">delete_forever</i>
                        </a>
                        <br>
                    </div>

                </div>
            </div>

            <?php 
            endforeach;
            endif;
            $con = null;

        ?>
        </div>
    </div>
    <br><br><br>
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