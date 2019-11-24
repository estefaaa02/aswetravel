<?php

	/** 
     * Se incluye el archivo Auditoria.php  
    */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Auditoria.php');

    /**
     * Representa el DAO de la clase Auditoria
     */
    class Auditoria {
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
         * Crea una nueva auditoría en la base de datos
         *
         * @param Auditoria $nuevaAuditoria
         */
        public function crearAuditoria($nuevaAuditoria) {
            $sql = "INSERT INTO AUDITORIA VALUES (0, '".$nuevaAuditoria->getDireccion_ip().
            "','".$nuevaAuditoria->getNom_tabla()."',".$nuevaAuditoria->getCod_tabla().",'".$nuevaAuditoria->getAccion()."','".
            $nuevaAuditoria->getFecha()."')";

             mysqli_query($this->con, $sql);
        }

        /**
         * Obtiene una auditoría de la base de datos a partir de su código
         *
         * @param int $cod_auditoria
         * @return Auditoria auditoria
         */
        public function consultarAuditoria($cod_auditoria) {
            $sql = "SELECT * FROM AUDITORIA WHERE cod_auditoria = $cod_auditoria";

            if(!$result = mysqli_query($this->con, $sql)) die();
			$row = mysqli_fetch_array($result);

            $auditoria = new Auditoria($row[0],$row[1],$row[2],$row[3], $row[4], $row[6], $row[5]);
			return $auditoria;
        }

        /**
         * Obtiene las auditorias de la base de datos
         *
         * @return Auditoria[] auditoria
         */
        public function obtenerAuditorias() {
            $sql = "SELECT * FROM AUDITORIA";

            if(!$result = mysqli_query($this->con, $sql)) die();
			$auditorias = array();
			while ($row = mysqli_fetch_array($result)) {
                $auditorias[] = new Auditoria($row[0],$row[1],$row[2],$row[3], $row[5], $row[4]);
			}
			return $auditorias;
        }
        
        /**
         * Obtiene las auditorias filtradas de la base de datos
         *
         * @param String $filtro
         * @return Auditoria[] auditorias
         */
        public function obtenerAuditoriasFiltradas($filtro) {
            $sql = "SELECT * FROM AUDITORIA WHERE ".$filtro;

            if(!$result = mysqli_query($this->con, $sql)) die();
			$auditorias = array();
			while ($row = mysqli_fetch_array($result)) {
                $auditorias[] = new Auditoria($row[0],$row[1],$row[2],$row[3], $row[5], $row[4]);
			}
			return $auditorias;
        }

    }
?>