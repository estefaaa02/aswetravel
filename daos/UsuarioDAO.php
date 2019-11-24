<?php

	/** Se incluye el archivo Usuario.php */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Usuario.php');

    /** Se incluye el archivo CargoDAO.php */
	require_once('CargoDAO.php');

    /** Se incluye el archivo PreguntaDAO.php */
	require_once('PreguntaDAO.php');

    /** Se incluye el archivo TipoUsuarioDAO.php */
	require_once('TipoUsuarioDAO.php');

    /** Se incluye el archivo TarjetaDAO.php */
	require_once('TarjetaDAO.php');

    /** Se incluye el archivo Cargo.php */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Cargo.php');

    /** Se incluye el archivo Pregunta.php */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Pregunta.php');

    /** Se incluye el archivo TipoUsuario.php */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/TipoUsuario.php');

    /** Se incluye el archivo Tarjeta.php */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Tarjeta.php');

    /**
     * Representa el DAO de la clase Usuario
     */
    class UsuarioDAO {

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
		 * Constructor de un nuevo DAO de usuario
		 */
		public function __construct($con) {
			$this->con = $con;
			mysqli_set_charset($this->con, "utf8");
		}

        //----------------------------------------------------------------
        //Métodos
        //----------------------------------------------------------------

        /**
         * Crea un usuario nuevo en la base de datos
         *
         * @param Usuario $nuevoUsuario
         */
        public function crearUsuario($nuevoUsuario) {
            if($nuevoUsuario->getTarjeta() == null) {
                 $hash = password_hash($nuevoUsuario->getContrasenia_usuario(), PASSWORD_BCRYPT);
            $sql = "INSERT INTO USUARIO VALUES (0,'".$nuevoUsuario->getNom_usuario()."','".$nuevoUsuario->getCorreo_usuario()."','".$hash."',NULL,".
            $nuevoUsuario->getTipo_usuario()->getCod_t_usuario().",".$nuevoUsuario->getPregunta()->getCod_pregunta().",'".
            $nuevoUsuario->getRespuesta_pregunta()."',".$nuevoUsuario->getReservas_compras().",".$nuevoUsuario->getCargo()->getCod_cargo().",'".$nuevoUsuario->getEstado()."')";

            } else {
                $cod_tarjeta = $nuevoUsuario->getTarjeta()->getCod_tarjeta();
                 $hash = password_hash($nuevoUsuario->getContrasenia_usuario(), PASSWORD_BCRYPT);
            $sql = "INSERT INTO USUARIO VALUES (0,'".$nuevoUsuario->getNom_usuario()."','".$nuevoUsuario->getCorreo_usuario()."','".$hash."',$cod_tarjeta,".
            $nuevoUsuario->getTipo_usuario()->getCod_t_usuario().",".$nuevoUsuario->getPregunta()->getCod_pregunta().",'".
            $nuevoUsuario->getRespuesta_pregunta()."',".$nuevoUsuario->getReservas_compras().",".$nuevoUsuario->getCargo()->getCod_cargo().",'".$nuevoUsuario->getEstado()."')";

            }

           
            mysqli_query($this->con, $sql);
        }

        public function verificarUsuario($contrasena, $correo_usuario) {
            $sql = "SELECT * FROM USUARIO WHERE correo_usuario = '$correo_usuario'";
			if(!$result = mysqli_query($this->con, $sql)) die();
            if(mysqli_num_rows($result)==0) {
                return false;
            } else {
                $row = mysqli_fetch_array($result);

                if (password_verify($contrasena, $row[3])) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        /**
         * Obtiene un usuario de la base de datos a partir de su código
         *
         * @param int $cod_usuario
         * @return Usuario usuario
         */
        public function consultarUsuarioCod($cod_usuario) {
            $sql = "SELECT * FROM USUARIO WHERE cod_usuario = $cod_usuario";
			if(!$result = mysqli_query($this->con, $sql)) die();
			$row = mysqli_fetch_array($result);

            if($row[4] != null) {
                 $tarjetaDAO = new TarjetaDAO($this->con);
                $tarjeta = $tarjetaDAO->consultarTarjeta($row[4]);
            } else {
                $tarjeta = null;
            }

            $tipoUsuarioDAO = new TipoUsuarioDAO($this->con);
            $tipoUsuario = $tipoUsuarioDAO->consultarTipoUsuario($row[5]);

            $preguntaDAO = new PreguntaDAO($this->con);
            $pregunta = $preguntaDAO->consultarPregunta($row[6]);

            $cargoDAO = new CargoDAO($this->con);
            $cargo = $cargoDAO->consultarCargo($row[9]);

			$usuario = new Usuario($row[0], $row[1], $row[2], $row[3], $tarjeta, $tipoUsuario, $pregunta, $row[7], $row[8],
             $cargo, $row[10]);
			return $usuario;
        }

        /**
         * Obtiene un usuario de la base de datos a partir de su correo
         *
         * @param String $correo_usuario
         * @return Usuario usuario
         */
        public function consultarUsuarioCorreo($correo_usuario) {
            $sql = "SELECT * FROM USUARIO WHERE correo_usuario = '$correo_usuario'";
			if(!$result = mysqli_query($this->con, $sql)) die();
            if(mysqli_num_rows($result)==0) {
                return null;
            } else {
                $row = mysqli_fetch_array($result);

                if($row[4] != null) {
                    $tarjetaDAO = new TarjetaDAO($this->con);
                    $tarjeta = $tarjetaDAO->consultarTarjeta($row[4]);
                } else {
                    $tarjeta = null;
                }

                $tipoUsuarioDAO = new TipoUsuarioDAO($this->con);
                $tipoUsuario = $tipoUsuarioDAO->consultarTipoUsuario($row[5]);

                $preguntaDAO = new PreguntaDAO($this->con);
                $pregunta = $preguntaDAO->consultarPregunta($row[6]);

                $cargoDAO = new CargoDAO($this->con);
                $cargo = $cargoDAO->consultarCargo($row[9]);

                $usuario = new Usuario($row[0], $row[1], $row[2], $row[3], $tarjeta, $tipoUsuario, $pregunta, $row[7], $row[8],
                $cargo, $row[10]);
                return $usuario;
            }
        }

        /**
         * Obtiene los usuarios de la base de datos
         *
         * @return Usuario[] usuarios
         */
        public function obtenerUsuarios() {
            $sql = "SELECT * FROM USUARIO";
			if(!$result = mysqli_query($this->con, $sql)) die();
			$usuarios = array();
			while ($row = mysqli_fetch_array($result)) {
				if($row[4] != null) {
                 $tarjetaDAO = new TarjetaDAO($this->con);
                $tarjeta = $tarjetaDAO->consultarTarjeta($row[4]);
                } else {
                    $tarjeta = null;
                }

                $tipoUsuarioDAO = new TipoUsuarioDAO($this->con);
                $tipoUsuario = $tipoUsuarioDAO->consultarTipoUsuario($row[5]);

                $preguntaDAO = new PreguntaDAO($this->con);
                $pregunta = $preguntaDAO->consultarPregunta($row[6]);

                $cargoDAO = new CargoDAO($this->con);
                $cargo = $cargoDAO->consultarCargo($row[9]);

                $usuario[] = new Usuario($row[0], $row[1], $row[2], $row[3], $tarjeta, $tipoUsuario, $pregunta, $row[7], $row[8],
                $cargo, $row[10]);
			}
			return $usuarios;
        }

        /**
		 * Modifica a un usuario en la base de datos
		 * @param  Usuario $usuarioMod
		 */
		public function modificarUsuario($usuarioMod) {
            $sql = "SELECT cod_tarjeta FROM TARJETA WHERE nom_titular_tarjeta = '".$usuarioMod->getTarjeta()->getNom_titular_tarjeta()."' ORDER BY cod_tarjeta DESC LIMIT 1";
            if((!$result = mysqli_query($this->con, $sql))) die();
			$row = mysqli_fetch_array($result);
			$sql = "UPDATE USUARIO SET nom_usuario = '".$usuarioMod->getNom_usuario()."', estado = '".$usuarioMod->getEstado().
            "', cod_t_usuario = ".$usuarioMod->getTipo_usuario()->getCod_t_usuario().", correo_usuario = '".$usuarioMod->getCorreo_usuario().
            "', contrasenia_usuario = '".$usuarioMod->getContrasenia_usuario()."', cod_tarjeta = ".$row['cod_tarjeta'].
            ", cod_pregunta = ".$usuarioMod->getPregunta()->getCod_pregunta().", respuesta_pregunta = '".$usuarioMod->getRespuesta_pregunta().
            "', reservas_compras = ".$usuarioMod->getReservas_compras().", cod_cargo = ".$usuarioMod->getCargo()->getCod_cargo().
            " WHERE cod_usuario = ".$usuarioMod->getCod_usuario();
			mysqli_query($this->con, $sql);
		}

        /**
         * Cambia el estado a inactivo de un usuario
         *
         * @param Usuario $usuario
         */
        public function eliminarUsuario($usuario) {
            $sql = "UPDATE USUARIO SET estado = 'I' WHERE cod_usuario = ".$usuario->getCod_usuario();
            mysqli_query($this->con, $sql);
        }

        /**
         * Obtiene los usuarios filtrados de la base de datos
         *
         * @param String $filtro
         * @return Usuario[] usuarios
         */
        public function obtenerUsuariosFiltrados($filtro) {
            $sql = "SELECT * FROM USUARIO WHERE ".$filtro;
			if(!$result = mysqli_query($this->con, $sql)) die();
			$usuarios = array();
			while ($row = mysqli_fetch_array($result)) {
				if($row[4] != null) {
                 $tarjetaDAO = new TarjetaDAO($this->con);
                $tarjeta = $tarjetaDAO->consultarTarjeta($row[4]);
                } else {
                    $tarjeta = null;
                }

                $tipoUsuarioDAO = new TipoUsuarioDAO($this->con);
                $tipoUsuario = $tipoUsuarioDAO->consultarTipoUsuario($row[5]);

                $preguntaDAO = new PreguntaDAO($this->con);
                $pregunta = $preguntaDAO->consultarPregunta($row[6]);

                $cargoDAO = new CargoDAO($this->con);
                $cargo = $cargoDAO->consultarCargo($row[9]);

                $usuario[] = new Usuario($row[0], $row[1], $row[2], $row[3], $tarjeta, $tipoUsuario, $pregunta, $row[7], $row[8],
                $cargo, $row[10]);
			}
			return $usuarios;
        }
    }
?>