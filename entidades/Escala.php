<?php
    /**
     * Representa la clase de la entidad Escala
     */
    class Escala {
        //-------------------------------------------
        //Atributos
        //-------------------------------------------

        /**
         * Representa el código de la escala en la base de datos
         *
         * @var int
         */
        private $cod_escala;

        /**
         * Representa la ciudad de origen de la escala
         *
         * @var Ciudad
         */
        private $ciudad_origen;

        /**
         * Representa la ciudad de destino de la escala
         *
         * @var Ciudad
         */
        private $ciudad_destino;

        /**
         * Representa la fecha de salida de la escala
         *
         * @var Date
         */
        private $fecha_salida;
        
        /**
         * Representa la fecha de llegada de la escala
         *
         * @var Date
         */
        private $fecha_llegada;

        /**
         * Representa la aerolinea de la escala
         *
         * @var Aerolinea
         */
        private $aerolinea;

        //---------------------------------------------------------
        //Constructor
        //---------------------------------------------------------

        /**
         * Constructor de una nueva escala
         *
         * @param int    $cod_escala
         * @param Ciudad $ciudad_origen
         * @param Ciudad $ciudad_destino
         * @param Date   $fecha_salida
         * @param Date   $fecha_llegada
         */
        public function __construct($cod_escala, $ciudad_origen, $ciudad_destino, $fecha_salida, $fecha_llegada, $aerolinea) {
            $this->cod_escala = $cod_escala;
            $this->ciudad_origen = $ciudad_origen;
            $this->ciudad_destino = $ciudad_destino;
            $this->fecha_salida = $fecha_salida;
            $this->fecha_llegada = $fecha_llegada;
            $this->aerolinea = $aerolinea;
        }

        /**
         * Retorna el código de la escala en la base de datos
         *
         * @return  int cod_escala
         */ 
        public function getCod_escala()
        {
                return $this->cod_escala;
        }

        /**
         * Cambia el código de la escala en la base de datos
         *
         * @param  int  $cod_escala 
         */ 
        public function setCod_escala($cod_escala)
        {
                $this->cod_escala = $cod_escala;
        }

        /**
         * Retorna la ciudad de origen de la escala
         *
         * @return  Ciudad ciudad_origen
         */ 
        public function getCiudad_origen()
        {
                return $this->ciudad_origen;
        }

        /**
         * Cambia la ciudad de origen de la escala
         *
         * @param  Ciudad  $ciudad_origen  
         */ 
        public function setCiudad_origen($ciudad_origen)
        {
                $this->ciudad_origen = $ciudad_origen;
        }

        /**
         * Retorna la ciudad de destino de la escala
         *
         * @return  Ciudad ciudad_destino
         */ 
        public function getCiudad_destino()
        {
                return $this->ciudad_destino;
        }

        /**
         * Cambia la ciudad de destino de la escala
         *
         * @param  Ciudad  $ciudad_destino  
         */ 
        public function setCiudad_destino($ciudad_destino)
        {
                $this->ciudad_destino = $ciudad_destino;
        }

        /**
         * Retorna la fecha de salida de la escala
         *
         * @return  Date fecha_salida
         */ 
        public function getFecha_salida()
        {
                return $this->fecha_salida;
        }

        /**
         * Cambia la fecha de salida de la escala
         *
         * @param  Date  $fecha_salida  
         */ 
        public function setFecha_salida($fecha_salida)
        {
                $this->fecha_salida = $fecha_salida;
        }

        /**
         * Retorna la fecha de llegada de la escala
         *
         * @return  Date fecha_llegada
         */ 
        public function getFecha_llegada()
        {
                return $this->fecha_llegada;
        }

        /**
         * Cambia la fecha de llegada de la escala
         *
         * @param  Date  $fecha_llegada  
         */ 
        public function setFecha_llegada($fecha_llegada)
        {
                $this->fecha_llegada = $fecha_llegada;
        }

        /**
         * Retorna la aerolinea de la escala
         *
         * @return  Aerolinea aerolina
         */ 
        public function getAerolinea()
        {
                return $this->aerolinea;
        }

        /**
         * Cambia la aerolinea de la escala
         *
         * @param  Aerolinea  $aerolinea  
         */ 
        public function setAerolinea($aerolinea)
        {
                $this->aerolinea = $aerolinea;
        }
    }
?>