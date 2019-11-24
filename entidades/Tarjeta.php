<?php

    /**
     * Representa la clase de la entidad Tarjeta
     */
    class Tarjeta {

        //------------------------------------------------------------
        //Atributos
        //------------------------------------------------------------

        /**
         * Representa el código de la tarjeta en la base de datos
         *
         * @var int
         */
        private $cod_tarjeta;

        /**
         * Representa el número de la tarjeta
         *
         * @var int
         */
        private $numero_tarjeta;

        /**
         * Representa el número de seguridad de la tarjeta
         *
         * @var int
         */
        private $cvv_tarjeta;

        /**
         * Representa el nombre del titular de la tarjeta
         *
         * @var String
         */
        private $nom_titular_tarjeta;

        //---------------------------------------------------------------------------------
        //Constructor
        //-----------------------------------------------------------------------------------

        /**
         * Constructor de una nueva tarjeta
         *
         * @param int    $cod_tarjeta
         * @param int    $numero_tarjeta
         * @param int    $cvv_tarjeta
         * @param String $nom_titular_tarjeta
         */
        public function __construct($cod_tarjeta, $numero_tarjeta, $cvv_tarjeta, $nom_titular_tarjeta) {
            $this->cod_tarjeta = $cod_tarjeta;
            $this->numero_tarjeta = $numero_tarjeta;
            $this->cvv_tarjeta = $cvv_tarjeta;
            $this->nom_titular_tarjeta = $nom_titular_tarjeta;
        }

        /**
         * Retorna el valor del código de la tarjeta
         *
         * @return int cod_tarjeta
         */
        public function getCod_tarjeta()
        {
                return $this->cod_tarjeta;
        }

        /**
         * Cambia el valor del código de la tarjeta
         *
         * @param int $cod_tarjeta
         */
        public function setCod_tarjeta($cod_tarjeta)
        {
                $this->cod_tarjeta = $cod_tarjeta;
        }

        /**
         * Retorna el valor número de la tarjeta
         *
         * @return int numero_tarjeta
         */ 
        public function getNumero_tarjeta()
        {
                return $this->numero_tarjeta;
        }

        /**
         * Cambia el valor del número de la tarjeta
         *
         * @param int $numero_tarjeta
         */
        public function setNumero_tarjeta($numero_tarjeta)
        {
                $this->numero_tarjeta = $numero_tarjeta;
        }

        /**
         * Retorna el valor del número de seguridad de la tarjeta
         *
         * @return int cvv_tarjeta
         */
        public function getCvv_tarjeta()
        {
                return $this->cvv_tarjeta;
        }

        /**
         * Cambia el valor del número de seguridad de la tarjeta
         *
         * @param int $cvv_tarjeta
         */ 
        public function setCvv_tarjeta($cvv_tarjeta)
        {
                $this->cvv_tarjeta = $cvv_tarjeta;
        }

        /**
         * Retorna el valor del nombre del titular de la tarjeta
         *
         * @return String nom_titular_tarjeta
         */ 
        public function getNom_titular_tarjeta()
        {
                return $this->nom_titular_tarjeta;
        }

        /**
         * Cambia el valor del nombre del titular de la tarjeta
         *
         * @param String $nom_titular_tarjeta
         */
        public function setNom_titular_tarjeta($nom_titular_tarjeta)
        {
                $this->nom_titular_tarjeta = $nom_titular_tarjeta;
        }
    }
?>