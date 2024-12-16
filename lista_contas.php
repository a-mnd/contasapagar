<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contas a Pagar - Lista</title>
</head>

<body>
    <div class="container">
        <?php
        include_once "conexao.php";
        include_once "menu.php";
        ?>
        <!--Botão para inclusão de novos registros-->
        <a href="cadastrar_contas.php" class="btn btn-outline-dark mt-3"><i class="bi bi-plus"></i>Novo Pagamento de Conta</a>
        <br>
        <br>
        <!--Iniciando com uma tabela, a tabela favorecidos é sobre as contas que com certeza serão ou foram pagos -->
        <form action="baixar_contas_ok.php" method="post">
            <table class="table table-striped table-dark table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição da Conta</th>
                        <th>Data de Vencimento</th>
                        <th>Valor</th>
                        <th>Data de Pagamento</th>
                        <th>Valor Pago</th>
                        <th>Pagamento do Cartão</th>
                        <th>ID Favorecido</th>
                        <th>ID Plano/Conta</th>
                        <th>Edição</th>
                        <th>Exclusão</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM contas_pagar INNER JOIN favorecidos INNER JOIN plano_contas ON contas_pagar.id_favorecido=favorecidos.id_favorecido AND contas_pagar.id_plano=plano_contas.id_plano ORDER BY data_vcto";
                    $preparando = $conexao->prepare($sql);
                    $preparando->execute();
                    $numerador = 0;
                    $tot_lanc = 0;
                    $tot_pago = 0;
                    while ($array = $preparando->fetch(PDO::FETCH_ASSOC)) {
                        $id_conta = $array['id_conta'];
                        $desc_conta = $array['desc_conta'];
                        $id_favorecido = $array['id_favorecido'];
                        $data_vcto = $array['data_vcto'];
                        $valor = $array['valor'];
                        $data_pagto = $array['data_pagto'];
                        $valor_pago = $array['valor_pago'];
                        $id_plano = $array['id_plano'];
                        $pagto_cartao = $array['pagto_cartao'];
                        $nome_favorecido = $array['nome_favorecido'];
                        $desc_plano = $array['desc_plano'];
                    ?>
                        <tr>
                            <?php // criamos um numerador para criar variáveis dinêmicas para baixa por lote
                            $numerador = $numerador + 1;
                            $tot_lanc = $tot_lanc + $valor;
                            $tot_pago = $tot_pago + $valor_pago;
                            ?>
                            <td><?php echo $id_conta; ?></td>
                            <td><?php echo $desc_conta; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($data_vcto)); ?></td>
                            <td><?php echo 'R$' . number_format($valor, 2, ',', '.'); ?></td>
                            <td><?php if (!empty($data_pagto) && $data_pagto != '0000-00-00') {
                                    echo date('d/m/Y', strtotime($data_pagto));
                                } ?></td>
                            <td><?php echo 'R$ ' . number_format($valor_pago, 2, ',', '.'); ?></td>
                            <td><?php echo $pagto_cartao; ?></td>
                            <td><?php echo $nome_favorecido; ?></td>
                            <td><?php echo $desc_plano; ?></td>
                            <td class="btn-outline-warning"><a href="editar_contas.php?id_conta=<?php echo $id_conta ?>" style="text-decoration: none; color:yellow;"><i class="bi bi-pencil"></i>Editar</a></td>
                            <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal" data-id="<?php echo $id_conta ?>"><i class="bi bi-trash"></i>Excluir</a></td>

                            <!--Criamos um input com nome id+numerador invisível que conterá o id do registro do contas a pagar-->

                            <td><input type="hidden" name="<?php echo 'id' . $numerador; ?>" id="<?php echo 'id' . $numerador; ?>" value="<?php echo $id_conta ?>">

                                <input type="hidden" name="<?php echo 'valor' . $numerador; ?>" id="<?php echo 'valor' . $numerador; ?>" value="<?php echo $valor ?>">

                                <!-- checkbox com o nome varia´vel também. Vai se chamar baixa+numerador para que o sistema baixa somente o que foi clicado no próximo form-->

                                <input type="checkbox" name="baixa<?php echo $numerador ?>" id="baixa<?php echo $numerador ?>" value="1">
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <hr>
            <h5>Total Lançado: <?php echo 'R$ ' . number_format($tot_lanc, 2, ',', '.'); ?></h5>
            <h5>Total Pago: <?php echo 'R$ ' . number_format($tot_pago, 2, ',', '.'); ?></h5>
            <h3>Baixa por lotes</h3>
            <input type="hidden" name="total_reg" id="total_reg" value="<?php echo $numerador ?>">
            <label for="data_pagto">Informe a data do pagamento</label>
            <input type="date" name="data_pagto" id="data_pagto" class="form-control">
            <button type="submit" class="btn btn-outline-dark mt-3">Baixa por lote</button>
        </form>
        <!-- Modal de Confirmação -->
        <!-- Começamos com classe modal fade do bootstrap.
            Note o ID: confirmModal -->
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- O Titulo do modal -->
                        <h5 class="modal-title" id="confirmModalLabel">Confirmar Exclusão</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aqui a pergunta de confirmação -->
                        Tem certeza que deseja excluir esta conta?
                    </div>
                    <div class="modal-footer">
                        <!-- se confirmar irá acionar o confirmDelete do script abaixo  -->
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a href="#" id="confirmDelete" class="btn btn-danger">Excluir</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#confirmModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    var href = 'excluir_contas.php?id_conta=' + id;
                    $('#confirmDelete').attr('href', href);
                });
            });
        </script>
    </div>
</body>

</html>