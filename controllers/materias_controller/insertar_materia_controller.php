<?php
    require_once("../../db/db.php");
    require_once("../../models/materia_model.php");
    
    $nombre = $_POST['nombre'];
    $materiaArr = array();

    $materia = new materia_model();

    $result = $materia->insertMateria($nombre);

    if ($result) {
        $materiaArr[] = array(
            'nombre' => $nombre
        );

		echo json_encode($result);
	} 
	else {
        echo "Algo salio mal";
    }
    
?>