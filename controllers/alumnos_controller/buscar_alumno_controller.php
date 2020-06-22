<?php
    require_once("../../db/db.php");
    require_once("../../models/alumno_model.php");
    
    $alumnos = new alumno_model();

    $codigoAlumno = $_POST['id'];

    $result = $alumnos->searchAlumno($codigoAlumno);

    if($result){
        echo json_encode($result);
    } else {
        echo "Algo salio mal :(";
    }

?>