<?php
    require_once("../../db/db.php");
    require_once("../../models/alumno_model.php");
    
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fechaNac = $_POST['fechaNac'];
    $alumnoArr = array();

    $alumno = new alumno_model();

    $result = $alumno->insertAlumno($nombre, $apellidos, $fechaNac);

    if ($result) {
        $alumnoArr[] = array(
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'fechaNac' => $fechaNac
        );

		echo json_encode($alumnoArr);
	} 
	else {
        echo "Algo anda mal.";
    }
    
?>