<?php

	/** 
     * Se incluye el archivo Aerolinea.php  
    */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Aerolinea.php');

    /**
     * Representa el DAO de la clase Aerolinea
     */
    class AerolineaDAO {
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
		 * Constructor de un nuevo DAO de cargo
		 */
		public function __construct($con) {
			$this->con = $con;
			mysqli_set_charset($this->con, "utf8");
		}

        //----------------------------------------------------------------
        //Métodos
        //----------------------------------------------------------------

        /**
         * Crea una nueva aerolínea dentro de la base de datos
         *
         * @param Aerolinea $nuevaAerolinea
         */
        public function crearAerolinea($nuevaAerolinea) {
            $sql = "INSERT INTO AEROLINEA VALUES (0,'".$nuevaAerolinea->getNom_aerolinea()."')";
            mysqli_query($this->con, $sql);
        }
        
        /**
         * Obtiene una aerolinea de la base de datos a partir de su código
         *
         * @param int $cod_aerolinea
         * @return Aerolinea aerolinea
         */
        public function consultarAerolinea($cod_aerolinea) {
            $sql = "SELECT * FROM AEROLINEA WHERE cod_aerolinea = $cod_aerolinea";

            if(!$result = mysqli_query($this->con, $sql)) die();
			$row = mysqli_fetch_array($result);

            $aerolinea = new Aerolinea($row[0], $row[1]);
			return $aerolinea;
        }

        /**
         * Obtiene las aerolineas de la base de datos
         *
         * @return Aerolinea[] aerolineas
         */
        public function obtenerAerolineas() {
            $sql = "SELECT * FROM AEROLINEA";

            if(!$result = mysqli_query($this->con, $sql)) die();
			$aerolineas = array();
			while ($row = mysqli_fetch_array($result)) {
				$aerolineas[] = new Aerolinea($row[0], $row[1]);
			}
			return $aerolineas;
        }

        /**
         * Obtiene una aerolinea de la base de datos a partir de su código
         *
         * @param String $nom_aerolinea
         * @return Aerolinea aerolinea
         */
        public function consultarAerolineaNom($nom_aerolinea) {
            $sql = "SELECT * FROM AEROLINEA WHERE nom_aerolinea = $nom_aerolinea";

            if(!$result = mysqli_query($this->con, $sql)) {
                return null;
            }
            
			$row = mysqli_fetch_array($result);

            $aerolinea = new Aerolinea($row[0], $row[1]);
			return $aerolinea;
        }
    }
?>