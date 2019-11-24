<?php

	/** 
     * Se incluye el archivo Cargo.php  
    */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Cargo.php');

    /**
     * Representa el DAO de la clase Cargo
     */
    class CargoDAO {
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
         * Obtiene un cargo de la base de datos a partir de su código
         *
         * @param int $cod_cargo
         * @return Cargo cargo
         */
        public function consultarCargo($cod_cargo) {
            $sql = "SELECT * FROM CARGO WHERE cod_cargo = $cod_cargo";

            if(!$result = mysqli_query($this->con, $sql)) die();
			$row = mysqli_fetch_array($result);

            $cargo = new Cargo($row[0], $row[1]);
			return $cargo;
        }

        /**
         * Obtiene los cargos de la base de datos
         *
         * @return Cargo[] cargos
         */
        public function obtenerCargos() {
            $sql = "SELECT * FROM CARGO";
			if(!$result = mysqli_query($this->con, $sql)) die();
			$cargos = array();
			while ($row = mysqli_fetch_array($result)) {
				$cargos[] = new Cargo($row[0], $row[1]);
			}
			return $cargos;
        }
    }
?>