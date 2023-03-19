<?php
include "db/parametros.php";
function permisos() {  
  if (isset($_SERVER['HTTP_ORIGIN'])){
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
      header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
      header('Access-Control-Allow-Credentials: true');      
  }  
  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))          
        header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
    exit(0);
  }
}
permisos();
$conexion =  Conectar($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['id'])) {      
      $sql = $conexion->prepare("SELECT
      p.CodigoProd,
      p.NombreProd,
      SUM(d.CantidadProductos) AS cantidad,
      EXTRACT(MONTH
      FROM
      v.Fecha) AS Mes
      FROM
      venta v
      JOIN detalle d ON
      d.NumPedido = v.NumPedido
      JOIN producto p ON
      p.CodigoProd = d.CodigoProd
      WHERE
      v.Estado <> 'Cancelado' AND v.Estado <> 'Pendiente' AND MONTH(v.fecha) BETWEEN(
          EXTRACT(MONTH
      FROM
          CURRENT_DATE) -5
      ) AND EXTRACT(MONTH
      FROM
      CURRENT_DATE)
      GROUP BY
      1,
      2,
      4
  LIMIT 10
  
      ");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
      exit();
    }
    else{      
      $sql = $conexion->prepare("SELECT
      p.CodigoProd,
      p.NombreProd,
      SUM(d.CantidadProductos) AS cantidad,
      EXTRACT(MONTH
      FROM
      v.Fecha) AS Mes
      FROM
      venta v
      JOIN detalle d ON
      d.NumPedido = v.NumPedido
      JOIN producto p ON
      p.CodigoProd = d.CodigoProd
      WHERE
      v.Estado <> 'Cancelado' AND v.Estado <> 'Pendiente' AND MONTH(v.fecha) BETWEEN(
          EXTRACT(MONTH
      FROM
          CURRENT_DATE) -5
      ) AND EXTRACT(MONTH
      FROM
      CURRENT_DATE)
      GROUP BY
      1,
      2,
      4
  LIMIT 10
  
      ");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll());
      exit();
    }
}

header("HTTP/1.1 400 Peticion HTTP inexistente");
?>