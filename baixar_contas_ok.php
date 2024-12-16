<?php
include_once "conexao.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $total_reg = $_POST['total_reg'];
    $data_pagto = $_POST['data_pagto'];

    for ($i = 1; $i <= $total_reg; $i++) {
        //Verifica se 'id' e 'valor'  estão definidos
        $id_baixa = isset($_POST['id' . $i]) ? $_POST['id' . $i] : null;
        $valor = isset($_POST['valor' . $i]) ? $_POST['valor' . $i] : null;
        //Define a variável 'baixa' conforme o checkbox
        $baixa = isset($_POST['baixa' . $i]) && $_POST['baixa' . $i] == 1 ? 1 : 0;
        //Apenas continua se 'id' e 'valor' estiverem definidos e 'baixa' for 1
        if ($baixa == 1 && $id_baixa && $valor) {
            $sql = $conexao->prepare("UPDATE contas_pagar SET data_pagto = '$data_pagto', valor_pago = '$valor' WHERE id_conta = '$id_baixa'");
            $sql->execute();
        }
    };
    header('location: lista_contas.php');
}

// if (isset($_POST['id' . $i])) {
//    $id_baixa = $_POST['id' . $i];
//} else {
//    $id_baixa = null;
//}
// if (isset($_POST['valor' . $i])) {
//    $valor = $_POST['valor' . $i];
//} else {
//    $valor = null;
//}
// if (isset($_POST['baixa' . $i]) && $_POST['baixa' . $i] == 1) {
//     $baixa = 1;
// } else {
//     $baixa = 0;
// }
