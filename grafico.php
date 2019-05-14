<?php 
    /**
     * Arquivo responsavel por gerar graficos, identifica qual tipo de grafico o usuario quer ver e retornar ele em seguida ou seja, se quiser
     * visualizar apenas do mes atual ou de todo o tempo.
     */

    ob_start();
    date_default_timezone_set("America/Sao_Paulo"); 

    include "validaCookie.php";

    $usuarioEmail = $_COOKIE['usuarioEmail'];
    $tempo = $_GET['Tempo'];
    $arrayMeses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto','Setembro', 'Outubro', 'Novembro', 'Dezembro']; 
    $mesAtual = date("m");
    $totalReceita = 0;
    $totalDespesa = 0;
    $maiorReceita = array("valor"=> "0","nome" => "","data" => "");
    $maiorDespesa = array("valor"=> "0","nome" => "");


    /**
     * Verifica qual "intervalo" de tempo o usuario deseja ver e exibe um titulo 
     */
    if($tempo == "M"){
        $titulo = "Gráfico do Mês de {$arrayMeses[$mesAtual - 1]}";
    }else{
        $titulo = "Gráfico de Despesas e Receitas";
    }

    
    /**
     * Realiza a decisao de cada select a ser utilizado
     */
    if($tempo == "M"){
        /** Select para o primeiro grafico */
        $sql = "SELECT tipo_valor,vl_valor FROM tb_valores  
        WHERE cd_email_usuario = '$usuarioEmail' AND extract(month from data_valor) = $mesAtual";

        /** Select para o segundo grafico , [pegando a maior despesa]  */
        $sqlMaior = "SELECT * FROM tb_valores WHERE vl_valor = (SELECT max(vl_valor) FROM tb_valores
        WHERE tipo_valor = 'D' AND (extract(month from data_valor) = $mesAtual) ) AND cd_email_usuario = '$usuarioEmail'";

        /** Select para o segundo grafico , [pegando a maior Receita] */
        $sqlMaiorReceita = "SELECT * FROM tb_valores WHERE vl_valor = (SELECT max(vl_valor) FROM tb_valores
        WHERE tipo_valor = 'R' AND (extract(month from data_valor) = $mesAtual) ) AND cd_email_usuario = '$usuarioEmail'";

        

    }else{
        /*Select para o primeiro grafico todos os valores */
        $sql = "SELECT tipo_valor,vl_valor FROM tb_valores  
            WHERE cd_email_usuario = '$usuarioEmail'";

        /** Select para o segundo grafico , [pegando a maior despesa] */
        $sqlMaior = "SELECT * FROM tb_valores WHERE vl_valor = (SELECT max(vl_valor) FROM tb_valores
        WHERE tipo_valor = 'D') AND cd_email_usuario = '$usuarioEmail'";

        /** Select para o segundo grafico , [pegando a maior Receita] */
        $sqlMaiorReceita = "SELECT * FROM tb_valores WHERE vl_valor = (SELECT max(vl_valor) FROM tb_valores
        WHERE tipo_valor = 'R') AND cd_email_usuario = '$usuarioEmail'";
    }  

    
    include "conectaBanco.php";
    
    /**Executando o select do primeiro grafico */
    $querySelect = $con->query($sql);
    $linhaSelect = $querySelect->fetchAll();
    
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


    /** Executando o select do segundo grafico */

    #pegando a maior despesa
    $querySelectMaior = $con->query($sqlMaior);
    $linhaSelectMaior = $querySelectMaior->fetchAll();

    foreach($linhaSelectMaior as $DespesaMaior){
        $maiorDespesa["nome"] = $DespesaMaior["titulo_valor"];
        $maiorDespesa["valor"] = $DespesaMaior["vl_valor"];
    }

    #pegando a maior receita
    $ReceitaSelectMaior = $con->query($sqlMaiorReceita);
    $ReceitaLinhaSelect = $ReceitaSelectMaior->fetchAll();

    foreach($ReceitaLinhaSelect as $ReceitaMaior){
        $maiorReceita["nome"] = $ReceitaMaior["titulo_valor"];
        $maiorReceita["valor"] = $ReceitaMaior["vl_valor"];
        $maiorReceita["data"] = $ReceitaMaior["data_valor"];
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

    <!-- caso nao tenha nenhum valor -->
    <?php if($numLinhas == 0): ?>

    <div>
        <br>
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
            <div class="parallax"><img src="Img/graphics.svg" alt="Unsplashed background img 1"></div>
        </div>
    </div>
    <br><br>
    <!--Graficos -->
    <div class="container.fluid">
        <div class="center row">
            <!-- Grafico 1 -->
            <div class="col s12 m6">                
                <div id="chart_div"></div>
            </div>
            <!-- Grafico 2 -->
            <div class="col s12 m6">
                <div id="piechart" style="width: auto; height: auto; font-size: 20px"></div>
            </div>
        </div>
    </div>

    <!--Script do grafico 1 -->
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addRows([
          ['Receitas', <?= $totalReceita ?>,'Receitas R$ <?= number_format($totalReceita, 2 ,',', '.') ?>'],
          ['Despesas', <?= $totalDespesa ?>,'Despesas R$ <?= number_format($totalDespesa, 2 ,',', '.') ?>']
        ]);

        var options = {'title':'<?= $titulo ?>','width':'auto','height':'auto','legend':'left','is3D':true};

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
    </script>
    
    <!--Script grafico 2 -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var dataMaior = new google.visualization.DataTable();
        dataMaior.addColumn('string', 'Topping');
        dataMaior.addColumn('number', 'Slices');
        dataMaior.addColumn({type: 'string', role: 'tooltip'});
        dataMaior.addRows([
          ['<?= $maiorReceita["nome"] ?>', <?= $maiorReceita["valor"] ?>,'<?= $maiorReceita["nome"] ?> R$ <?= number_format($maiorReceita["valor"], 2 ,',', '.') ?>'],
          ['<?= $maiorDespesa["nome"] ?>',<?= $maiorDespesa["valor"] ?>,'<?= $maiorDespesa["nome"] ?> R$ <?= number_format($maiorDespesa["valor"], 2 ,',', '.') ?>']
        ]);

        var options = {'title':'Maior Receita e Despesa','is3D':true};

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(dataMaior, options);
      }
    </script>
    <?php endif; ?>
    <script type="text/javascript">

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