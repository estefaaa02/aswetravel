<?php

	/** Se incluye el archivo Viaje.php */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Viaje.php');

    /** Se incluye el archivo AsientoDAO.php */
	require_once('AsientoDAO.php');

    /** Se incluye el archivo VueloDAO.php */
	require_once('VueloDAO.php');

     /** Se incluye el archivo UsuarioDAO.php */
	require_once('UsuarioDAO.php');

    /** Se incluye el archivo Asiento.php */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Asiento.php');

    /** Se incluye el archivo Vuelo.php */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Vuelo.php');

    /** Se incluye el archivo Usuario.php */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Usuario.php');

    /**
     * Representa el DAO de la clase Viaje
     */
    class ViajeDAO {

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
		 * Constructor de un nuevo DAO de Viaje
		 */
		public function __construct($con) {
			$this->con = $con;
			mysqli_set_charset($this->con, "utf8");
		}

        //----------------------------------------------------------------
        //Métodos
        //----------------------------------------------------------------

        /**
         * Crea un viaje nuevo en la base de datos
         *
         * @param Viaje $nuevoViaje
         */
        public function crearViaje($nuevoViaje) {
            $sql = "INSERT INTO VIAJE VALUES (0,'".$nuevoViaje->getEstado()."',".$nuevoViaje->getUsuario()->getCod_usuario().
            ",".$nuevoViaje->getPrecio_viaje().",'".$nuevoViaje->getDuracion_viaje()."','".$nuevoViaje->getFecha_reserva()->format('Y-m-d H:i:s')."','".$nuevoViaje->getFecha_compra()->format('Y-m-d H:i:s')."')";

            mysqli_query($this->con, $sql);

            $asientos = $nuevoViaje->getAsientos();
            $vuelos = $nuevoViaje->getVuelos();

            $sql = "SELECT cod_viaje FROM VIAJE WHERE cod_usuario = ".$nuevoViaje->getUsuario()->getCod_usuario()." ORDER BY cod_viaje DESC LIMIT 1";
			if((!$result = mysqli_query($this->con, $sql))) die();
			$row = mysqli_fetch_array($result);

            foreach($asientos as $asiento) {
                $sql = "INSERT INTO ASIGNACION VALUES (".$row['cod_viaje'].",".$asiento->getCod_asiento().")";
                mysqli_query($this->con, $sql);
            }

            foreach($vuelos as $vuelo) {
                $sql = "INSERT INTO VIAJE_VUELO VALUES(".$row['cod_viaje'].",".$vuelo->getCod_vuelo().")";
                mysqli_query($this->con, $sql);
            }
        }

        /**
         * Obtiene un viaje de la base de datos a partir de su código
         *
         * @param int $cod_viaje
         * @return Viaje viaje
         */
        public function consultarViaje($cod_viaje) {
            $sql = "SELECT * FROM VIAJE WHERE cod_viaje = $cod_viaje";
			if(!$result = mysqli_query($this->con, $sql)) die();
			$row = mysqli_fetch_array($result);

            $vueloDAO = new VueloDAO($this->con);
            $vuelos = $vueloDAO->obtenerVuelosPorViaje($row[0]);

            $asientoDAO = new AsientoDAO($this->con);
            $asientos = $asientoDAO->obtenerAsientosPorVuelo($row[0]);

            $usuarioDAO = new UsuarioDAO($this->con);
            $usuario = $usuarioDAO->consultarUsuarioCod($row[4]);

			$viaje = new Viaje($row[0], $row[1], $row[2], $row[3], $usuario, $row[5], $row[6], $vuelos, $asientos);
			return $viaje;
        }

        /**
         * Obtiene los viajes de la base de datos
         *
         * @return Viaje[] viaje
         */
        public function obtenerViaje() {
            $sql = "SELECT * FROM VIAJE";
			if(!$result = mysqli_query($this->con, $sql)) die();
			$viajes = array();
			while ($row = mysqli_fetch_array($result)) {
				$vueloDAO = new VueloDAO($this->con);
                $vuelos = $vueloDAO->obtenerVuelosPorViaje($row[0]);

                $asientoDAO = new AsientoDAO($this->con);
                $asientos = $asientoDAO->obtenerAsientosPorVuelo($row[0]);

                $usuarioDAO = new UsuarioDAO($this->con);
                $usuario = $usuarioDAO->consultarUsuarioCod($row[4]);

                $viajes[] = new Viaje($row[0], $row[1], $row[2], $row[3], $usuario, $row[5], $row[6], $vuelos, $asientos);
			}
			return $viajes;
        }

        /**
		 * Modifica a un viaje en la base de datos
		 * @param  Viaje $viajeMod
		 */
		public function modificarViaje($viajeMod) {
			$sql = "UPDATE VIAJE SET estado = '".$viajeMod->getEstado()."', precio_viaje = ".$viajeMod->getPrecio_viaje().
            ", duracion_viaje = '".$viajeMod->getDuracion_viaje()."', cod_usuario = ".$viajeMod->getUsuario()->getCod_usuario().
            ", fecha_reserva = '".$viajeMod->getFecha_reserva()."', fecha_compra = '".$viajeMod->getFecha_compra().
            " WHERE cod_viaje = ".$viajeMod->getCod_viaje();
			mysqli_query($this->con, $sql);

            $sql = "DELETE FROM ASIGNACION WHERE cod_viaje = ".$viajeMod->getCod_viaje();

            mysqli_query($this->con, $sql);

            $asientos = $viajeMod->getAsientos();

            foreach($asientos as $asiento) {
                $sql = "INSERT INTO ASIGNACION VALUES (".$viajeMod->getCod_viaje().",".$asiento->getCod_asiento().")";
                mysqli_query($this->con, $sql);
            }

            $sql = "DELETE FROM VIAJE_VUELO WHERE cod_viaje = ".$viajeMod->getCod_viaje();

            mysqli_query($this->con, $sql);

            $vuelos = $viajeMod->getVuelos();

            foreach($vuelos as $vuelo) {
                $sql = "INSERT INTO VIAJE_VUELO VALUES (".$viajeMod->getCod_viaje().",".$vuelo->getCod_vuelo().")";
                mysqli_query($this->con, $sql);
            }
		}

        /**
         * Obtiene los vuelos filtrados de la base de datos
         *
         * @param String $filtro
         * @return Viaje[] viajes
         */
        public function obtenerViajesFiltrados($filtro) {
            $sql = "SELECT * FROM VIAJE";
			if(!$result = mysqli_query($this->con, $sql)) die();
			$viajes = array();
			while ($row = mysqli_fetch_array($result)) {
				$vueloDAO = new VueloDAO($this->con);
                $vuelos = $vueloDAO->obtenerVuelosPorViaje($row[0]);

                $asientoDAO = new AsientoDAO($this->con);
                $asientos = $asientoDAO->obtenerAsientosPorVuelo($row[0]);

                $usuarioDAO = new UsuarioDAO($this->con);
                $usuario = $usuarioDAO->consultarUsuarioCod($row[4]);

                $viajes[] = new Viaje($row[0], $row[1], $row[2], $row[3], $usuario, $row[5], $row[6], $vuelos, $asientos);
			}
			return $viajes;
        }
    }
?>