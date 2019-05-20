<?php
/**
 * Arquivo responsavel por gerar o PDF, utilizo a biblioteca FDFP.
 */
    require('./fpdf/fpdf.php');
    include "validaCookie.php";

    ob_start();

    class PDF extends FPDF
    {

        function Header()
        {
            // Logo
            $this->Image("./Img/icone.png",100,2,15,15);
            
            $this->Ln(15);
        }


        function Footer()
        {
            $this->SetY(-15);   
            $this->SetFont('Arial','I',10);
            $this->Cell(0,0,utf8_decode('Save Money © 2019'),0,0,'C');
        }
    }


    $linkPDF = $_GET['tempopdf'];

    $usuarioEmail = $_COOKIE["usuarioEmail"];
    $nomeCompleto = $_COOKIE["nomeCompleto"];

    $anoAtual = date("Y");
    $mesAtual = date("m");
    $arrayMeses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto','Setembro', 'Outubro', 'Novembro', 'Dezembro']; 


    if(strlen($linkPDF) > 4 ){

        $data = explode("/",$linkPDF);

        $ano = $data[1];
        $mes = $data[0];

        $tituloPDF = "{$arrayMeses[$mes - 1]} - $ano";

        $sql = "SELECT titulo_valor,tipo_valor,desc_valor,vl_valor,
                    DATE_FORMAT(data_valor,'%d/%m/%Y') as 'data_valorFormatada'
                        FROM tb_valores 
                            WHERE cd_email_usuario = '$usuarioEmail'
                                AND (extract(year FROM `data_valor`) = $ano)
                                    AND(extract(month from `data_valor`) = $mes) 
                                        ORDER BY data_valor ASC";
    }elseif(strlen($linkPDF) < 3){
        
        $tituloPDF = "{$arrayMeses[$linkPDF - 1]} - $anoAtual";

        $sql = "SELECT titulo_valor,tipo_valor,desc_valor,vl_valor,
                    DATE_FORMAT(data_valor,'%d/%m/%Y') as 'data_valorFormatada'
                        FROM tb_valores 
                            WHERE cd_email_usuario = '$usuarioEmail'
                                AND (extract(year FROM `data_valor`) = $anoAtual)
                                    AND(extract(month from `data_valor`) = $linkPDF) 
                                        ORDER BY data_valor ASC";
    }else{

        $tituloPDF = $linkPDF;

        $sql = "SELECT titulo_valor,tipo_valor,desc_valor,vl_valor ,
                        DATE_FORMAT(data_valor,'%d/%m/%Y') as 'data_valorFormatada'
                            FROM tb_valores 
                                WHERE cd_email_usuario = '$usuarioEmail'
                                    AND (extract(year FROM `data_valor`) = $linkPDF) 
                                        ORDER BY data_valor ASC";
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->setTitle(utf8_decode("Save Money - Relatório"));
    $pdf->SetFont('Arial','I',10);
    $pdf->Cell(5,0,utf8_decode("$nomeCompleto"),0,0,"");
    $pdf->SetX("10");
    $pdf->setY("30");
    $pdf->Cell(5,0,utf8_decode("$usuarioEmail"),0,0,"");
    $pdf->Ln(5);
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(190,10,utf8_decode("Relatório $tituloPDF"),0,0,"C");

    $pdf->Ln(15);
    $pdf->setFont('Arial','B',10);
    $pdf->Cell(50,7,utf8_decode("Título"),1,0,"C");
    $pdf->Cell(40,7,utf8_decode("Tipo"),1,0,"C");
    $pdf->Cell(40,7,"Data",1,0,"C");
    $pdf->Cell(40,7,"Valor",1,0,"C");
    $pdf->Ln();

    include "conectaBanco.php";

    $query = $con->query($sql);

    foreach($query as $dados){

        if($dados['tipo_valor'] == 'D'){
                
            $dados['tipo_valor'] = 'Despesa';

        }else{

            $dados['tipo_valor'] = 'Receita';

        }

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(50,7,utf8_decode($dados['titulo_valor']),1,0,"C");
        $pdf->Cell(40,7,$dados['tipo_valor'],1,0,"C");
        $pdf->Cell(40,7,$dados['data_valorFormatada'],1,0,"C");
        $pdf->Cell(40,7,$dados['vl_valor'],1,0,"C");
        $pdf->Ln();
    }

    $con = null;

    $pdf->Output();

    ob_end_flush(); 

?>