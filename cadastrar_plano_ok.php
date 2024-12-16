<?php
include_once "conexao.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $desc_plano = $_POST['desc_plano'];
    $novo = [
        'desc_plano' => $desc_plano
    ];
    $insert = $conexao->prepare("INSERT INTO plano_contas(desc_plano) VALUES (:desc_plano)");
    $insert->execute($novo);
    header('location: lista_plano.php');
}
