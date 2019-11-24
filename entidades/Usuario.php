<?php
    /**
     * Clase que representa a la entidad Usuario
     */
    class Usuario {

        //----------------------------------------------------------------
        //Atributos
        //----------------------------------------------------------------

        /**
         * Representa el código del usuario en la base de datos
         *
         * @var int
         */
        private $cod_usuario;

        /**
         * Representa el nombre del usuario
         *
         * @var String
         */
        private $nom_usuario;

        /**
         * Representa el correo del usuario
         *
         * @var String
         */
        private $correo_usuario;

        /**
         * Representa la contraseña del usuario
         *
         * @var String
         */
        private $contrasenia_usuario;

        /**
         * Representa la tarjeta del usuario
         *
         * @var Tarjeta
         */
        private $tarjeta;

        /**
         * Representa el tipo de usuario. [Cliente, Asesor, Administrador]
         *
         * @var TipoUsuario
         */
        private $tipo_usuario;

        /**
         * Representa la pregunta de seguridad para recuperar la contraseña
         *
         * @var Pregunta
         */
        private $pregunta;

        /**
         * Representa la respuesta a la pregunta de seguridad
         *
         * @var String
         */
        private $respuesta_pregunta;

        /**
         * Representa la cantidad de reservas y compras que ha hecho el usuario en la página
         *
         * @var int
         */
        private $reservas_compras;

        /**
         * Representa el cargo del usuario. [Estudiante, Empleado, Desempleado, Independiente]
         *
         * @var Cargo
         */
        private $cargo;

        /**
         * Representa el estado del usuario en la página. [(A)ctivo, (I)nactivo]
         *
         * @var char
         */
        private $estado;

        //------------------------------------------------------------------------
        //Constructor
        //------------------------------------------------------------------------

        /**
         * Constructor de un nuevo usuario
         *
         * @param int        $cod_usuario
         * @param String     $nom_usuario
         * @param String     $correo_usuario
         * @param String     $contrasenia_usuario
         * @param Tarjeta    $tarjeta
         * @param Tiposuario $tipo_usuario
         * @param Pregunta   $pregunta
         * @param String     $respuesta_pregunta
         * @param int        $reservas_compras
         * @param Cargo      $cargo
         * @param char       $estado
         */
        public function __construct($cod_usuario, $nom_usuario, $correo_usuario, 
        $contrasenia_usuario, $tarjeta, $tipo_usuario, $pregunta, $respuesta_pregunta,
        $reservas_compras, $cargo, $estado) {
            $this->cod_usuario = $cod_usuario;
            $this->nom_usuario = $nom_usuario;
            $this->correo_usuario = $correo_usuario;
            $this->contrasenia_usuario = $contrasenia_usuario;
            $this->tarjeta = $tarjeta;
            $this->tipo_usuario = $tipo_usuario;
            $this->pregunta = $pregunta;
            $this->respuesta_pregunta = $respuesta_pregunta;
            $this->reservas_compras = $reservas_compras;
            $this->cargo = $cargo;
            $this->estado = $estado;
        }

        //------------------------------------------------------------------
        //Métodos
        //------------------------------------------------------------------
        

        /**
         * Retorna el código del usuario
         *
         * @return int cod_usuario
         */
        public function getCod_usuario()
        {
                return $this->cod_usuario;
        }

        /**
         * Cambia el valor del código del usuario
         *
         * @param int $cod_usuario
         */
        public function setCod_usuario($cod_usuario)
        {
                $this->cod_usuario = $cod_usuario;
        }

        /**
         * Retorna el nombre del usuario
         *
         * @return String nom_usuario
         */
        public function getNom_usuario()
        {
                return $this->nom_usuario;
        }

        /**
         * Cambia el valor del nombre del usuario
         *
         * @param String $nom_usuario
         */ 
        public function setNom_usuario($nom_usuario)
        {
                $this->nom_usuario = $nom_usuario;
        }

        /**
         * Retorna el valor del correo del usuario
         *
         * @return String correo_usuario
         */
        public function getCorreo_usuario()
        {
                return $this->correo_usuario;
        }

        /**
         * Cambia el valor del correo del usuario
         *
         * @param String $correo_usuario
         */
        public function setCorreo_usuario($correo_usuario)
        {
                $this->correo_usuario = $correo_usuario;
        }

        /**
         * Retorna el valor de la contraseña del usuario
         *
         * @return String contrasenia_usuario
         */
        public function getContrasenia_usuario()
        {
                return $this->contrasenia_usuario;
        }

        /**
         * Cambia el valor de la contraseña del usuario
         *
         * @param String $contrasenia_usuario
         */
        public function setContrasenia_usuario($contrasenia_usuario)
        {
                $this->contrasenia_usuario = $contrasenia_usuario;
        }

        /**
         * Retorna la tarjeta del usuario
         *
         * @return Tarjeta tarjeta
         */
        public function getTarjeta()
        {
                return $this->tarjeta;
        }

        /**
         * Cambia la tarjeta del usuario
         *
         * @param Tarjeta $tarjeta
         */
        public function setTarjeta($tarjeta)
        {
                $this->tarjeta = $tarjeta;
        }

        /**
         * Retorna el tipo del usuario. [Cliente, Asesor, Administrador]
         *
         * @return TipoUsuario tipo_usuario
         */
        public function getTipo_usuario()
        {
                return $this->tipo_usuario;
        }

        /**
         * Cambia el tipo del usuario
         *
         * @param TipoUsuario $tipo_usuario
         */
        public function setTipo_usuario($tipo_usuario)
        {
                $this->tipo_usuario = $tipo_usuario;
        }

        /**
         * Retorna la pregunta de seguridad del usuario
         *
         * @return Pregunta pregunta
         */
        public function getPregunta()
        {
                return $this->pregunta;
        }

        /**
         * Cambia la pregunta de seguridad del usuario
         *
         * @param Pregunta $pregunta
         */ 
        public function setPregunta($pregunta)
        {
                $this->pregunta = $pregunta;
        }

        /**
         * Retorna la respuesta a la pregunta de seguridad del usuario
         *
         * @return String respuesta_pregunta
         */ 
        public function getRespuesta_pregunta()
        {
                return $this->respuesta_pregunta;
        }

        /**
         * Cambia el valor de la respuesta a la pregunta de seguridad
         *
         * @param String $respuesta_pregunta
         */ 
        public function setRespuesta_pregunta($respuesta_pregunta)
        {
                $this->respuesta_pregunta = $respuesta_pregunta;
        }

        /**
         * Retorna el valor de las reservas y compras hechas por el usuario
         *
         * @return int reservas_compras
         */
        public function getReservas_compras()
        {
                return $this->reservas_compras;
        }

        /**
         * Cambia el valor de las reservas y compras hechas por el usuario
         *
         * @param int $reservas_compras
         */
        public function setReservas_compras($reservas_compras)
        {
                $this->reservas_compras = $reservas_compras;
        }

        /**
         * Retorna el cargo del usuario
         *
         * @return Cargo cargo
         */
        public function getCargo()
        {
                return $this->cargo;
        }

        /**
         * Cambia el cargo del usuario
         *
         * @param Cargo $cargo
         */
        public function setCargo($cargo)
        {
                $this->cargo = $cargo;
        }

        /**
         * Retorna el valor del estado del usuario. [(A)ctivo, (I)nactivo]
         *
         * @return char estado
         */
        public function getEstado()
        {
                return $this->estado;
        }

        /**
         * Cambia el valor del estado del usuario
         *
         * @param char $estado
         */
        public function setEstado($estado)
        {
                $this->estado = $estado;
        }
    }

?>