<?php
$conexion = mysqli_connect('localhost', 'root', '', 'store');

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
<link rel="shortcut icon" type="image/x-icon" href="../assets\img\logosolo.png">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ossil Envases | Reportes</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/adminlte.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  
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
        <a onclick="CargarContenido('content-wrapper','views/pedidospendientes.php')" style="cursor:pointer;"class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"> </i></a>
      </div>
    </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
             <!-- small box -->
             <div class="small-box bg-info">
              <div class="inner">
              <?php
         $sql = "SELECT
         SUM(v.TotalPagar) AS Total
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
          <div class="small-box bg-danger">
              <div class="inner">
              <?php
         $sql = "SELECT
         COUNT(p.CodigoProd) as Cantidad
     FROM
         producto p
     WHERE
         p.Stock < 40";
         $result = mysqli_query($conexion, $sql);
          while ($mostrar = mysqli_fetch_array($result)){
         ?>
    <h3><?php echo $mostrar['Cantidad'] ?></h3>
       <?php
             }
        ?> 


                <p>Prod. Poco Stock</p>
              </div>
              
              <div class="icon">
                <i class="ion-ios-minus"></i>
              </div>
              <a onclick="CargarContenido('content-wrapper','consultas/articulosmenosdelmin.php')" style="cursor:pointer;"class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"> </i></a>
            </div>
          </div>
          
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    </div>
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->
    <div>
      
    </div>
    <!-- /.content -->
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
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      
    </div>
    <!-- Default to the left -->
    <strong>&copy;<a>Andines - Masanti</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

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
function CargarContenido(contenedor,contenido){
  $("."+contenedor).load(contenido);
}
</script>
</body>
</html>
