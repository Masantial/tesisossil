<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';


$numPediUp=consultasSQL::clean_string($_POST['num-pedido']);



if(consultasSQL::UpdateSQL("venta", "Estado='Cancelado'", "NumPedido='$numPediUp'")){
    echo '<script>
        swal({
          title: "Pedido Cancelado",
          text: "El pedido se cancelo con éxito",
          type: "success",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Aceptar",
          cancelButtonText: "Cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          },
          function(isConfirm) {
          if (isConfirm) {
            location.reload();
          } else {
            location.reload();
          }
        });
    </script>';
}else{
    echo '<script>swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente", "error");</script>';
}