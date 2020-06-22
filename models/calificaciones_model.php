<?php
    require_once("../../db/db.php");

    class calificaciones_model extends DB{

        private $db;
        private $calificaciones;

        public function __construct(){
            $this->db = $this->connect();
            $this->calificaciones = array();
        }

        public function getCalificaciones(){
            $sql = "SELECT * FROM Cat_rel_Alumno_Materia";
            $exec = mysqli_query($this->db,$sql);
            if(mysqli_num_rows($exec) > 0){
                while($row = mysqli_fetch_array($exec)){

                    $codigo_alumno = $row['iCodigoAlumno'];
                    $codigo_materia = $row['vchCodigoMateria'];
                    $calificacion = $row['fCalificacion'];

                    $sql = "SELECT * FROM Cat_Alumnos WHERE iCodigoAlumno = $codigo_alumno";
                    $exec = mysqli_query($this->db,$sql);
                    if(mysqli_num_rows($exec) > 0){
                        while($row = mysqli_fetch_array($exec)){
                            $nombres = $row['vchNombres'];
                            $apellidos = $row['vchApellidos'];
                            $fecha_nac = $row['fechaNac'];
                        }
                    }
                    $sql = "SELECT * FROM Cat_Materias WHERE vchCodigoMateria = $codigo_materia";
                    $exec = mysqli_query($this->db,$sql);
                    if(mysqli_num_rows($exec) > 0){
                        while($row = mysqli_fetch_array($exec)){
                            $nombre_materia = $row['vchMateria'];
                        }
                    }
                    $this->calificaciones[] = array(
                        "codigo_alumno" => $codigo_alumno,
                        "codigo_materia" => $codigo_materia,
                        "calificacion" => $calificacion,
                        "nombre_alumno" => $nombres,
                        "apellidos" => $apellidos,
                        "fecha_nac" => $fecha_nac,
                        "nombre_materia" => $nombre_materia
                    );
                }
            }
            return $this->calificaciones;
        }


        public function insertCalificaciones($codigoAlumno,$codigoMateria,$calificacion){
            $sql = "INSERT INTO Cat_rel_Alumno_Materia(iCodigoAlumno, vchCodigoMateria, fCalificacion) VALUES ('$codigoAlumno','$codigoMateria','$calificacion')";
            $exec = mysqli_query($this->db, $sql);
            return $exec;
        }

        public function setCalificaciones($codigoAlumno, $codigoMateria, $calificacion){
            $sql = "UPDATE Cat_rel_Alumno_Materia SET iCodigoAlumno = '$codigoAlumno', vchCodigoMateria = '$codigoMateria', fCalificacion = '$calificacion WHERE vchCodigoMateria = $codigoMateria OR iCodigoAlumno = $codigoAlumno";
            $exec = mysqli_query($this->db, $sql);
            return $exec;
        }

        public function deleteCalificaciones($codigoAlumno, $codigoMateria){
            $sql = "DELETE FROM Cat_rel_Alumno_Materia WHERE vchCodigoMateria = '$codigoMateria' OR iCodigoAlumno = 'codigoAlumno'";
            $exec = mysqli_query($this->db, $sql);
            return $exec;
        }

    }
?>