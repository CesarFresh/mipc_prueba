<?php
    require_once("../../db/db.php");
    require_once("../../models/calificaciones_model.php");
    
    $codigo_materia = $_POST['codigo_materia'];
    $codigo_alumno = $_POST['codigo_alumno'];
    $calificacion = $_POST['calificacion'];
    $alificacionesArr = array();

    $calificacion = new calificaciones_model();

    $result = $calificacion->insertCalificaciones($codigo_alumno, $codigo_materia, $calificacion);

    if ($result) {
        $alificacionesArr[] = array(
            'codigo_alumno' => $codigo_alumno,
            'codigo_materia' => $codigo_materia,
            'calificacion' => $calificacion
        );

		echo json_encode($alificacionesArr);
	} 
	else {
        echo "Algo anda mal.";
    }
    
?>