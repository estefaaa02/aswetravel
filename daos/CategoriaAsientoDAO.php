<?php

	/** 
     * Se incluye el archivo CategoriaAsiento.php  
    */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/CategoriaAsiento.php');

    /**
     * Representa el DAO de la clase CategoriaAsiento
     */
    class CategoriaAsientoDAO {
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
		 * Constructor de un nuevo DAO de CategoriaAsiento
		 */
		public function __construct($con) {
			$this->con = $con;
			mysqli_set_charset($this->con, "utf8");
		}

        //----------------------------------------------------------------
        //Métodos
        //----------------------------------------------------------------

        /**
         * Obtiene una categoria de asiento de la base de datos a partir de su código
         *
         * @param int $cod_categoria_asiento
         * @return CategoriaAsiento categoriaAsiento
         */
        public function consultarCategoriaAsiento($cod_categoria_asiento) {
            $sql = "SELECT * FROM CATEGORIA_ASIENTO WHERE cod_categoria_asiento = $cod_categoria_asiento";

            if(!$result = mysqli_query($this->con, $sql)) die();
			$row = mysqli_fetch_array($result);

            $categoriaAsiento = new CategoriaAsiento($row[0], $row[1], $row[2]);
			return $categoriaAsiento;
        }

        /**
         * Obtiene las categorias de asiento de la base de datos
         *
         * @return CategoriaAsiento[] categorias
         */
        public function obtenerCategoriasAsiento() {
            $sql = "SELECT * FROM CATEGORIA_ASIENTO";
			if(!$result = mysqli_query($this->con, $sql)) die();
			$categorias = array();
			while ($row = mysqli_fetch_array($result)) {
				$categorias[] = new CategoriaAsiento($row[0], $row[1], $row[2]);
			}
			return $categorias;
        }
    }
?>