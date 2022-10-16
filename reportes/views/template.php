<?php
$conexion = mysqli_connect('localhost', 'root', '', 'store');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="../assets\img\logosolo.png">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ossil Envases | Reportes</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/adminlte.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">


        <?php
 include "views/modules/navbar.php";
 include "views/modules/aside.php";
 ?>
 

        <!-- Content Wrapper. Contains page content -->
        <div class="content">
            <div class="content-wrapper">
                <section class="content">
                

<div class= "text-center">
    <h5>Los valores expresados en esta pantalla hacen referencia al día de la fecha.</h5>
</div>


                    <div class="container-fluid">
                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <?php
         $sql = "SELECT
         count(v.NumPedido) as Cantidad
         FROM
         venta v
          where str_to_date(left(v.Fecha,10), '%d-%m-%Y') >= CURRENT_DATE";
         $result = mysqli_query($conexion, $sql);
          while ($mostrar = mysqli_fetch_array($result)){
         ?>
                                        <h3><?php echo $mostrar['Cantidad'] ?></h3>
                                        <?php
             }
        ?>
                                        <p> Pedidos Nuevos</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion-android-cart"></i>
                                    </div>
                                    <a onclick="CargarContenido('content-wrapper','views/pedidospendientes.php')"
                                        style="cursor:pointer;" class="small-box-footer">Mas info <i
                                            class="fas fa-arrow-circle-right"> </i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <?php
         $sql = "SELECT Coalesce(
         SUM(v.TotalPagar),0) AS Total
     FROM
         venta v
     WHERE
         STR_TO_DATE(LEFT(v.Fecha, 10),
         '%d-%m-%Y') >= CURRENT_DATE ";
         $result = mysqli_query($conexion, $sql);
          while ($mostrar = mysqli_fetch_array($result)){
         ?>
                                        <h3>$<?php echo $mostrar['Total'] ?></h3>
                                        <?php
             }
        ?>

                                        <p>Monto Total Diario</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion-cash"></i>
                                    </div>
                                    <a href="#" class="small-box-footer"> <i class="fas "></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-secondary">
                                    <div class="inner">
                                        <?php
         $sql = "SELECT
         SUM(d.CantidadProductos) AS cantidad
     FROM
         detalle d
     INNER JOIN venta v ON
         v.NumPedido = d.NumPedido
     WHERE
         STR_TO_DATE(LEFT(v.Fecha, 10),
         '%d-%m-%Y') >= CURRENT_DATE";
         $result = mysqli_query($conexion, $sql);
          while ($mostrar = mysqli_fetch_array($result)){
         ?>
                                        <h3><?php echo $mostrar['cantidad'] ?></h3>
                                        <?php
             }
        ?>


                                       <p>Total de productos pedidos</p>
                                    </div>

                                    <div class="icon">
                                        <i class="ion-ios-minus"></i>
                                    </div>
                                    <a onclick=""
                                        style="cursor:pointer;" class="small-box-footer"><i
                                            class="fas fa-arrow"> </i></a>
                                </div>
                            </div>

                            <!-- ./col -->
                        </div>
                        

                    </div>
                    <!-- /.content-wrapper -->

                    <!-- Control Sidebar -->
                    <aside class="control-sidebar control-sidebar-dark">
                        <!-- Control sidebar content goes here -->
                        <div class="p-3">
                            <h5>Title</h5>
                            <p>Sidebar content</p>
                        </div>
                    </aside>
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="card">
                                <div class="card-header">
                                <div class="card-tools">
      <!-- This will cause the card to maximize when clicked -->
      <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
      <!-- This will cause the card to collapse when clicked -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <!-- This will cause the card to be removed when clicked -->
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Monto total de pedidos del día
                                    </h3>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content p-0">
                                        <canvas id="myChart" style="position: relative"></canvas>
                                        <script>
                                        var ctx = document.getElementById('myChart');
                                        var myChart = new Chart(ctx, {
                                            type: 'line',
                                            data: {
                                                datasets: [{
                                                    label: 'Monto Total',                                                  
                                                    backgroundColor: ['#c2863e'],
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


                                        let url =
                                            'http://localhost/Tesis-OssilEnvases/reportes/consultas/montoporpedidodiario.php'
                                        fetch(url)
                                            .then(response => response.json())
                                            .then(datos => mostrar(datos))
                                            .catch(error => console.log(error))


                                        const mostrar = (articulos) => {
                                            articulos.forEach(element => {
                                                myChart.data['labels'].push(element.NumPedido)
                                                myChart.data['datasets'][0].data.push(element.TotalPagar)
                                                myChart.update()
                                            });
                                            console.log(myChart.data);
                                        }
                                        </script>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                        </section>
                        <section>
                        <div class="card">
                        <div class="card-header">
<h3 class="card-title">Total de Productos Pedidos</h3>

<div class="card-tools">
  <button type="button" class="btn btn-tool" data-card-widget="collapse">
    <i class="fas fa-minus"></i>
  </button>
  <button type="button" class="btn btn-tool" data-card-widget="remove">
    <i class="fas fa-times"></i>
  </button>
</div>
</div>
<!-- /.card-header -->
<div class="card-body p-0">
<ul class="products-list product-list-in-card pl-2 pr-2">
  <li class="item">
  <div class="table-responsive">
<table id="articulosmenosdelmin" class="table table-striped table-bordered" style="width:100%">
<thead>
<tr>
<th>Codigo</th>
<th>Descripcion</th>
<th>Cantidad</th>

</tr>
</thead>
<tbody>
<?php
$sql = "SELECT
p.CodigoProd AS codigo,
p.NombreProd AS Descripcion,
SUM(d.CantidadProductos) AS total
FROM
detalle d
LEFT JOIN producto p ON
p.CodigoProd = d.CodigoProd
INNER JOIN venta v ON
v.NumPedido = d.NumPedido
WHERE
STR_TO_DATE(LEFT(v.Fecha, 10),
'%d-%m-%Y') >= CURRENT_DATE
GROUP BY
1,
2";
$result = mysqli_query($conexion, $sql);
while ($mostrar = mysqli_fetch_array($result)) {
?>
<tr>
<td><?php echo $mostrar['codigo'] ?></td>
<td><?php echo $mostrar['Descripcion'] ?></td>
<td><?php echo $mostrar['total'] ?></td>
</tr>
<?php
}
?>
</tbody>
<tfoot>
</tfoot>
</table>
    </div>
  
  <!-- /.item -->
  
  <!-- /.item -->
</ul>
</div>
<!-- /.card-body -->
<div class="card-footer text-center">
<a href="consultas/articulosmenosdelmin.php" class="uppercase">View All Products</a>
</div>
<!-- /.card-footer -->
</div>
                        </section>
                    </div>

                    
                    




                    <!-- REQUIRED SCRIPTS -->

                    <!-- jQuery -->
                    <script src="views/plugins/jquery/jquery.min.js"></script>
                    <!-- Bootstrap 4 -->
                    <script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <!-- ChartJS -->
                    <script src="views/plugins/chart.js/Chart.min.js"></script>
                    <!-- AdminLTE App -->
                    <script src="views/dist/js/adminlte.min.js"></script>

                    <script>
                    function CargarContenido(contenedor, contenido) {
                        $("." + contenedor).load(contenido);
                    }
                    </script>
            </div>
        </div>
    </div>
    

</body>
<footer>
    <strong>&copy;<a> Andines - Masanti</a>.</strong>
</footer>

</html>