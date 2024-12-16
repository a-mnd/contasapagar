<?php
include_once "conexao.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome_favorecido = $_POST['nome_favorecido'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];

    $novo = [
        'nome_favorecido' => $nome_favorecido,
        'email' => $email,
        'celular' => $celular
    ];

    $insert = $conexao->prepare("INSERT INTO favorecidos (nome_favorecido, email, celular) VALUES (:nome_favorecido, :email, :celular)");
    $insert->execute($novo);
    header('location: lista_favorecidos.php');
}
