<html>
<?php
include_once "conexao.php";
//QUERY
$sql = "SELECT desc_plano, sum(valor_pago) AS total FROM contas_pagar INNER JOIN plano_contas ON contas_pagar.id_plano=plano_contas.id_plano WHERE contas_pagar.valor_pago <> 0 GROUP BY plano_contas.desc_plano;";
$stmt = $conexao->prepare($sql);
$stmt->execute();

$selectTotais = "SELECT desc_plano, sum(valor_pago) AS total_pago, sum(valor) AS total_geral, (sum(valor) - sum(valor_pago)) AS total_restante FROM contas_pagar INNER JOIN plano_contas ON contas_pagar.id_plano=plano_contas.id_plano GROUP BY plano_contas.desc_plano;";
$comunica = $conexao->prepare($selectTotais);
$comunica->execute();
?>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Tipo de Despesa', 'Valor'],
                <?php
                while ($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $desc_plano = $array['desc_plano'];
                    $total = $array['total'];
                    echo "['$desc_plano', $total],";
                }
                ?>
            ]);

            var options = {
                title: 'Comparativo de despesas',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart_colunas);

        function drawChart_colunas() {
            var data = google.visualization.arrayToDataTable([
                ['Despesas', 'Valor Total Geral', 'Valor Total Pago', 'Valor Total Restante'],
                <?php
                while ($array = $comunica->fetch(PDO::FETCH_ASSOC)) {
                    $desc_plano = $array['desc_plano'];
                    $total_pago = $array['total_pago'];
                    $total_geral = $array['total_geral'];
                    $total_restante = $array['total_restante'];
                    echo "['$desc_plano', $total_geral, $total_pago, $total_restante],";
                }
                ?>
            ]);

            var options = {
                chart: {
                    title: 'Totais',
                    subtitle: 'Geral, Pago e Restantes',
                },
                bars: 'horizontal' // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
</head>

<body onLoad="self.print();">
    <div id="donutchart" style="width: 900px; height: 500px;"></div>
    <hr>
    <div id="barchart_material" style="width: 900px; height: 500px;"></div>
</body>

</html>