<?php
    require_once("../../db/db.php");
    require_once("../../models/calificaciones_model.php");
    
    $calificacion = new calificaciones_model();

    $result = $calificacion->getCalificaciones();

    if($result){
        echo json_encode($result);
    } else {
        echo "Algo salio mal :(";
    }

?>