<?php
$conexion = mysqli_connect('localhost', 'root', '', 'store');

?>

<!DOCTYPE html>
<html>

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="views/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="main.css">

    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="views/datatables/datatables.min.css" />
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css" href="views/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <!--font awesome con CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">

    <style>
    /*estilos para la tabla*/
    table th {
        background-color: #f37f21;
        color: black;
    }
    </style>
</head>

<body>
    <header>
        <h2 class="text-center">Ranking de Productos más Pedidos Mensual</h2>
    </header>
    <br>


    <div class="table-responsive">
        <table id="articulosmasvendidos" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <!-- <th>Precio Unitario</th>
                    <th>Total</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
$sql = "SELECT
p.CodigoProd,
p.NombreProd,
SUM(d.CantidadProductos) AS cantidad,
p.precio AS Precio_Unitario,
(
    SUM(d.CantidadProductos) * p.Precio
) AS monto
FROM
venta v
JOIN detalle d ON
d.NumPedido = v.NumPedido
JOIN producto p ON
p.CodigoProd = d.CodigoProd
WHERE
v.Estado <> 'Cancelado' AND v.Estado <> 'Pendiente'
GROUP BY
p.CodigoProd
ORDER BY
SUM(d.CantidadProductos)
DESC";
$result = mysqli_query($conexion, $sql);
while ($mostrar = mysqli_fetch_array($result)) {
?>
                <tr>
                    <td>
                        <?php echo $mostrar['CodigoProd'] ?>
                    </td>
                    <td>
                        <?php echo $mostrar['NombreProd'] ?>
                    </td>
                    <td>
                        <?php echo $mostrar['cantidad'] ?>
                    </td>
                    <!-- <td>$
                        <?php echo $mostrar['Precio_Unitario'] ?>
                    </td>
                    <td>$
                        <?php echo $mostrar['monto'] ?>
                    </td> -->
                </tr>
                <?php
}
?>
            </tbody>
        </table>
    </div>
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="views/jquery/jquery-3.3.1.min.js"></script>
    <script src="views/popper/popper.min.js"></script>
    <script src="views/bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="views/datatables/datatables.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="views/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="views/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="views/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="views/plugins/jszip/jszip.min.js"></script>
    <script src="views/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="views/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="views/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="views/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="views/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>

    <script type="text/javascript" src="main.js"></script>


    <script>
    $(document).ready(function() {
        var table = $('#articulosmasvendidos').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });

        //Creamos una fila en el head de la tabla y lo clonamos para cada columna
        $('#articulosmasvendidos thead tr').clone(true).appendTo('#articulosmasvendidos thead');
        $('#articulosmasvendidos thead tr:eq(1) th').each(function(i) {
            var title = $(this).text(); //es el nombre de la columna
            $(this).html('<input type="text" placeholder="Buscar...' + title + '" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });
    });
    </script>
    <script>

    </script>

</body>
<section class="col-lg-7 connectedSortable">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"> Top 10 Cantidades Pedidas</i>

            </h3>
            <div class="card-tools">
                <!-- This will cause the card to maximize when clicked -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                        class="fas fa-expand"></i></button>
                <!-- This will cause the card to collapse when clicked -->
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i></button>
                <!-- This will cause the card to be removed when clicked -->
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                        class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card" width=10vh; height=10vh>
            <canvas id="myChart" style="position: relative; width=10vh; height=10vh"></canvas>
            <script>
            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    datasets: [{
                        label: 'Cantidad Pedida',
                        backgroundColor: ['#6bf1ab', '#63d69f', '#438c6c', '#509c7f', '#1f794e',
                            '#34444c',
                            '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1'
                        ],
                        borderColor: ['black'],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            })



            let urlArtMasVendmensual =
                'http://localhost/Tesis-OssilEnvases/reportes/consultas/productosmasvendidos_mensual.php'
            fetch(urlArtMasVendmensual)
                .then(response => response.json())
                .then(datos => mostrarArtMasVendidosmensual(datos))
                .catch(error => console.log(error))


            const mostrarArtMasVendidosmensual = (articulos) => {
                articulos.forEach(element => {
                    myChart.data['labels'].push(element.NombreProd)
                    myChart.data['datasets'][0].data.push(element.cantidad)
                    myChart.update()
                });
                console.log(myChart.data)
            }
            </script>
        </div>
    </div>
    </div>
</section>

</html>