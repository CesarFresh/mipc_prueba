<?php
    require_once("../../db/db.php");
    require_once("../../models/materia_model.php");

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $materiaArr = array();

    $materia = new materia_model();

    $result = $materia->setMateria($id, $nombre);

    if ($result) {
        $materiaArr[] = array(
            'id' => $id,
            'nombre' => $nombre
        );

        echo json_encode($materiaArr);
	} 
	else {
        echo "Algo anda mal.";
    }
?>