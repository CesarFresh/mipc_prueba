<?php
    require_once("../../db/db.php");
    require_once("../../models/materia_model.php");
    
    $materias = new materia_model();

    $result = $materias->getMaterias();

    if($result){
        echo json_encode($result);
    } else {
        echo "Algo salio mal :(";
    }

?>