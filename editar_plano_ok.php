<?php
include_once "conexao.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$id_plano = $_POST['id'];
$desc_plano = $_POST['desc_plano'];
$novo = [
    'id_plano' => $id_plano,
    'desc_plano' => $desc_plano
];
$update = $conexao->prepare("UPDATE plano_contas SET desc_plano =  :desc_plano WHERE id_plano=:id_plano");
$update->execute($novo);
}
header('location: lista_plano.php');