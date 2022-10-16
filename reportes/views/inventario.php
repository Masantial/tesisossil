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
    <link rel="stylesheet" type="text/css" href="views/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet"  type="text/css" href="views/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <!--font awesome con CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
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
         <h2 class="text-center">Inventario Valorizado</h2>
         <h6 class="text-center">(Según existencia actual y costo de reposicion actual)</h6>
        
     </header>  
<br>



<table id="inventario" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
			    <th>Codigo Articulo</th>
			    <th>Descripcion</th>
                <th>Marca</th>
			    <th>Categoria</th>
                <th>Stock</th>
                <th>Costo</th>                
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
		<?php
$sql = "SELECT
p.CodigoProd,
p.NombreProd,
p.marca,
c.Nombre,
p.Costo,
p.Stock,
(p.Costo * p.Stock) AS Valor
FROM
producto p
JOIN categoria c ON
c.CodigoCat = p.CodigoCat
WHERE
p.Stock > 0
GROUP BY
p.NombreProd
ORDER BY
p.NombreProd
DESC


";
$result = mysqli_query($conexion, $sql);
while ($mostrar = mysqli_fetch_array($result)) {
    ?>
            <tr>
                <td><?php echo $mostrar['CodigoProd'] ?></td>
                <td><?php echo $mostrar['NombreProd'] ?></td>
                <td><?php echo $mostrar['marca'] ?></td>
                <td><?php echo $mostrar['Nombre'] ?></td>
                <td><?php echo $mostrar['Stock'] ?></td>
                <td>$<?php echo $mostrar['Costo'] ?></td>                
                <td>$<?php echo $mostrar['Valor'] ?></td>
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
   $(document).ready(function(){
    var table = $('#inventario').DataTable({
       orderCellsTop: true,
       fixedHeader: true,
       dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    //Creamos una fila en el head de la tabla y lo clonamos para cada columna
    $('#inventario thead tr').clone(true).appendTo( '#inventario thead' );

    $('#inventario thead tr:eq(1) th').each( function (i) {
        var title = $(this).text(); //es el nombre de la columna
        $(this).html( '<input type="text" placeholder="Buscar...'+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );  
    });

</script>
<script>
   
</script>
</body>

</html>

