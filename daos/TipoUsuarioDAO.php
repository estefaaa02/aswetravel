<?php

	/** 
     * Se incluye el archivo TipoUsuario.php  
    */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/TipoUsuario.php');

    /**
     * Representa el DAO de la clase TipoUsuario
     */

    class TipoUsuarioDAO {
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
		 * Constructor de un nuevo DAO de tipo usuario
		 */
		public function __construct($con) {
			$this->con = $con;
			mysqli_set_charset($this->con, "utf8");
		}

        //----------------------------------------------------------------
        //Métodos
        //----------------------------------------------------------------

		/**
		 * Obtiene un tipo de usuario de la base de datos a partir de su código
		 *
		 * @param int $cod_t_usuario
		 * @return TipoUsuario tipoUsuario
		 */
        public function consultarTipoUsuario($cod_t_usuario) {
            $sql = "SELECT * FROM T_USUARIO WHERE cod_t_usuario = $cod_t_usuario";

			if(!$result = mysqli_query($this->con, $sql)) die();
			$row = mysqli_fetch_array($result);

            $tipoUsuario = new TipoUsuario($row[0], $row[1]);
			return $tipoUsuario;
        }

		/**
		 * Obtiene los tipos de usuario de la base de datos
		 *
		 * @return TipoUsuario[] tipos
		 */
        public function obtenerTipos() {
            $sql = "SELECT * FROM T_USUARIO";
			if(!$result = mysqli_query($this->con, $sql)) die();
			$tipos = array();
			while ($row = mysqli_fetch_array($result)) {
				$tipos[] = new TipoUsuario($row[0], $row[1]);
			}
			return $tipos;
        }
    }

?>