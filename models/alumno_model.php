<?php
    require_once("../../db/db.php");

    class alumno_model extends DB{

        private $db;
        private $alumnos;
        private static $contadorAlumnos;

        public function __construct(){
            $this->db = $this->connect();
            $this->contadorAlumnos = 00000;
            $this->codigo_alumno = $this->contadorAlumnos++;
            $this->alumnos = array();
        }

        public function getAlumnos(){
            $sql = "SELECT * FROM Cat_Alumnos";
            $result = mysqli_query($this->db,$sql);

            while($row = mysqli_fetch_array($result)){

                $id = $row['iCodigoAlumno'];
                $nombre = $row['vchNombres'];
                $apellidos = $row['vchApellidos'];
                $fechaNac = $row['dtFechaNac'];

                $this->alumnos[] = array(
                    "id" => $id,
                    "nombre" => $nombre,
                    "apellidos" => $apellidos,
                    "fechaNac" => $fechaNac
                );

            }
            return $this->alumnos;
        }

        public function searchAlumno($codigoAlumno){
            $sql = "SELECT * FROM Cat_Alumnos WHERE iCodigoAlumno LIKE '%$codigoAlumno'";
            $exec = mysqli_query($this->db, $sql);
            if(mysqli_num_rows($exec) > 0){
                while($row = mysqli_fetch_array($exec)){

                    $id = $row['iCodigoAlumno'];
                    $nombre = $row['vchNombres'];
                    $apellidos = $row['vchApellidos'];
                    $fechaNac = $row['dtFechaNac'];
    
                    $this->alumnos[] = array(
                        "id" => $id,
                        "nombre" => $nombre,
                        "apellidos" => $apellidos,
                        "fechaNac" => $fechaNac
                    );
                }
            }
            return $this->alumnos;
        }

        public function insertAlumno($nombres, $apellidos, $fechaNac){
            $sql = "INSERT INTO Cat_Alumnos(iCodigoAlumno,vchNombres,vchApellidos,dtFechaNac) 
            VALUES ('$this->codigo_alumno','$nombres','$apellidos','$fechaNac')";
            $exec = mysqli_query($this->db, $sql);
            return $exec;
        }

        public function setAlumno($codigoAlumno, $nombres, $apellidos, $fechaNac){
            $sql = "UPDATE Cat_Alumnos SET vchNombres = '$nombres', vchApellidos = '$apellidos', dtFechaNac = '$fechaNac' WHERE iCodigoAlumno = $codigoAlumno";
            $exec = mysqli_query($this->db, $sql);
            return $exec;
        }

        public function deleteAlumno($codigoAlumno){
            $sql = "DELETE FROM Cat_Alumnos WHERE iCodigoAlumno = $codigoAlumno";
            $exec = mysqli_query($this->db, $sql);
            return $exec;
        }

    }
?>