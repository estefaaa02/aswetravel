<?php
    /**
	 * Se incluye el archivo Conexion.php
	 */
	require_once('../util/Conexion.php');

	/** 
     * Se incluye el archivo Escala.php  
    */
	require_once('../entidades/Escala.php');

    /** 
     * Se incluye el archivo CiudadDAO.php  
    */
	require_once('CiudadDAO.php');

    /** 
     * Se incluye el archivo Ciudad.php  
    */
	require_once('../entidades/Ciudad.php');

    /** 
     * Se incluye el archivo AerolineaDAO.php  
    */
	require_once('AerolineaDAO.php');

    /** 
     * Se incluye el archivo Aerolinea.php  
    */
	require_once('../entidades/Aerolinea.php');

    /**
     * Representa el DAO de la clase Escala
     */
    class EscalaDAO {
        //------------------------------------------------------------
		//Atributos
		//-------------------------------------------------------------

        /**
         * Representa la conexion a la base de datos
         *
         * @var Object
         */
		private $con;

        /**
         * Representa el objecto de la clase Conexion
         *
         * @var Conexion
         */
		private $conexion;

		//---------------------------------------------------------------
		//Constructor
		//---------------------------------------------------------------

		/**
		 * Constructor de un nuevo DAO de cargo
		 */
		public function __construct() {
			$this->conexion = new Conexion();
			$this->con = $this->conexion->conectarBD();
			mysqli_set_charset($this->conexion, "utf8");
		}

        //----------------------------------------------------------------
        //Métodos
        //----------------------------------------------------------------

        /**
         * Crea una escala en la base de datos
         *
         * @param Escala $nuevaEscala
         * @param int    $cod_vuelo
         */
        public function crearEscala($nuevaEscala, $cod_vuelo) {
            $ciudadDAO = new CiudadDAO();
            $ciudad = $ciudadDAO->consultarCiudadNom($nuevaEscala->getCiudad_origen()->getNom_ciudad());

            if($ciudad == null){
                $ciudadDAO = new CiudadDAO();
                $ciudadDAO->crearCiudad($nuevaEscala->getCiudad_origen());
            }

            $ciudadDAO = new CiudadDAO();
            $ciudad = $ciudadDAO->consultarCiudadNom($nuevaEscala->getCiudad_destino()->getNom_ciudad());

            if($ciudad == null){
                $ciudadDAO = new CiudadDAO();
                $ciudadDAO->crearCiudad($nuevaEscala->getCiudad_destino());
            }

            $ciudadDAO = new CiudadDAO();
            $ciudadOrigen = $ciudadDAO->consultarCiudadNom($nuevaEscala->getCiudad_origen()->getNom_ciudad());

            $ciudadDAO = new CiudadDAO();
            $ciudadDestino = $ciudadDAO->consultarCiudadNom($nuevaEscala->getCiudad_destino()->getNom_ciudad());

            $aerolineaDAO = new AerolineaDAO();
            $aerolinea = $aerolineaDAO->consultarAerolineaNom($nuevaEscala->getAerolinea()->getNom_aerolinea());

            if($aerolinea == null) {
                $aerolineaDAO = new AerolineaDAO();
                $aerolineaDAO->crearAerolinea($nuevaEscala->getAerolinea());
            }

            $aerolineaDAO = new AerolineaDAO();
            $aerolinea = $aerolineaDAO->consultarAerolineaNom($nuevaEscala->getAerolinea()->getNom_aerolinea());

            $sql = "INSERT INTO ESCALA VALUES (0,".$ciudadOrigen->getCod_ciudad().",".$ciudadDestino->getCod_ciudad().
            ",'".$nuevaEscala->getFecha_salida()."','".$nuevaEscala->getFecha_llegada()."',".$cod_vuelo.",".
            $aerolinea->getCod_aerolinea().")";

             mysqli_query($this->con, $sql);


			$this->conexion->desconectarBD($this->con);
			unset($this->conexion);
        }

        /**
         * Obtiene una escala de la base de datos a partir de su código
         *
         * @param int $cod_escala
         * @return Escala escala
         */
        public function consultarEscala($cod_escala) {
            $sql = "SELECT * FROM ESCALA WHERE cod_escala = $cod_escala";

            if(!$result = mysqli_query($this->con, $sql)) die();
			$row = mysqli_fetch_array($result);

            $ciudadDAO = new CiudadDAO();
            $ciudad_origen = $ciudadDAO->consultarCiudad($row[1]);

            $ciudadDAO = new CiudadDAO();
            $ciudad_destino = $ciudadDAO->consultarCiudad($row[2]);

            $aerolineaDAO = new AerolineaDAO();
            $aerolinea = $aerolineaDAO->consultarAerolinea($row[5]);

            $escala = new Escala($row[0], $ciudad_origen, $ciudad_destino, $row[3], $row[4], $aerolinea);
			$this->conexion->desconectarBD($this->con);
			unset($this->conexion);
			return $escala;
        }

        /**
         * Obtiene las escalas de la base de datos
         *
         * @return Escala[] escalas
         */
        public function obtenerEscalas() {
            $sql = "SELECT * FROM ESCALA";
			if(!$result = mysqli_query($this->con, $sql)) die();
			$escalas = array();
			while ($row = mysqli_fetch_array($result)) {
				 $ciudadDAO = new CiudadDAO();
                $ciudad_origen = $ciudadDAO->consultarCiudad($row[1]);

                $ciudadDAO = new CiudadDAO();
                $ciudad_destino = $ciudadDAO->consultarCiudad($row[2]);

                $aerolineaDAO = new AerolineaDAO();
                $aerolinea = $aerolineaDAO->consultarAerolinea($row[5]);

                $escalas[] = new Escala($row[0], $ciudad_origen, $ciudad_destino, $row[3], $row[4], $aerolinea);
			}
			$this->conexion->desconectarBD($this->con);
			unset($this->conexion);
			return $escalas;
        }

        /**
         * Obtiene las escalas por vuelo de la base de datos
         *
         * @param int $cod_vuelo
         * @return Escala[] escalas
         */
        public function obtenerEscalasPorVuelo($cod_vuelo) {
            $sql = "SELECT * FROM ESCALA WHERE cod_vuelo = $cod_vuelo";
			if(!$result = mysqli_query($this->con, $sql)) die();
			$escalas = array();
			while ($row = mysqli_fetch_array($result)) {
                $ciudadDAO = new CiudadDAO();
                $ciudad_origen = $ciudadDAO->consultarCiudad($row[1]);

                $ciudadDAO = new CiudadDAO();
                $ciudad_destino = $ciudadDAO->consultarCiudad($row[2]);

                $aerolineaDAO = new AerolineaDAO();
                $aerolinea = $aerolineaDAO->consultarAerolinea($row[5]);

                $escalas[] = new Escala($row[0], $ciudad_origen, $ciudad_destino, $row[3], $row[4], $aerolinea);
			}
			$this->conexion->desconectarBD($this->con);
			unset($this->conexion);
			return $escalas;
        }

        /**
         * Modifica una escala
         *
         * @param Escala $escalaMod
         */
        public function modificarEscala($escalaMod) {
            $ciudadDAO = new CiudadDAO();
            $ciudad = $ciudadDAO->consultarCiudadNom($escalaMod->getCiudad_origen()->getNom_ciudad());

            if($ciudad == null){
                $ciudadDAO = new CiudadDAO();
                $ciudadDAO->crearCiudad($escalaMod->getCiudad_origen());
            }

            $ciudadDAO = new CiudadDAO();
            $ciudad = $ciudadDAO->consultarCiudadNom($escalaMod->getCiudad_destino()->getNom_ciudad());

            if($ciudad == null){
                $ciudadDAO = new CiudadDAO();
                $ciudadDAO->crearCiudad($escalaMod->getCiudad_destino());
            }

            $ciudadDAO = new CiudadDAO();
            $ciudadOrigen = $ciudadDAO->consultarCiudadNom($escalaMod->getCiudad_origen()->getNom_ciudad());

            $ciudadDAO = new CiudadDAO();
            $ciudadDestino = $ciudadDAO->consultarCiudadNom($escalaMod->getCiudad_destino()->getNom_ciudad());

            $aerolineaDAO = new AerolineaDAO();
            $aerolinea = $aerolineaDAO->consultarAerolineaNom($escalaMod->getAerolinea()->getNom_aerolinea());

            if($aerolinea == null) {
                $aerolineaDAO = new AerolineaDAO();
                $aerolineaDAO->crearAerolinea($escalaMod->getAerolinea());
            }

            $aerolineaDAO = new AerolineaDAO();
            $aerolinea = $aerolineaDAO->consultarAerolineaNom($escalaMod->getAerolinea()->getNom_aerolinea());

            $sql = "UPDATE ESCALA SET cod_ciudad_origen = ".$ciudadOrigen->getCod_ciudad().
            ", cod_ciudad_destino = ".$ciudadDestino->getCod_ciudad().", fecha_salida = '".
            $escalaMod->getFecha_salida()."', fecha_llegada = '".$escalaMod->getFecha_llegada().
            "', cod_aerolinea = ".$aerolinea->getCod_aerolinea()." WHERE cod_escala = ".$escalaMod->getCod_escala();

            mysqli_query($this->con, $sql);
			$this->conexion->desconectarBD($this->con);
			unset($this->conexion);
        }

        /**
         *  Obtiene las escalas filtradas de la base de datos
         *
         * @param String $filtro
         * @return Escala[] escala
         */
        public function obtenerEscalasFiltradas($filtro) {
            $sql = "SELECT * FROM ESCALA WHERE ".$filtro;
			if(!$result = mysqli_query($this->con, $sql)) die();
			$escalas = array();
			while ($row = mysqli_fetch_array($result)) {
				 $ciudadDAO = new CiudadDAO();
                $ciudad_origen = $ciudadDAO->consultarCiudad($row[1]);

                $ciudadDAO = new CiudadDAO();
                $ciudad_destino = $ciudadDAO->consultarCiudad($row[2]);

                $aerolineaDAO = new AerolineaDAO();
                $aerolinea = $aerolineaDAO->consultarAerolinea($row[5]);

                $escalas[] = new Escala($row[0], $ciudad_origen, $ciudad_destino, $row[3], $row[4], $aerolinea);
			}
			$this->conexion->desconectarBD($this->con);
			unset($this->conexion);
			return $escalas;
        }
    }
?>