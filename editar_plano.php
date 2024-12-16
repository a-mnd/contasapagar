<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plano de contas - Editar</title>
</head>

<body>
    <div class="container">
        <?php
        //conexão
        include_once "conexao.php";
        //menu com o bootstrap declarado
        include_once "menu.php";
        //pegando o id plano pela URL com método GET
        $id_plano = $_GET["id_plano"];
        //consulta tabela
        $sql = "SELECT * FROM plano_contas WHERE id_plano=$id_plano";
        //prepara a consulta com a conexao
        $stmt = $conexao->prepare($sql);
        //executa a query
        $stmt->execute();
        //laço para pegar as variaveis
        while ($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $desc_plano = $array['desc_plano'];
            // $id_plano = $array['id_plano'];
        }
        ?>
        <form action="editar_plano_ok.php" method="post" class="form-group">
            <label for="desc_plano">Descrição</label>
            <!-- Criamos um input invisivel com o valor do is_plano para enviarpelo método post para efetuar o UPDATE-->
            <input type="hidden" id="id" name="id" value="<?php echo $id_plano ?>" class="form-control">
            <input type="text" id="desc_plano" name="desc_plano" value="<?php echo $desc_plano ?>" class="form-control" required>
            <button type="submit" class="btn btn-outline-success">Atualizar</button>
        </form>
    </div>
</body>

</html>