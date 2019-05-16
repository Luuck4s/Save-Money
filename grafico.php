<?php 
    /**
     * Arquivo responsavel por gerar graficos, identifica qual tipo de grafico o usuario quer ver e retornar ele em seguida ou seja, se quiser
     * visualizar apenas do mes atual ou de todo o tempo.
     */

    ob_start();
    date_default_timezone_set("America/Sao_Paulo");

    include "validaCookie.php";
    
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

    $usuarioEmail = $_COOKIE['usuarioEmail'];
    /**
     * $tempo pega o valor passado por get para determinar se vai ser do mês(M) ou do ano(T)
     */
    $tempo = $_GET['Tempo'];
    $arrayMeses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto','Setembro', 'Outubro', 'Novembro', 'Dezembro']; 
    $mesAtual = date("m");
    $anoAtual = date("Y");
    $totalReceita = 0;
    $totalDespesa = 0;
    $mediaReceita = 0;
    $mediaDespesa = 0;
    
    /**
    * $maiorReceita and $maiorDespesa sao dois array que contem informacoes sobre a maior receita e maior despesa
    */
    $maiorReceita = array("valor"=> "0","nome" => "");
    $maiorDespesa = array("valor"=> "0","nome" => "");


    if($tempo == md5("M")){

        /**
         * Preenchendo o array $titulo que ira servir para definir os titulos dos graficos
         */
        $titulo = array(
            "grafico1"=>"Gráfico do Mês de {$arrayMeses[$mesAtual - 1]}",
            "grafico2"=>"Maior Receita e Despesa de {$arrayMeses[$mesAtual - 1]}",
            "grafico3"=>"Média de Receitas e Despesa de {$arrayMeses[$mesAtual - 1]}",
            "tituloParallax"=>"Gráficos de {$arrayMeses[$mesAtual - 1]}");

        /**
        * Select para o primeiro grafico, buscando o tipo do valor para realizar a conta e o valor em si.
        */
        $sql = "SELECT `tipo_valor`,`vl_valor` 
                    FROM `tb_valores`
                        WHERE `cd_email_usuario` = '$usuarioEmail' 
                            AND extract(month FROM `data_valor`) = $mesAtual 
                                AND (extract(year FROM `data_valor`) = $anoAtual)";
        /**
        * Select para o segundo grafico, busca o titulo e o valor da maior despesa do mes
        */
        $sqlMaiorDespesa = "SELECT `titulo_valor`,`vl_valor`
                                FROM `tb_valores` 
                                    WHERE `vl_valor` = (SELECT max(`vl_valor`) FROM `tb_valores`
                                                            WHERE `cd_email_usuario` = '$usuarioEmail'
                                                                AND `tipo_valor` = 'D' 
                                                                    AND (extract(month FROM `data_valor`) = $mesAtual) 
                                                                        AND (extract(year FROM `data_valor`) = $anoAtual))";
        /**
         * Select para o segundo grafico , buscando o titulo e valor da maior receita do mes
        */
        $sqlMaiorReceita = "SELECT `titulo_valor`,`vl_valor`
                                FROM `tb_valores` 
                                    WHERE `vl_valor` = (SELECT max(`vl_valor`) FROM `tb_valores`
                                                            WHERE `cd_email_usuario` = '$usuarioEmail'
                                                                AND `tipo_valor` = 'R' 
                                                                    AND (extract(month FROM `data_valor`) = $mesAtual) 
                                                                        AND (extract(year FROM `data_valor`) = $anoAtual))";
        /**
         * Select para o terceiro grafico, buscando o valor da media simples das receitas 
        */
        $sqlMediaReceita = "SELECT avg(`vl_valor`) as 'Receita_Media' 
                                FROM `tb_valores` 
                                    WHERE `tipo_valor` = 'R' 
                                        AND (extract(month FROM `data_valor`) = $mesAtual) 
                                            AND (extract(year FROM `data_valor`) = $anoAtual) 
                                                AND `cd_email_usuario` = '$usuarioEmail'";
        /**
         * Select para o terceiro grafico, buscando o valor da media simples das despesas 
        */
        $sqlMediaDespesa = "SELECT avg(`vl_valor`) as 'Despesa_Media' 
                                FROM `tb_valores` 
                                    WHERE `tipo_valor` = 'D' 
                                        AND (extract(month FROM `data_valor`) = $mesAtual) 
                                            AND (extract(year FROM `data_valor`) = $anoAtual) 
                                                AND `cd_email_usuario` = '$usuarioEmail'";
    }else if ($tempo == md5("T")){

        $titulo = array(
            "grafico1"=>"Gráfico de Despesas e Receitas $anoAtual",
            "grafico2"=>"Maior Receita e Despesa de $anoAtual",
            "grafico3"=>"Média de Receitas e Despesa de $anoAtual",
            "tituloParallax"=>"Gráficos de $anoAtual");
        
        $sql = "SELECT `tipo_valor`,`vl_valor` 
                    FROM `tb_valores`  
                        WHERE `cd_email_usuario` = '$usuarioEmail' 
                            AND (extract(year FROM `data_valor`) = $anoAtual)";

        $sqlMaiorDespesa = "SELECT `titulo_valor`,`vl_valor`
                                FROM `tb_valores` 
                                    WHERE `vl_valor` = (SELECT max(`vl_valor`) FROM `tb_valores`
                                                            WHERE `cd_email_usuario` = '$usuarioEmail'
                                                                AND `tipo_valor` = 'D' 
                                                                    AND (extract(year FROM `data_valor`) = $anoAtual))";

        $sqlMaiorReceita = "SELECT `titulo_valor`,`vl_valor`
                                FROM `tb_valores` 
                                    WHERE `vl_valor` = (SELECT max(`vl_valor`) FROM `tb_valores`
                                                            WHERE `cd_email_usuario` = '$usuarioEmail'
                                                                AND `tipo_valor` = 'R' 
                                                                    AND (extract(year FROM `data_valor`) = $anoAtual))";

        $sqlMediaReceita = "SELECT avg(`vl_valor`) as 'Receita_Media' 
                                FROM `tb_valores` 
                                    WHERE `tipo_valor`  = 'R' 
                                        AND (extract(year FROM `data_valor`) = $anoAtual) 
                                            AND `cd_email_usuario` = '$usuarioEmail'";

        $sqlMediaDespesa = "SELECT avg(`vl_valor`) as 'Despesa_Media' 
                                FROM `tb_valores` 
                                    WHERE `tipo_valor` = 'D' 
                                        AND (extract(year FROM `data_valor`) = $anoAtual)
                                            AND `cd_email_usuario` = '$usuarioEmail'";
    }else if ($tempo == md5("P")){

        $ano = $_POST["ano"];
        $mes = $_POST["mes"];

        $titulo = array(
            "grafico1"=>"Gráfico de Despesas e Receitas {$arrayMeses[$mes -1]}/$ano",
            "grafico2"=>"Maior Receita e Despesa de {$arrayMeses[$mes -1]}/$ano",
            "grafico3"=>"Média de Receitas e Despesa de {$arrayMeses[$mes -1]}/$ano",
            "tituloParallax"=>"{$arrayMeses[$mes -1]}<br>$ano");

    
        $sql = "SELECT `tipo_valor`,`vl_valor` 
        FROM `tb_valores`
            WHERE `cd_email_usuario` = '$usuarioEmail' 
                AND extract(month FROM `data_valor`) = $mes 
                    AND (extract(year FROM `data_valor`) = $ano)";
        
        $sqlMaiorDespesa = "SELECT `titulo_valor`,`vl_valor`
                                FROM `tb_valores` 
                                    WHERE `vl_valor` = (SELECT max(`vl_valor`) FROM `tb_valores`
                                                            WHERE `cd_email_usuario` = '$usuarioEmail'
                                                                AND `tipo_valor` = 'D' 
                                                                    AND (extract(month FROM `data_valor`) = $mes) 
                                                                        AND (extract(year FROM `data_valor`) = $ano))";
        
        $sqlMaiorReceita = "SELECT `titulo_valor`,`vl_valor`
                                FROM `tb_valores` 
                                    WHERE `vl_valor` = (SELECT max(`vl_valor`) FROM `tb_valores`
                                                            WHERE `cd_email_usuario` = '$usuarioEmail'
                                                                AND `tipo_valor` = 'R' 
                                                                    AND (extract(month FROM `data_valor`) = $mes) 
                                                                        AND (extract(year FROM `data_valor`) = $ano))";
        
        $sqlMediaReceita = "SELECT avg(`vl_valor`) as 'Receita_Media' 
                                FROM `tb_valores` 
                                    WHERE `tipo_valor` = 'R' 
                                        AND (extract(month FROM `data_valor`) = $mes) 
                                            AND (extract(year FROM `data_valor`) = $ano) 
                                                AND `cd_email_usuario` = '$usuarioEmail'";

        $sqlMediaDespesa = "SELECT avg(`vl_valor`) as 'Despesa_Media' 
         FROM `tb_valores` 
             WHERE `tipo_valor` = 'D' 
                 AND (extract(month FROM `data_valor`) = $mes) 
                     AND (extract(year FROM `data_valor`) = $ano) 
                         AND `cd_email_usuario` = '$usuarioEmail'";

    }
    
    include "conectaBanco.php";

    // Querys Primeiro Grafico

    $sqlSelect = $con->query($sql);
    $linhaSelect = $sqlSelect->fetchAll();
    $numLinhas = sizeof($linhaSelect);

    #conta para saber o total de Receita e de Despesa
    foreach($linhaSelect as $dado){
        if($dado["tipo_valor"] == "R"){
            $totalReceita += $dado["vl_valor"];
        }
        if($dado["tipo_valor"] == "D"){
            $totalDespesa += $dado["vl_valor"];
        }
    }

    // Querys Segundo Grafico

    #pegando a maior despesa
    $SelectMaior = $con->query($sqlMaiorDespesa);
    $linhasMaior = $SelectMaior->fetchAll();

    foreach($linhasMaior as $DespesaMaior){
        $maiorDespesa["nome"] = $DespesaMaior["titulo_valor"];
        $maiorDespesa["valor"] = $DespesaMaior["vl_valor"];
    }

    #Buscando a maior receita
    $ReceitaSelectMaior = $con->query($sqlMaiorReceita);
    $ReceitaLinhasSelect = $ReceitaSelectMaior->fetchAll();

    foreach($ReceitaLinhasSelect as $ReceitaMaior){
        $maiorReceita["nome"] = $ReceitaMaior["titulo_valor"];
        $maiorReceita["valor"] = $ReceitaMaior["vl_valor"];
    }

    // Querys Terceiro Grafico

    #buscando Media das Receitas
    $receitaMediaSelect = $con->query($sqlMediaReceita);
    $receitaMediaLinhas = $receitaMediaSelect->fetchAll();

    foreach($receitaMediaLinhas as $ReceitaMedia){
        $mediaReceita = $ReceitaMedia['Receita_Media'];
    }

    #buscando Media das Despesas
    $despesaMediaSelect = $con->query($sqlMediaDespesa);
    $despesaMediaLinhas = $despesaMediaSelect->fetchAll();

    foreach($despesaMediaLinhas as $DespesaMedia){
        $mediaDespesa = $DespesaMedia['Despesa_Media'];
    }

    $con = null;
    
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script src="js/validatorDate.js"></script>
    <title>Save Money</title>
</head>
<body>
    <div>
        <!-- Estrutura Dropdown Desk -->
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="incluir.php?tipo=<?= $tipoR ?>">Receita</a></li>
            <li class="divider"></li>
            <li><a href="incluir.php?tipo=<?= $tipoD ?>">Despesa</a></li>
        </ul>
        <!-- Estrutura Dropdown mobile -->
        <ul id="dropdown2" class="dropdown-content">
            <li><a href="incluir.php?tipo=<?= $tipoR ?>">Receita</a></li>
            <li><a href="incluir.php?tipo=<?= $tipoD ?>">Despesa</a></li>
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
                        <a class="dropdown-trigger" href="!#" data-target="dropdown5">Gerar Gráfico
                            <i class="material-icons left">donut_large</i>
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

    <!-- caso nao tenha nenhum valor -->
    <?php if($numLinhas == 0): ?>

    <div>
        <br><br><br><br><br>
        <h5 class="center-align">Está muito vazio aqui, adicione alguma receita ou despesa para poder visualizar o gráfico.</h5>
        <br>
        <center>
            <img class="responsive-img" src="Img/empty2.svg" width="500" alt="empty img fail">
        </center>
    </div>

    <?php else: ?>

    <!-- Parallax -->
    <div>
        <div id="index-bannerS" class="parallax-container">
            <div class="section no-pad-bot">
                <div class="container">
                    <h1 class="light center black-text"><?= $titulo["tituloParallax"] ?></h1>
                </div>
            </div>
            <div class="parallax">
                <img src="Img/graphics.svg" alt="Unsplashed background img 1">
            </div>
        </div>
    </div>
    <br><br><br>
    <!--Graficos -->
    <div class="container.fluid">
        <div class="center row">
            <!-- Grafico 1 -->
            <div class="col s12 m4">
                <div id="chart_div"></div>
            </div>
            <!-- Grafico 2 -->
            <div class="col s12 m4">
                <div id="piechart" ></div>
            </div>
            <!-- Grafico 3 -->
            <div class="col s12 m4">
                <div id="piechartMedia" ></div>
            </div>
        </div>
    </div>

    <!--Script do grafico 1 -->
    <script type="text/javascript">

    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addColumn({
            type: 'string',
            role: 'tooltip'
        });
        data.addRows([
            [
                'Receitas', <?= $totalReceita ?>,
                'Receitas R$ <?= number_format($totalReceita, 2 ,',', '.') ?>'
            ],
            [   
                'Despesas', <?= $totalDespesa ?>,
                'Despesas R$ <?= number_format($totalDespesa, 2 ,',', '.') ?>'
            ]
        ]);

        var optionsData = {
            'title': '<?= $titulo["grafico1"] ?>',
            'legend': 'rigth',
            colors: ['#0d47a1', '#d32f2f']
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, optionsData);
    }
    </script>

    <!--Script grafico 2 -->
    <script type="text/javascript">

    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var dataMaior = new google.visualization.DataTable();
        dataMaior.addColumn('string', 'Topping');
        dataMaior.addColumn('number', 'Slices');
        dataMaior.addColumn({
            type: 'string',
            role: 'tooltip'
        });
        dataMaior.addRows([
            [   '<?= $maiorReceita["nome"] ?>',
                <?= $maiorReceita["valor"] ?>,
                '<?= $maiorReceita["nome"] ?> R$ <?= number_format($maiorReceita["valor"], 2 ,',', '.') ?>'
            ],
            [   '<?= $maiorDespesa["nome"] ?>',
                <?= $maiorDespesa["valor"] ?>,
                '<?= $maiorDespesa["nome"] ?> R$ <?= number_format($maiorDespesa["valor"], 2 ,',', '.') ?>'
            ]
        ]);

        var options = {
            'title': '<?= $titulo["grafico2"] ?>',
            'legend': 'left',
            colors: ['#0d47a1', '#d32f2f'],
            'is3D': true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(dataMaior, options);
    }
    </script>

    <!-- Script grafico 3 -->
    <script type="text/javascript">

    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var dataMedia = new google.visualization.DataTable();
        dataMedia.addColumn('string', 'Topping');
        dataMedia.addColumn('number', 'Slices');
        dataMedia.addColumn({
            type: 'string',
            role: 'tooltip'
        });
        dataMedia.addRows([
            [
                'Receita Média', <?= $mediaReceita ?>,
                'R$ <?= number_format($mediaReceita, 2 ,',', '.') ?>'
            ],
            [
                'Despesa Média', <?= $mediaDespesa ?>,
                'R$ <?= number_format($mediaDespesa, 2 ,',', '.') ?>'
            ]
        ]);

        var options = {
            title: '<?= $titulo["grafico3"] ?>',
            'legend': 'left',
            colors: ['#0d47a1', '#d32f2f'],
            'is3D': true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartMedia'));

        chart.draw(dataMedia, options);
    }
    </script>

    <?php endif; ?>

    <br><br><br><br>
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