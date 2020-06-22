<?php
    require_once("../../db/db.php");

    class materia_model extends DB{

        private $db;
        private $materias;

        public function __construct(){
            $this->db = $this->connect();
            $this->materias = array();
        }

        public function getMaterias(){
            $sql = "SELECT * FROM Cat_Materias";
            $exec = mysqli_query($this->db,$sql);
            if(mysqli_num_rows($exec) > 0){
                while($row = mysqli_fetch_array($exec)){

                    $id = $row['vchCodigoMateria'];
                    $nombre = $row['vchMateria'];
    
                    $this->materias[] = array(
                        "id" => $id,
                        "nombre" => $nombre
                    );
                }
            }
            return $this->materias;
        }

        public function searchMateria($codigoMateria){
            $sql = "SELECT * FROM Cat_Materias WHERE vchCodigoMateria LIKE '%$codigoMateria'";
            $exec = mysqli_query($this->db, $sql);
            if(mysqli_num_rows($exec) > 0){
                while($row = mysqli_fetch_array($exec)){

                    $id = $row['vchCodigoMateria'];
                    $nombre = $row['vchMateria'];
    
                    $this->materias[] = array(
                        "id" => $id,
                        "nombre" => $nombre
                    );
                }
            }
            return $this->materias;
        }

        public function insertMateria($nombreMateria){
            $sql = "INSERT INTO Cat_Materias(vchMateria) VALUES ('$nombreMateria')";
            $exec = mysqli_query($this->db, $sql);
            return $exec;
        }

        public function setMateria($codigoMateria, $nombreMateria){
            $sql = "UPDATE Cat_Materias SET vchMateria = '$nombreMateria' WHERE vchCodigoMateria = $codigoMateria";
            $exec = mysqli_query($this->db, $sql);
            return $exec;
        }

        public function deleteMateria($codigoMateria){
            $sql = "DELETE FROM Cat_Materias WHERE vchCodigoMateria = '$codigoMateria'";
            $exec = mysqli_query($this->db, $sql);
            return $exec;
        }

    }
?>