<?php 

$servidor = "localhost";
$usuario_bd = "root";
$senha_bd = "123Def456#";
$banco = "db_saveMoney";

$con = new PDO("mysql:host=$servidor;dbname=$banco", $usuario_bd, $senha_bd);
?>