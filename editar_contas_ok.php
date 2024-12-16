<?php
include_once "conexao.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $desc_conta = $_POST['desc_conta'];
    $data_vcto = $_POST['data_vcto'];
    $valor = $_POST['valor'];
    $id_favorecido = $_POST['id_favorecido'];
    $id_plano = $_POST['id_plano'];
    $id_conta = $_POST['id'];
    $data_pagto = $_POST['data_pagto'];
    $valor_pago = $_POST['valor_pago'];
    $pagto_cartao = $_POST['pagto_cartao'];
    
    if ($pagto_cartao == '') {
        $pagto_cartao == 0;
    };
    if($valor_pago == '') {
        $valor_pago == 0;
    }
    //campo numérico não pode salvar como nulo, então faz o trtamento para salvar pelo menos com o 0 para não ter problemas futuros com adições, subtrações e outros
$novo = [
    'desc_conta' => $desc_conta,
    'data_vcto' => $data_vcto,
    'valor' => $valor,
    'id_favorecido' => $id_favorecido,
    'id_plano' => $id_plano,
    'id_conta' => $id_conta,
    'data_pagto' => $data_pagto,
    'valor_pago' => $valor_pago,
    'pagto_cartao' => $pagto_cartao

];

$update = $conexao->prepare("UPDATE contas_pagar SET desc_conta = :desc_conta, id_favorecido = :id_favorecido, data_vcto = :data_vcto, valor = :valor, data_pagto = :data_pagto, valor_pago = :valor_pago, id_plano = :id_plano, pagto_cartao = :pagto_cartao WHERE id_conta=:id_conta");
$update->execute($novo);
}
header('location: lista_contas.php');

