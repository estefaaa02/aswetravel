<?php
    /**
     * Representa la clase de la entidad Vuelo
     */
    class Vuelo {
        //-------------------------------------------
        //Atributos
        //-------------------------------------------

        /**
         * Representa el código del vuelo en la base de datos
         *
         * @var int
         */
        private $cod_vuelo;

        /**
         * Representa la ciudad de origen del vuelo
         *
         * @var Ciudad
         */
        private $ciudad_origen;

        /**
         * Representa la ciudad de destino del vuelo
         *
         * @var Ciudad
         */
        private $ciudad_destino;

        /**
         * Representa la fecha de salida del vuelo
         *
         * @var Date
         */
        private $fecha_salida;
        
        /**
         * Representa la fecha de llegada del vuelo
         *
         * @var Date
         */
        private $fecha_llegada;

        /**
         * Representa el precio del vuelo
         *
         * @var double
         */
        private $precio_vuelo;

        /**
         * Representa la aerolinea del vuelo
         *
         * @var Aerolinea
         */
        private $aerolinea;

        //---------------------------------------------------------
        //Constructor
        //---------------------------------------------------------

        /**
         * Constructor de un nuevo vuelo
         *
         * @param int    $cod_vuelo
         * @param Ciudad $ciudad_origen
         * @param Ciudad $ciudad_destino
         * @param double $precio_vuelo
         * @param Date   $fecha_salida
         * @param Date   $fecha_llegada
         * @param Aerolinea $aerolinea
         */
        public function __construct($cod_escala, $ciudad_origen, $ciudad_destino, $precio_vuelo, $fecha_salida, $fecha_llegada, $aerolinea) {
            $this->cod_escala = $cod_escala;
            $this->ciudad_origen = $ciudad_origen;
            $this->ciudad_destino = $ciudad_destino;
            $this->precio_vuelo = $precio_vuelo;
            $this->fecha_salida = $fecha_salida;
            $this->fecha_llegada = $fecha_llegada;
            $this->aerolinea = $aerolinea;
        }

        /**
         * Retorna el código del vuelo en la base de datos
         *
         * @return  int cod_vuelo
         */ 
        public function getCod_vuelo()
        {
                return $this->cod_vuelo;
        }

        /**
         * Cambia el código del vuelo en la base de datos
         *
         * @param  int  $cod_vuelo 
         */ 
        public function setCod_vuelo($cod_vuelo)
        {
                $this->cod_vuelo = $cod_vuelo;
        }

        /**
         * Retorna la ciudad de origen del vuelo
         *
         * @return  Ciudad ciudad_origen
         */ 
        public function getCiudad_origen()
        {
                return $this->ciudad_origen;
        }

        /**
         * Cambia la ciudad de origen del vuelo
         *
         * @param  Ciudad  $ciudad_origen  
         */ 
        public function setCiudad_origen($ciudad_origen)
        {
                $this->ciudad_origen = $ciudad_origen;
        }

        /**
         * Retorna la ciudad de destino del vuelo
         *
         * @return  Ciudad ciudad_destino
         */ 
        public function getCiudad_destino()
        {
                return $this->ciudad_destino;
        }

        /**
         * Cambia la ciudad de destino del vuelo
         *
         * @param  Ciudad  $ciudad_destino  
         */ 
        public function setCiudad_destino($ciudad_destino)
        {
                $this->ciudad_destino = $ciudad_destino;
        }

        /**
         * Retorna la fecha de salida del vuelo
         *
         * @return  Date fecha_salida
         */ 
        public function getFecha_salida()
        {
                return $this->fecha_salida;
        }

        /**
         * Cambia la fecha de salida del vuelo
         *
         * @param  Date  $fecha_salida  
         */ 
        public function setFecha_salida($fecha_salida)
        {
                $this->fecha_salida = $fecha_salida;
        }

        /**
         * Retorna la fecha de llegada del vuelo
         *
         * @return  Date fecha_llegada
         */ 
        public function getFecha_llegada()
        {
                return $this->fecha_llegada;
        }

        /**
         * Cambia la fecha de llegada del vuelo
         *
         * @param  Date  $fecha_llegada  
         */ 
        public function setFecha_llegada($fecha_llegada)
        {
                $this->fecha_llegada = $fecha_llegada;
        }

        /**
         * Retorna la aerolinea del vuelo
         *
         * @return  Aerolinea aerolina
         */ 
        public function getAerolinea()
        {
                return $this->aerolinea;
        }

        /**
         * Cambia la aerolinea del vuelo
         *
         * @param  Aerolinea  $aerolinea  
         */ 
        public function setAerolinea($aerolinea)
        {
                $this->aerolinea = $aerolinea;
        }

        /**
         * Get representa el precio del vuelo
         *
         * @return  double
         */ 
        public function getPrecio_vuelo()
        {
                return $this->precio_vuelo;
        }

        /**
         * Set representa el precio del vuelo
         *
         * @param  double  $precio_vuelo  
         */ 
        public function setPrecio_vuelo($precio_vuelo)
        {
                $this->precio_vuelo = $precio_vuelo;
        }
    }
?>