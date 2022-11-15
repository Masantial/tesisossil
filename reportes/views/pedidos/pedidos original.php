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

    <link rel="" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <link rel="" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">


    <style>
    /*estilos para la tabla*/
    table th {
        background-color: #f37f21;
        color: black;
    }

    .dataTables_filter {
        display: none;
    }
    </style>
</head>


<body>
    <header>
        <h2 class="text-center">Pedidos Mensuales</h2>
        <h6 class="text-center">(Se tendrán en cuenta todos los pedidos realizados)</h6>

    </header>
    <br>
    <table align="right" cellspacing="5" cellpadding="5">
        <tbody>
            <tr>
                <td>Fecha Desde:</td>
                <td><input type="text" id="min" name="min"></td>
            </tr>
            <tr>
                <td>Fecha Hasta:</td>
                <td><input type="text" id="max" name="max"></td>
            </tr>
        </tbody>
    </table>
    <div class="table-responsive">
        <table id="pedidos" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Numero Pedido</th>
                    <th>Nombre Cliente</th>
                    <th>DNI/CUIT</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Tipo Envio</th>
                </tr>
            </thead>
            <tbody>
                <?php
$sql = "SELECT
v.NumPedido, CONCAT(c.NombreCompleto,' ',c.Apellido) as Nombre_Cliente, c.NIT, v.TotalPagar, v.Estado, cast(v.Fecha as date) as Fecha, v.TipoEnvio
FROM
venta v
JOIN cliente c ON
c.NIT = v.NIT ";
$result = mysqli_query($conexion, $sql);
while ($mostrar = mysqli_fetch_array($result)) {
?>
                <tr>
                    <td>
                        <?php echo $mostrar['Fecha'] ?>
                    </td>
                    <td>
                        <?php echo $mostrar['NumPedido'] ?>
                    </td>
                    <td>
                        <?php echo $mostrar['Nombre_Cliente'] ?>
                    </td>
                    <td>
                        <?php echo $mostrar['NIT'] ?>
                    </td>
                    <td>$
                        <?php echo $mostrar['TotalPagar'] ?>
                    </td>
                    <td>
                        <?php echo $mostrar['Estado'] ?>
                    </td>

                    <td>
                        <?php echo $mostrar['TipoEnvio'] ?>
                    </td>
                </tr>
                <?php
}
?>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="views/jquery/jquery-3.3.1.min.js"></script>
    <script src="views/popper/popper.min.js"></script>
    <script src="views/bootstrap/js/bootstrap.min.js"></script>
    <!-- datatables JS -->
    <script type="text/javascript" src="views/datatables/datatables.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script type="text/javascript" src="main.js"></script>
    <script src="views/plugins/datatables/jquery.dataTables.min.js"></script>
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


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>


    <script>
    var minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.afnFiltering.push(
        function(settings, data, dataIndex) {
            debugger;

            var min = $('#min').val() == "" ? null : new Date($('#min').val());
            var max = $('#max').val() == "" ? null : new Date($('#max').val());
            var date = new Date(data[5]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        }
    );
    </script>

    <script>
    $(document).ready(function() {
        var table = $('#pedidos').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });

        //Creamos una fila en el head de la tabla y lo clonamos para cada columna
        $('#pedidos thead tr').clone(true).appendTo('#pedidos thead');
        $('#pedidos thead tr:eq(1) th').each(function(i) {
            var title = $(this).text(); //es el nombre de la columna
            $(this).html('<input type="text" placeholder="Buscar ' + title + '" />');
            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

        // Refilter the table
        $('#min, #max').on('change', function() {

            table.draw();
        })
    });
    </script>




</body>

</html>