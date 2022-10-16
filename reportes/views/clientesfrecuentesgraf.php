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
        <h2 class="text-center">Clientes Frecuentes</h2>
        <h6 class="text-center">(Se listarán los clientes que tengan al menos 10 pedidos enviados o entregados en su historial)</h6>

    </header>
    <br>


    <div class="table-responsive">
        <table id="clientesfrecuentesgraf" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID/DNI</th>
                    <th>Nombre Cliente</th>
                    <th>Monto Pedidos</th>
                    <th>Cantidad Pedidos</th>
                </tr>
            </thead>
            <tbody>
                <?php
$sql = "SELECT
c.NIT AS DNI,
CONCAT(c.NombreCompleto, ' ', c.Apellido) AS Nombre_Cliente,
(
    SUM(d.CantidadProductos) * p.Precio
) AS Monto,
COUNT(v.NumPedido) AS Cant_Pedidos
FROM
venta v
JOIN detalle d ON
d.NumPedido = v.NumPedido
JOIN cliente c ON
c.NIT = v.NIT
JOIN producto p ON
p.CodigoProd = d.CodigoProd
WHERE
v.Estado <> 'Cancelado'
GROUP BY
1
HAVING
Cant_Pedidos >= 10
ORDER BY
c.NombreCompleto
DESC

";
$result = mysqli_query($conexion, $sql);
while ($mostrar = mysqli_fetch_array($result)) {
    ?>
                <tr>
                    <td><?php echo $mostrar['DNI'] ?></td>
                    <td><?php echo $mostrar['Nombre_Cliente'] ?></td>
                    <td>$<?php echo $mostrar['Monto'] ?></td>
                    <td><?php echo $mostrar['Cant_Pedidos'] ?></td>
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
        var table = $('#clientesfrecuentesgraf').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        //Creamos una fila en el head de la tabla y lo clonamos para cada columna
        $('#clientesfrecuentesgraf thead tr').clone(true).appendTo('#clientesfrecuentesgraf thead');

        $('#clientesfrecuentesgraf thead tr:eq(1) th').each(function(i) {
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

<section class="col-lg-6 connectedSortable">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Cantidad de Pedidos por Cliente
            </h3>
        </div><!-- /.card-header -->
        <div class="card-body">

            <div class="tab-content p-0">
                <canvas id="myChart" style="position: relative"></canvas>
                <script>
                var ctx = document.getElementById('myChart');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        datasets: [{
                            label: 'Cantidad',
                            backgroundColor: ['#6bf1ab', '#64B5F6', '#438c6c', '#34444c', '#1f794e',
                                '#34444c', '#90CAF9', '#63d69f', '#42A5F5', '#2196F3', '#0D47A1'
                            ],
                            borderColor: ['black'],
                            borderWidth: 1,
                            fill: false
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



                let urlClientesFrec = 'http://localhost/Tesis-OssilEnvases/reportes/consultas/clientesfreccantped.php'
                fetch(urlClientesFrec)
                    .then(response => response.json())
                    .then(datos => mostrarClientesFrec(datos))
                    .catch(error => console.log(error))


                const mostrarClientesFrec = (articulos) => {
                    articulos.forEach(element => {
                        myChart.data['labels'].push(element.Nombre_Cliente)
                        myChart.data['datasets'][0].data.push(element.Cant_Pedidos)
                        myChart.update()
                    });
                    console.log(myChart.data)
                }
                </script>

            </div>
        </div>
    </div>
</section>
<section class="col-lg-7 connectedSortable">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Monto Total por Cliente
            </h3>
        </div><!-- /.card-header -->
        <div class="card-body">

            <div class="tab-content p-0">
                <canvas id="myChart2" style="position: relative"></canvas>
                <script>
                var ctx = document.getElementById('myChart2');
                var myChart2 = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: 'Total por Cliente',
                            backgroundColor: ['#6bf1ab', '#64B5F6', '#438c6c', '#34444c', '#1f794e',
                                '#34444c', '#90CAF9', '#63d69f', '#42A5F5', '#2196F3', '#0D47A1'
                            ],
                            borderColor: ['black'],
                            borderWidth: 1,
                            fill: false
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



                let urlClientesFrecmonto =
                    'http://localhost/Tesis-OssilEnvases/reportes/consultas/clientesfreccantped.php'
                fetch(urlClientesFrecmonto)
                    .then(response => response.json())
                    .then(datos => mostrarClientesFrecmonto(datos))
                    .catch(error => console.log(error))


                const mostrarClientesFrecmonto = (articulos) => {
                    articulos.forEach(element => {
                        myChart2.data['labels'].push(element.Nombre_Cliente)
                        myChart2.data['datasets'][0].data.push(element.Monto)
                        myChart2.update()
                    });
                    console.log(myChart2.data)
                }
                </script>

            </div>
        </div>
    </div>
</section>


</html>