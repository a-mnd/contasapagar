<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorecidos - Editar</title>
</head>

<body>
    <?php
    //conexão
    include_once "conexao.php";
    //menu com o bootstrap declarado
    include_once "menu.php";
    //pegando o id plano pela URL com método GET
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id_favorecido = $_GET["id_favorecido"];
        //consulta tabela
        $novo = [
            'id_favorecido' => $id_favorecido
        ];
        $excluir = $conexao->prepare("DELETE FROM favorecidos WHERE id_favorecido= :id_favorecido");
        $excluir->execute($novo);
    }
    header('location: lista_favorecidos.php');
    ?>
</body>

</html>