<?php 
    /**
     * Arquivo com uma funcao de retornar o saldo do mes atual.
     */
    ob_start();
    date_default_timezone_set("America/Sao_Paulo"); 
    
    include "validaCookie.php";

    function ver_Saldo(){

        require "conectaBanco.php";
        
        $valorTotal = 0;

        $usuarioEmail = $_COOKIE['usuarioEmail'];

        $mesAtual = date("m");

        $comandoSQL = "SELECT titulo_valor,tipo_valor,desc_valor,data_valor,vl_valor 
                            FROM tb_valores 
                                WHERE cd_email_usuario = '$usuarioEmail' 
                                    AND extract(month from data_valor) = $mesAtual";

        $querySelect = $con->query($comandoSQL);



        foreach($querySelect as $dado){
            if($dado["tipo_valor"] == "R"){
                $valorTotal += $dado["vl_valor"];
            }

            if($dado["tipo_valor"] == "D"){
                $valorTotal -= $dado["vl_valor"];
            }
        }

        $con = null;

        return $valorTotal;

    }

    ob_end_flush(); 
?>