<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorecidos - Editar</title>
</head>

<body>
    <div class="container">
        <?php
        //conexão
        include_once "conexao.php";
        //menu com o bootstrap declarado
        include_once "menu.php";
        //pegando o id plano pela URL com método GET
        $id_favorecido = $_GET["id_favorecido"];
        //consulta tabela
        $sql = "SELECT * FROM favorecidos WHERE id_favorecido=$id_favorecido";
        //prepara a consulta com a conexao
        $stmt = $conexao->prepare($sql);
        //executa a query
        $stmt->execute();
        //laço para pegar as variaveis
        while ($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $nome_favorecido = $array['nome_favorecido'];
            $email = $array['email'];
            $celular = $array['celular'];
        }
        ?>
        <form action="editar_favorecido_ok.php" method="post" class="form-group">
            <label for="nome_favorecido">Descrição</label>
            <!-- Criamos um input invisivel com o valor do is_plano para enviarpelo método post para efetuar o UPDATE-->
            <input type="hidden" id="id" name="id" value="<?php echo $id_favorecido ?>" class="form-control">
            <input type="text" id="nome_favorecido" name="nome_favorecido" value="<?php echo $nome_favorecido ?>" class="form-control" required>
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" value="<?php echo $email ?>" class="form-control">
            <label for="celular">Celular</label>
            <input type="text" id="celular" name="celular" value="<?php echo $celular ?>" class="form-control">
            <button type="submit" class="btn btn-outline-success mt-3">Atualizar</button>
        </form>
    </div>
</body>

</html>