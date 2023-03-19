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
      v.Estado = 'Enviado' or v.Estado = 'Entregado' AND MONTH(v.fecha) BETWEEN(
EXTRACT(MONTH
FROM
CURRENT_DATE) -5
) AND EXTRACT(MONTH
FROM
CURRENT_DATE)
      GROUP BY
      1
      HAVING
      Cant_Pedidos >= 10
      ORDER BY
      c.NombreCompleto
      DESC;
      ");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
      exit();
    }
    else{      
      $sql = $conexion->prepare("SELECT
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
      v.Estado = 'Enviado' or v.Estado = 'Entregado' AND MONTH(v.fecha) BETWEEN(
EXTRACT(MONTH
FROM
CURRENT_DATE) -5
) AND EXTRACT(MONTH
FROM
CURRENT_DATE)
      GROUP BY
      1
      HAVING
      Cant_Pedidos >= 10
      ORDER BY
      c.NombreCompleto
      DESC;
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