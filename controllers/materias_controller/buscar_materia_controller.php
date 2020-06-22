<?php
    require_once("../../db/db.php");
    require_once("../../models/materia_model.php");
    
    $materia = new materia_model();

    $codigoMateria = $_POST['id'];

    $result = $materia->searchMateria($codigoMateria);

    if($result){
        echo json_encode($result);
    } else {
        echo "Algo salio mal :(";
    }

?>