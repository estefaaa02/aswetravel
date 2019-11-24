<?php

    /** 
     * Se incluye el archivo Ciudad.php  
    */
    require_once($_SERVER["DOCUMENT_ROOT"] ."/entidades/Ciudad.php");

    /**
     * Representa el DAO de la clase Ciudad
     */
    class CiudadDAO {
        //------------------------------------------------------------
        //Atributos
        //-------------------------------------------------------------

        /**
         * Representa la conexion a la base de datos
         *
         * @var Object
         */
        private $con;

        //---------------------------------------------------------------
        //Constructor
        //---------------------------------------------------------------

        /**
         * Constructor de un nuevo DAO de ciudad
         */
        public function __construct($con) {
            $this->con = $con;
            mysqli_set_charset($this->con, "utf8");
        }

        //----------------------------------------------------------------
        //Métodos
        //----------------------------------------------------------------



        /**
         * Obtiene una ciudad de la base de datos a partir de su código
         *
         * @param int $cod_ciudad
         * @return Ciudad ciudad
         */
        public function consultarCiudad($cod_ciudad) {
            $sql = "SELECT * FROM CIUDAD WHERE cod_ciudad = $cod_ciudad";

            if(!$result = mysqli_query($this->con, $sql)) die();
            $row = mysqli_fetch_array($result);

            $ciudad = new Ciudad($row[0], $row[1]);
            return $ciudad;
        }

        /**
         * Obtiene las ciudades de la base de datos
         *
         * @return Ciudad[] ciudades
         */
        public function obtenerCiudades() {
            $sql = "SELECT * FROM CIUDAD";
            if(!$result = mysqli_query($this->con, $sql)) die();
            $ciudades = array();
            while ($row = mysqli_fetch_array($result)) {
                $ciudades[] = new Ciudad($row[0], $row[1]);
            }
            return $ciudades;
        }

        /**
         * Obtiene una ciudad de la base de datos a partir de su nombre
         *
         * @param String $nom_ciudad
         * @return Ciudad ciudad
         */
        public function consultarCiudadNom($nom_ciudad) {
            $sql = "SELECT * FROM CIUDAD WHERE nom_ciudad = '$nom_ciudad'";

            if(!$result = mysqli_query($this->con, $sql)) die("Error");
            $row = mysqli_fetch_array($result);

            $ciudad = new Ciudad($row[0], $row[1]);
            return $ciudad;
        }

        /**
         * Obtiene una ciudad de la base de datos a partir de su nombre
         *
         * @param String $nom_ciudad
         * @return Ciudad ciudad
         */
        public function consultarCiudadNom2($nom_ciudad) {
            $sql = "SELECT * FROM CIUDAD WHERE nom_ciudad LIKE '%{$nom_ciudad}%'";

            if(!$result = mysqli_query($this->con, $sql)) die("Error");
            $ciudades = array();
            while ($row = mysqli_fetch_array($result)) {
                $ciudades[] = new Ciudad($row[0], $row[1]);
            }
            return $ciudades;
        }

    }
?>