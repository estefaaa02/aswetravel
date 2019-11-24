<?php

	/** 
     * Se incluye el archivo Vuelo.php  
    */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Vuelo.php');

    /** 
     * Se incluye el archivo CiudadDAO.php  
    */
	require_once('CiudadDAO.php');

    /** 
     * Se incluye el archivo Ciudad.php  
    */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Ciudad.php');

    /** 
     * Se incluye el archivo AerolineaDAO.php  
    */
	require_once('AerolineaDAO.php');

    /** 
     * Se incluye el archivo Aerolinea.php  
    */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Aerolinea.php');

    /**
     * Representa el DAO de la clase Vuelo
     */
    class VueloDAO {
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
		 * Constructor de un nuevo DAO de vuelo
		 */
		public function __construct($con) {
			$this->con = $con;
			mysqli_set_charset($this->con, "utf8");
		}

        //----------------------------------------------------------------
        //Métodos
        //----------------------------------------------------------------

        /**
         * Crea un vuelo en la base de datos
         *
         * @param Vuelo $nuevoVuelo
         */
        public function crearVuelo($nuevoVuelo) {
            $ciudadDAO = new CiudadDAO($this->con);
            $ciudad = $ciudadDAO->consultarCiudadNom($nuevoVuelo->getCiudad_origen()->getNom_ciudad());

            if($ciudad == null){
                $ciudadDAO->crearCiudad($nuevoVuelo->getCiudad_origen());
            }

            $ciudad = $ciudadDAO->consultarCiudadNom($nuevoVuelo->getCiudad_destino()->getNom_ciudad());

            if($ciudad == null){
                $ciudadDAO->crearCiudad($nuevoVuelo->getCiudad_destino());
            }

            $ciudadOrigen = $ciudadDAO->consultarCiudadNom($nuevoVuelo->getCiudad_origen()->getNom_ciudad());

            $ciudadDestino = $ciudadDAO->consultarCiudadNom($nuevoVuelo->getCiudad_destino()->getNom_ciudad());

            $aerolineaDAO = new AerolineaDAO($this->con);
            $aerolinea = $aerolineaDAO->consultarAerolineaNom($nuevoVuelo->getAerolinea()->getNom_aerolinea());

            if($aerolinea == null) {
                $aerolineaDAO->crearAerolinea($nuevoVuelo->getAerolinea());
            }

            $aerolinea = $aerolineaDAO->consultarAerolineaNom($nuevoVuelo->getAerolinea()->getNom_aerolinea());

            $sql = "INSERT INTO ESCALA VALUES (0,".$ciudadOrigen->getCod_ciudad().",".$ciudadDestino->getCod_ciudad().
            ",".$nuevoVuelo->getPrecio_vuelo().",'".$nuevoVuelo->getFecha_salida()."','"
            .$nuevoVuelo->getFecha_llegada()."',".$aerolinea->getCod_aerolinea().")";

             mysqli_query($this->con, $sql);
        }

        /**
         * Obtiene un vuelo de la base de datos a partir de su código
         *
         * @param int $cod_vuelo
         * @return Vuelo vuelo
         */
        public function consultarVuelo($cod_vuelo) {
            $sql = "SELECT * FROM VUELO WHERE cod_vuelo = $cod_vuelo";

            if(!$result = mysqli_query($this->con, $sql)) die();
			$row = mysqli_fetch_array($result);

            $ciudadDAO = new CiudadDAO($this->con);
            $ciudad_origen = $ciudadDAO->consultarCiudad($row[1]);
            $ciudad_destino = $ciudadDAO->consultarCiudad($row[2]);

            $aerolineaDAO = new AerolineaDAO($this->con);
            $aerolinea = $aerolineaDAO->consultarAerolinea($row[6]);

            $vuelo = new Vuelo($row[0], $ciudad_origen, $ciudad_destino, $row[3], $row[4], $row[5], $aerolinea);
			return $vuelo;
        }

        /**
         * Obtiene los vuelos de la base de datos
         *
         * @return Vuelo[] vuelo
         */
        public function obtenerVuelos() {
            $sql = "SELECT * FROM VUELO";
			if(!$result = mysqli_query($this->con, $sql)) die();
			$vuelos = array();
			while ($row = mysqli_fetch_array($result)) {
				 $ciudadDAO = new CiudadDAO($this->con);
                $ciudad_origen = $ciudadDAO->consultarCiudad($row[1]);
                $ciudad_destino = $ciudadDAO->consultarCiudad($row[2]);

                $aerolineaDAO = new AerolineaDAO($this->con);
                $aerolinea = $aerolineaDAO->consultarAerolinea($row[6]);

                $vuelos[] = new Vuelo($row[0], $ciudad_origen, $ciudad_destino, $row[3], $row[4], $row[5], $aerolinea);
			}
			return $vuelos;
        }

        /**
         * Obtiene los vuelos por viaje de la base de datos
         *
         * @param int $cod_vuelo
         * @return Vuelo[] vuelos
         */
        public function obtenerVuelosPorViaje($cod_viaje) {
            $sql = "SELECT * FROM VIAJE_VUELO WHERE cod_viaje = $cod_viaje";
			if(!$result = mysqli_query($this->con, $sql)) die();
			$vuelos = array();
			while ($row = mysqli_fetch_array($result)) {
                $sql = "SELECT * FROM VUELO WHERE cod_vuelo = ".$row[1];

                if(!$result = mysqli_query($this->con, $sql)) die();
                    while ($row2 = mysqli_fetch_array($result)) {

                        $ciudadDAO = new CiudadDAO($this->con);
                        $ciudad_origen = $ciudadDAO->consultarCiudad($row2[1]);
                        $ciudad_destino = $ciudadDAO->consultarCiudad($row2[2]);

                        $aerolineaDAO = new AerolineaDAO($this->con);
                        $aerolinea = $aerolineaDAO->consultarAerolinea($row2[6]);

                        $vuelos[] = new Vuelo($row2[0], $ciudad_origen, $ciudad_destino, $row2[3], $row2[4], $row2[5], $aerolinea);
                    }
			}
			return $vuelos;
        }

        /**
         * Modifica un vuelo
         *
         * @param Escala $escalaMod
         */
        /**public function modificarEscala($escalaMod) {
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
        }*/

        /**
         *  Obtiene los vuelos filtrados de la base de datos
         *
         * @param String $filtro
         * @return Vuelo[] vuelos
         */
        public function obtenerVuelosFiltrados($filtro) {
            $sql = "SELECT * FROM VUELO WHERE ".$filtro;
			if(!$result = mysqli_query($this->con, $sql)) die();
			$vuelos = array();
			while ($row = mysqli_fetch_array($result)) {
				 $ciudadDAO = new CiudadDAO($this->con);
                $ciudad_origen = $ciudadDAO->consultarCiudad($row[1]);
                $ciudad_destino = $ciudadDAO->consultarCiudad($row[2]);

                $aerolineaDAO = new AerolineaDAO($this->con);
                $aerolinea = $aerolineaDAO->consultarAerolinea($row[6]);

                $vuelos[] = new Vuelo($row[0], $ciudad_origen, $ciudad_destino, $row[3], $row[4], $row[5], $aerolinea);
			}
			return $vuelos;
        }
    }
?>