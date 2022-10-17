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
      $sql = $conexion->prepare("Select distinct p.CodigoProd,P.NombreProd,P.Marca,P.Costo,D.PrecioProd as PrecioVenta,
      (select sum(D1.cantidadProductos) from detalle d1 where d1.CodigoProd = P.CodigoProd) as CantidadesVendidas,
      (select sum(D1.cantidadProductos)  from detalle d1 where d1.CodigoProd = P.CodigoProd)*P.Costo as CostoTotal,
      (select sum(D1.cantidadProductos)  from detalle d1 where d1.CodigoProd = P.CodigoProd)*D.PrecioProd as PrecioTotal,
      cast(
      ((((select sum(D2.cantidadProductos)  from detalle d2 where d2.CodigoProd = P.CodigoProd)*D.PrecioProd)) - ((select sum(D2.cantidadProductos)  from detalle d2 where d2.CodigoProd = P.CodigoProd)*P.Costo))  as Double) as MontoGanancia
      from producto p
      inner join detalle D on P.codigoProd = D.CodigoProd");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
      exit();
    }
    else{      
      $sql = $conexion->prepare("Select distinct p.CodigoProd,P.NombreProd,P.Marca,P.Costo,D.PrecioProd as PrecioVenta,
      (select sum(D1.cantidadProductos) from detalle d1 where d1.CodigoProd = P.CodigoProd) as CantidadesVendidas,
      (select sum(D1.cantidadProductos)  from detalle d1 where d1.CodigoProd = P.CodigoProd)*P.Costo as CostoTotal,
      (select sum(D1.cantidadProductos)  from detalle d1 where d1.CodigoProd = P.CodigoProd)*D.PrecioProd as PrecioTotal,
      cast(
      ((((select sum(D2.cantidadProductos)  from detalle d2 where d2.CodigoProd = P.CodigoProd)*D.PrecioProd)) - ((select sum(D2.cantidadProductos)  from detalle d2 where d2.CodigoProd = P.CodigoProd)*P.Costo))  as Double) as MontoGanancia
      from producto p
      inner join detalle D on P.codigoProd = D.CodigoProd");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll());
      exit();
    }
}

header("HTTP/1.1 400 Peticion HTTP inexistente");
?>