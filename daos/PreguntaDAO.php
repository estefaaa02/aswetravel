<?php

	/** 
     * Se incluye el archivo Pregunta.php  
    */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Pregunta.php');

    /**
     * Representa el DAO de la clase Pregunta
     */
    class PreguntaDAO {
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
		 * Constructor de un nuevo DAO de pregunta
		 */
		public function __construct($con) {
			$this->con = $con;
			mysqli_set_charset($this->con, "utf8");
		}

        //----------------------------------------------------------------
        //Métodos
        //----------------------------------------------------------------

        /**
         * Obtiene una pregunta de la base de datos a partir de su código
         *
         * @param int $cod_pregunta
         * @return Pregunta pregunta
         */
        public function consultarPregunta($cod_pregunta) {
            $sql = "SELECT * FROM PREGUNTA WHERE cod_pregunta = $cod_pregunta";

            if(!$result = mysqli_query($this->con, $sql)) die();
			$row = mysqli_fetch_array($result);

            $pregunta = new Pregunta($row[0], $row[1]);
			return $pregunta;
        }

        /**
         * Obtiene las preguntas de la base de datos
         *
         * @return Pregunta[] preguntas
         */
        public function obtenerPreguntas() {
            $sql = "SELECT * FROM PREGUNTA";
			if(!$result = mysqli_query($this->con, $sql)) die();
			$preguntas = array();
			while ($row = mysqli_fetch_array($result)) {
				$preguntas[] = new Pregunta($row[0], $row[1]);
			}
			return $preguntas;
        }

    }
?>