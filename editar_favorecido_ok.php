<?php
include_once "conexao.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$id_favorecido = $_POST['id'];
$nome_favorecido = $_POST['nome_favorecido'];
$email = $_POST['email'];
$celular =$_POST['celular'];

$novo = [
    'id_favorecido' => $id_favorecido,
    'nome_favorecido' => $nome_favorecido,
    'email' => $email,
    'celular' => $celular
];
$update = $conexao->prepare("UPDATE favorecidos SET nome_favorecido = :nome_favorecido, email = :email, celular = :celular WHERE id_favorecido=:id_favorecido");
$update->execute($novo);
}
header('location: lista_favorecidos.php');