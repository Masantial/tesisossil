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
      v.NumPedido,
      c.NombreCompleto AS Nombre,
      c.Apellido,
      c.NIT,
      v.TotalPagar,
      v.Estado,
      COUNT(v.Estado) AS cantidad_pedidos,
      v.Fecha,
      v.TipoEnvio
  FROM
      venta v
  JOIN cliente c ON
      c.NIT = v.NIT
  GROUP BY
      v.Estado
      ");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
      exit();
    }
    else{      
      $sql = $conexion->prepare("SELECT
      v.NumPedido,
      c.NombreCompleto AS Nombre,
      c.Apellido,
      c.NIT,
      v.TotalPagar,
      v.Estado,
      COUNT(v.Estado) AS cantidad_pedidos,
      v.Fecha,
      v.TipoEnvio
  FROM
      venta v
  JOIN cliente c ON
      c.NIT = v.NIT
  GROUP BY
      v.Estado
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