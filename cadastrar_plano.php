<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plano de Contas - Inclusão</title>
</head>

<body>
    <div class="container">
        <?php
        include_once "conexao.php";
        include_once "menu.php";
        ?>
        <form action="cadastrar_plano_ok.php" method="post" class="form-group">
            <label for="desc_plano">Descrição</label>
            <input type="text" id="desc_plano" name="desc_plano" class="form-control" required>
            <button type="submit" class="btn btn-outline-success mt-3">Cadastrar</button>
        </form>
    </div>
</body>

</html>