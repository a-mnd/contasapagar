<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contas a Pagar - Editar</title>
</head>

<body>
    <div class="container">
        <?php
        //conexão
        include_once "conexao.php";
        //menu com o bootstrap declarado
        include_once "menu.php";
        //pegando o id plano pela URL com método GET
        $id_conta = $_GET["id_conta"];
        //consulta tabela
        $sql = "SELECT * FROM contas_pagar WHERE id_conta=$id_conta";
        //prepara a consulta com a conexao
        $stmt = $conexao->prepare($sql);
        //executa a query
        $stmt->execute();
        //laço para pegar as variaveis
        while ($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id_conta = $array['id_conta'];
            $desc_conta = $array['desc_conta'];
            $favorecido = $array['id_favorecido'];
            $data_vcto = $array['data_vcto'];
            $valor = $array['valor'];
            $data_pagto = $array['data_pagto'];
            $valor_pago = $array['valor_pago'];
            $plano = $array['id_plano'];
            $pagto_cartao = $array['pagto_cartao'];
        }
        ?>
        <form action="editar_contas_ok.php" method="post" class="form-group">
            <label for="desc_conta">Descrição da Conta</label>
            <input type="hidden" id="id" name="id" value="<?php echo $id_conta ?>" class="form-control">
            <input type="text" id="desc_conta" name="desc_conta" value="<?php echo $desc_conta ?>" class="form-control" required>
            <label for="data_vcto">Data de Vencimento</label>
            <input type="date" id="data_vcto" name="data_vcto" value="<?php echo $data_vcto ?>" class="form-control">
            <label for="valor">Valor</label>
            <input type="text" id="valor" name="valor" value="<?php echo $valor ?>" class="form-control">
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
                    <option value="<?php echo $id_favorecido; ?>"<?= ($favorecido == $id_favorecido)? 'selected':''?>><?php echo $nome_favorecido; ?></option>
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
                    <option value="<?php echo $id_plano; ?>" <?= ($plano == $id_plano)? 'selected':''?>><?php echo $desc_plano; ?></option>
                <?php
                }
                ?>
            </select>
            <label for="data_pagto">Data de Pagamento</label>
            <input type="date" id="data_pagto" name="data_pagto" class="form-control">
            <label for="valor_pago">Valor Pago</label>
            <input type="text" id="valor_pago" name="valor_pago" class="form-control">
            <label for="pagto_cartao">Pagamento com Cartão, se sim clicar</label>

            <input type="checkbox" id="pagto_cartao" name="pagto_cartao" <?php if($pagto_cartao == 1){ echo "checked='checked'";}?> value ="1" class="form-control">  


            <button type="submit" class="btn btn-outline-success mt-3">Atualizar</button>
        </form>
    </div>
</body>

</html>