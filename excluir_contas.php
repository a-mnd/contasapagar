<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plano de contas - Editar</title>
</head>

<body>
    <?php
    //conexão
    include_once "conexao.php";
    //menu com o bootstrap declarado
    include_once "menu.php";
    //pegando o id plano pela URL com método GET
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id_conta = $_GET["id_conta"];
        //consulta tabela
        $novo = [
            'id_conta' => $id_conta
        ];
        $excluir = $conexao->prepare("DELETE FROM contas_pagar WHERE id_conta= :id_conta");
        $excluir->execute($novo);
    }
    header('location: lista_contas.php');
    ?>
</body>

</html>