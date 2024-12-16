<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plano de contas - Lista</title>
</head>

<body>
    <div class="container">
        <?php
        include_once "conexao.php";
        include_once "menu.php";
        ?>
        <!--Botão para inclusão de novos registros-->
        <a href="cadastrar_plano.php" class="btn btn-outline-dark mt-3">Novo plano</a>
        <br>
        <br>
        <!--Iniciando com uma tabela-->
        <table class="table table-striped table-dark table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Edição</th>
                    <th>Exclusão</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM plano_contas ORDER BY desc_plano DESC";
                $preparando = $conexao->prepare($sql);
                $preparando->execute();
                while ($array = $preparando->fetch(PDO::FETCH_ASSOC)) {
                    $id_plano = $array['id_plano'];
                    $desc_plano = $array['desc_plano'];
                ?>
                    <tr>
                        <td><?php echo $id_plano; ?></td>
                        <td><?php echo $desc_plano; ?></td>
                        <td class="btn-outline-warning"><a href="editar_plano.php?id_plano=<?php echo $id_plano ?>" style="text-decoration: none; color:yellow;">Editar</a></td>
                        <td><button class="btn btn-danger" data-toggle="modal" data-target="#confirmModal" data-id="<?php echo $id_plano ?>">Excluir</button></td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
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
                        Tem certeza que deseja excluir este plano?
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
                    var href = 'excluir_plano.php?id_plano=' + id;
                    $('#confirmDelete').attr('href', href);
                });
            });
        </script>
    </div>
</body>

</html>