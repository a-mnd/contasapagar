<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contas a Pagar - Inclusão</title>
</head>

<body>
    <div class="container">
        <?php
        include_once "conexao.php";
        include_once "menu.php";
        ?>
        <form action="cadastrar_contas_ok.php" method="post" class="form-group">
            <label for="desc_conta">Descrição da Conta</label>
            <input type="text" id="desc_conta" name="desc_conta" class="form-control" required>
            <label for="data_vcto">Data de Vencimento</label>
            <input type="date" id="data_vcto" name="data_vcto" class="form-control">
            <label for="valor">Valor</label>
            <input type="text" id="valor" name="valor" class="form-control">
            <label for="id_favorecido">Favorecido</label>
            <select name="id_favorecido" id="id_favorecido" class="form-control">
                <option value="0">-- Selecione um Favorecido --</option>
                <?php
                $sql = "SELECT * FROM favorecidos ORDER BY nome_favorecido";
                $stmt =  $conexao->prepare($sql);
                $stmt->execute();
                while ($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id_favorecido = $array['id_favorecido'];
                    $nome_favorecido = $array['nome_favorecido'];
                ?>
                    <option value="<?php echo $id_favorecido; ?>"><?php echo $nome_favorecido; ?></option>
                <?php
                }
                ?>
            </select>
            <label for="id_plano">Tipo de Pagamento</label>
            <select name="id_plano" id="id_plano" class="form-control">
                <option value="0">-- Selecione um Tipo de Pagamento --</option>
                <?php
                $sql = "SELECT * FROM plano_contas ORDER BY desc_plano";
                $stmt =  $conexao->prepare($sql);
                $stmt->execute();
                while ($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id_plano = $array['id_plano'];
                    $desc_plano = $array['desc_plano'];
                ?>
                    <option value="<?php echo $id_plano; ?>"><?php echo $desc_plano; ?></option>
                <?php
                }
                ?>
            </select>
            <button type="submit" class="btn btn-outline-success mt-3">Cadastrar</button>
        </form>
    </div>
</body>

</html>