<?php
    require_once("../../db/db.php");
    require_once("../../models/materia_model.php");

    $id = $_POST['id'];

    $materia = new materia_model();

    $result = $materia->deleteMateria($id);

    if ($result) {
        echo "Id: ". $id ." eliminado existosamente.";
	} 
	else {
        echo "Algo anda mal.";
    }
?>