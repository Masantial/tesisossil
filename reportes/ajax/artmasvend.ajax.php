<?php
require_once "../controllers/artmasvend.controller.php";
require_once "../models/artmasvend.modelo.php";

class AjaxArtmasvend{
    public function articulosmasvendidos(){

     $respuesta = artmasvendcontroller::ctrarticulosmasvendidos();   
     echo json_encode($respuesta)     ;
    }
}

$articulos = new AjaxArtmasvend();
$articulos -> articulosmasvendidos();