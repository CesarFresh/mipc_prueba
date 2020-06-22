<?php
    require_once("../../db/db.php");
    require_once("../../models/alumno_model.php");
    
    $alumnos = new alumno_model();

    $result = $alumnos->getAlumnos();

    if($result){
        echo json_encode($result);
    } else {
        echo "Algo salio mal :(";
    }

?>