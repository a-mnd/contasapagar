<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorecidos - Inclusão</title>
</head>

<body>
    <div class="container">
        <?php
        include_once "conexao.php";
        include_once "menu.php";
        ?>
        <form action="cadastrar_favorecido_ok.php" method="post" class="form-group">
            <label for="nome_favorecido">Descrição</label>
            <input type="text" id="nome_favorecido" name="nome_favorecido" class="form-control" required>
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" class="form-control">
            <label for="celular">Celular</label>
            <input type="text" id="celular" name="celular" class="form-control">
            <button type="submit" class="btn btn-outline-success mt-3">Cadastrar</button>
        </form>
    </div>
</body>

</html>