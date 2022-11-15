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
        <h2 class="text-center">Porcentaje Ganancia Neta Semestral</h2>
        <h6 class="text-center">(Se tendrán en cuenta todos los pedidos realizados)</h6>

    </header>
    <br>

    <div class="card">
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="GananciaNeta" class="table table-striped table-bordered" style="width:85%">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Marca</th>
                            <th>Costo Unitario</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad Vendida</th>
                            <th>Costo Total</th>
                            <th>Venta Total</th>
                            <th>Margen ganancia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "Select distinct p.CodigoProd,P.NombreProd,P.Marca,P.Costo,D.PrecioProd as PrecioVenta,
                        (select sum(D1.cantidadProductos) from detalle d1 where d1.CodigoProd = P.CodigoProd) as CantidadesVendidas,
                        (select sum(D1.cantidadProductos)  from detalle d1 where d1.CodigoProd = P.CodigoProd)*P.Costo as CostoTotal,
                        (select sum(D1.cantidadProductos)  from detalle d1 where d1.CodigoProd = P.CodigoProd)*D.PrecioProd as PrecioTotal,
                        cast((
                        ((((select sum(D2.cantidadProductos)  from detalle d2 where d2.CodigoProd = P.CodigoProd)*D.PrecioProd)) / ((select sum(D2.cantidadProductos)  from detalle d2 where d2.CodigoProd = P.CodigoProd)*P.Costo)) * 100) as Double) as PorcentajeGanancia
                        from producto p
                        inner join detalle D on P.codigoProd = D.CodigoProd
                        inner join venta v on v.NumPedido = D.NumPedido 
                        where v.Estado not in ('Cancelado','Pendiente','En Preparacion')";                     

                        $result = mysqli_query($conexion, $sql);
                        while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $mostrar['CodigoProd'] ?></td>
                            <td><?php echo $mostrar['NombreProd'] ?></td>
                            <td><?php echo $mostrar['Marca'] ?></td>
                            <td>$<?php echo $mostrar['Costo'] ?></td>
                            <td>$<?php echo $mostrar['PrecioVenta'] ?></td>
                            <td><?php echo $mostrar['CantidadesVendidas'] ?></td>
                            <td>$<?php echo $mostrar['CostoTotal'] ?></td>
                            <td>$<?php echo $mostrar['PrecioTotal'] ?></td>
                            <td><?php echo $mostrar['PorcentajeGanancia'] ?>%</td>

                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

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
                    var table = $('#GananciaNeta').DataTable({
                        orderCellsTop: true,
                        fixedHeader: true,
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    });

                    //Creamos una fila en el head de la tabla y lo clonamos para cada columna
                    $('#GananciaNeta thead tr').clone(true).appendTo('#GananciaNeta thead');

                    $('#GananciaNeta thead tr:eq(1) th').each(function(i) {
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
</body>
</div>
</div>
<div class="card">
    <canvas id="myChart" style="position: relative; width=10vh; height=10vh"></canvas>
    <script>
    var ctx = document.getElementById('myChart');
    var GananciaNeta = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Margen por Producto',
                backgroundColor: ['#34444c'],
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


    let urlGananciaNeta_Semestral = 'http://localhost/Tesis-OssilEnvases/reportes/consultas/GananciaNeta.php'
    fetch(urlGananciaNeta_Semestral)
        .then(response => response.json())
        .then(datos => mostrarGananciaNeta_Semestral(datos))
        .catch(error => console.log(error))


    const mostrarGananciaNeta_Semestral = (articulos) => {
        articulos.forEach(element => {
            GananciaNeta.data['labels'].push(element.NombreProd)
            GananciaNeta.data['datasets'][0].data.push(element.PorcentajeGanancia)
            GananciaNeta.update()
        });
        console.log(myChart.data)
    }
    </script>
</div>

</html>