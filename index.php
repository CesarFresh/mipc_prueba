<?php
    require_once("db/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Calificaciones</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Sistema Calificaciones</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item pointer">
                    <a class="nav-link route" id="alumnos" onclick="simpleRouting(this.text)">Alumnos</a>
                </li>
                <li class="nav-item pointer">
                    <a class="nav-link route" id="materias" onclick="simpleRouting(this.text)">Materias</a>
                </li>
                <li class="nav-item pointer">
                    <a class="nav-link route" id="calificaciones" onclick="simpleRouting(this.text)">Calificaciones</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container p-5">
        <div id="alumnos_container">
            <?php
                require_once("views/alumnos_view.php");
            ?>
        </div>
        <div id="materia_container">
            <?php
                require_once("views/materia_view.php");
            ?>
        </div>
        <div id="calificaciones_container">
            <?php
                //require_once("views/calificaciones_view.php");
            ?>
        </div>

    </div>
</body>
</html>
<script>
    $(()=>{
        $("#alumnos_container").show();
        $("#materia_container").hide();
        $("#calificaciones_container").hide();
    });
    function simpleRouting(route){

        switch (route) {
            case "Alumnos":
                $("#alumnos").addClass("active");
                $("#materias").removeClass("active");
                $("#calificaciones").removeClass("active");
                $("#alumnos_container").show();
                $("#materia_container").hide();
                $("#calificaciones_container").hide();
                break;

            case "Materias":
                $("#alumnos").removeClass("active");
                $("#materias").addClass("active");
                $("#calificaciones").removeClass("active");
                $("#alumnos_container").hide();
                $("#materia_container").show();
                $("#calificaciones_container").hide();
            break;

            case "Calificaciones":
                $("#alumnos").removeClass("active");
                $("#materias").removeClass("active");
                $("#calificaciones").addClass("active");
                $("#alumnos_container").hide();
                $("#materia_container").hide();
                $("#calificaciones_container").show();
            break;
    
            default:
                break;
        }
    }
</script>