<?php
include_once "conexao.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $desc_conta = $_POST['desc_conta'];
    $data_vcto = $_POST['data_vcto'];
    $valor = $_POST['valor'];
    $id_favorecido = $_POST['id_favorecido'];
    $id_plano = $_POST['id_plano'];

    $novo = [
        'desc_conta' => $desc_conta,
        'data_vcto' => $data_vcto,
        'valor' => $valor,
        'id_favorecido' => $id_favorecido,
        'id_plano' => $id_plano
    ];
    //precisa faver tratamento no valor com replace para o modo americano 
    $insert = $conexao->prepare("INSERT INTO contas_pagar (desc_conta, id_favorecido, data_vcto, valor, id_plano) VALUES (:desc_conta, :id_favorecido, :data_vcto, :valor, :id_plano)");
    $insert->execute($novo);
    header('location: lista_contas.php');
}