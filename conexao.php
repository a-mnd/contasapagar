<?php
$host = "localhost";
$banco = "pagamentos";
$user = "root";
$senha = "";
$conexao = new PDO("mysql:host=$host;dbname=$banco", $user, $senha);
if(!$conexao){
    echo "Falha de conexao!";
}