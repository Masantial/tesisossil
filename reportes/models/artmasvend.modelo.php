<?php
include './library/configServer.php';
include './library/consulSQL.php';

class Artmasvendmodelo {
    static public function mdlarticulosmasvendidos(){
        $stmt = consultasSQL :: consultar-> prepare( "CALL prc_articulosmasvendidos");
        $stmt -> execute ();
        return $stmt -> fetchall();
        $stmt = null;


    }

}