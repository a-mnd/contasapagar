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
        $id_plano = $_GET["id_plano"];
        //consulta tabela
        $novo = [
            'id_plano' => $id_plano
        ];
        $excluir = $conexao->prepare("DELETE FROM plano_contas WHERE id_plano= :id_plano");
        $excluir->execute($novo);
    }
    header('location: lista_plano.php');
    ?>
</body>

</html>