<?php 
/**
 * Conexao com banco de dados, utilizando PDO.
 */
$servidor = "localhost";
$usuario_bd = "root";
$senha_bd = "123Def456#";
$banco = "db_savemoney";

$con = new PDO("mysql:host=$servidor;dbname=$banco", $usuario_bd, $senha_bd);
?>