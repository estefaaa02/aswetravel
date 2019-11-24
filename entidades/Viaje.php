<?php
    /**
     * Representa la clase de la entidad Viaje
     */
    class Viaje {
        //-------------------------------
        //Atributos
        //-------------------------------

        /**
         * Representa el código del viaje en la base de datos
         *
         * @var int
         */
        private $cod_viaje;

        /**
         * Representa el estado del viaje. [(C)omprado, (R)eservado, (C)ancelado]
         *
         * @var char
         */
        private $estado;

        /**
         * Representa el precio del viaje
         *
         * @var double
         */
        private $precio;
        
        /**
         * Representa la duracion del viaje
         *
         * @var String
         */
        private $duracion_viaje;

        /**
         * Representa el usuario que realizó la compra o reserva del viaje
         *
         * @var Usuario
         */
        private $usuario;

        /**
         * Representa la fecha de cuando se realizó la reserva del viaje
         *
         * @var Date
         */
        private $fecha_reserva;
        
        /**
         * Representa la fecha de cuando se realizó la compra del viaje
         *
         * @var Date
         */
        private $fecha_compra;

        /**
         * Representa los vuelos que hará el viaje
         *
         * @var Vuelo[]
         */
        private $vuelos;
        
        /**
         * Representa los asientos asignados al usuario que realizó la compra o reserva del viaje
         *
         * @var Asiento[]
         */
        private $asientos;

        //---------------------------------------------------------
        //Constructor
        //---------------------------------------------------------

        /**
         * Constructor de un nuevo viaje
         *
         * @param int       $cod_viaje
         * @param char      $estado
         * @param double    $precio_viaje
         * @param String    $duracion_viaje
         * @param Usuario   $usuario
         * @param Date      $fecha_reserva
         * @param Date      $fecha_compra
         * @param Vuelo[]   $vuelos
         * @param Asiento[] $asientos
         */
        public function __construct($cod_viaje, $estado, $precio_viaje, $duracion_viaje,
        $usuario, $fecha_reserva, $fecha_compra, $vuelos, $asientos) {
            $this->cod_viaje = $cod_viaje;
            $this->estado = $estado;
            $this->precio_viaje = $precio_viaje;
            $this->duracion_viaje = $duracion_viaje;
            $this->usuario = $usuario;
            $this->fecha_reserva = $fecha_reserva;
            $this->fecha_compra = $fecha_compra;
            $this->vuelos = $vuelos;
            $this->asientos = $asientos;
        }

        /**
         * Retorna el código del viaje en la base de datos
         *
         * @return  int cod_viaje
         */ 
        public function getCod_viaje()
        {
                return $this->cod_viaje;
        }

        /**
         * Cambia el código del viaje en la base de datos
         *
         * @param  int  $cod_viaje
         */ 
        public function setCod_viaje($cod_viaje)
        {
                $this->cod_viaje = $cod_viaje;
        }

        /**
         * Retorna el estado del viaje. [(C)omprado, (R)eservado, (C)ancelado]
         *
         * @return  char estado
         */ 
        public function getEstado()
        {
                return $this->estado;
        }

        /**
         * Cambia el estado del viaje. [(C)omprado, (R)eservado, (C)ancelado]
         *
         * @param  char  $estado  
         */ 
        public function setEstado($estado)
        {
                $this->estado = $estado;
        }

        /**
         * Retorna el precio del viaje
         *
         * @return  double precio_viaje
         */ 
        public function getPrecio_viaje()
        {
                return $this->precio_viaje;
        }

        /**
         * Cambia el precio del viaje
         *
         * @param  double  $precio_viaje 
         */ 
        public function setPrecio_viaje($precio_viaje)
        {
                $this->precio_viaje = $precio_viaje;
        }

        /**
         * Retorna la duracion del viaje
         *
         * @return  String duracion_viaje
         */ 
        public function getDuracion_viaje()
        {
                return $this->duracion_viaje;
        }

        /**
         * Cambia la duracion del viejo
         *
         * @param  String  $duracion_viejo  
         */ 
        public function setDuracion_viejo($duracion_viaje)
        {
                $this->duracion_viaje = $duracion_viaje;
        }

        /**
         * Retorna el usuario que realizó la compra o reserva del viaje
         *
         * @return  Usuario usuario
         */ 
        public function getUsuario()
        {
                return $this->usuario;
        }

        /**
         * Cambia el usuario que realizó la compra o reserva del vuelo
         *
         * @param  Usuario  $usuario  
         */ 
        public function setUsuario($usuario)
        {
                $this->usuario = $usuario;
        }

        /**
         * Retorna la fecha de cuando se realizó la reserva del viaje
         *
         * @return  Date fecha_reserva
         */ 
        public function getFecha_reserva()
        {
                return $this->fecha_reserva;
        }

        /**
         * Cambia la fecha de cuando se realizó la reserva del viaje
         *
         * @param  Date  $fecha_reserva  
         */ 
        public function setFecha_reserva($fecha_reserva)
        {
                $this->fecha_reserva = $fecha_reserva;
        }

        /**
         * Retorna los vuelos que hará el viaje
         *
         * @return  Vuelo[] vuelos
         */ 
        public function getVuelos()
        {
                return $this->vuelos;
        }

        /**
         * Cambia los vuelos que hará el viaje
         *
         * @param  Vuelo[]  $vuelo
         */ 
        public function setVuelos($vuelos)
        {
                $this->vuelos = $vuelos;
        }

        /**
         * Retorna los asientos asignados al usuario que realizó la compra o reserva del viaje
         *
         * @return  Asiento[] asientos
         */ 
        public function getAsientos()
        {
                return $this->asientos;
        }

        /**
         * Cambia los asientos asignados al usuario que realizó la compra o reserva del viaje
         *
         * @param  Asiento[]  $asientos 
         */ 
        public function setAsientos($asientos)
        {
                $this->asientos = $asientos;
        }
    }
?>