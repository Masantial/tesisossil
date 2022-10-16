<?php

class artmasvendcontroller{
    static public function ctrarticulosmasvendidos() {
        $respuesta = artmasvendmodelo ::mdlctrarticulosmasvendidos();
        return $respuesta; 
    }
}