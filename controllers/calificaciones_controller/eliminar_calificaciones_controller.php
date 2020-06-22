<?php
    require_once("../../db/db.php");
    require_once("../../models/alumno_model.php");

    $id = $_POST['id'];

    $alumno = new alumno_model();

    $result = $alumno->deleteAlumno($id);

    if ($result) {
        echo "Id: ". $id ." eliminado existosamente.";
	} 
	else {
        echo "Algo anda mal.";
    }
?>