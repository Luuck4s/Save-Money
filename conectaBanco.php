<?php 
/**
 * Conexao com banco de dados, utilizando PDO.
 */
$servidor = "localhost";
$usuario_bd = "id9596498_root";
$senha_bd = "123654789";
$banco = "id9596498_db_savemoney";

$con = new PDO("mysql:host=$servidor;dbname=$banco", $usuario_bd, $senha_bd);
?>