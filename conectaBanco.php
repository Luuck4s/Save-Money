<?php 
/**
 * Conexao com banco de dados, utilizando PDO.
 */
$servidor = "localhost";
$usuario_bd = "--";
$senha_bd = "--";
$banco = "--";

$con = new PDO("mysql:host=$servidor;dbname=$banco", $usuario_bd, $senha_bd);
?>