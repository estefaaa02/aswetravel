<?php
    /**
     * Representa la clase de la entidad Ciudad
     */
    class Ciudad {
        //--------------------------------------------------
        //Atributos
        //--------------------------------------------------

        /**
         * Representa el código de la ciudad en la base de datos
         *
         * @var int
         */
        private $cod_ciudad;
        
        /**
         * Representa el nombre de la ciudad
         *
         * @var String
         */
        private $nom_ciudad;

        //----------------------------------------------------
        //Constructor
        //----------------------------------------------------

        /**
         * Constructor de una nueva ciudad
         *
         * @param int    $cod_ciudad
         * @param String $nom_ciudad
         */
        public function __construct($cod_ciudad, $nom_ciudad) {
            $this->cod_ciudad = $cod_ciudad;
            $this->nom_ciudad = $nom_ciudad;
        }

        //-----------------------------------------------------
        //Métodos
        //-----------------------------------------------------

        /**
         * Retorna el código de la ciudad en la base de datos
         *
         * @return  int cod_ciudad
         */ 
        public function getCod_ciudad()
        {
                return $this->cod_ciudad;
        }

        /**
         * Cambia el código de la ciudad en la base de datos
         *
         * @param  int  $cod_ciudad  
         */ 
        public function setCod_ciudad($cod_ciudad)
        {
                $this->cod_ciudad = $cod_ciudad;
        }

        /**
         * Retorna el nombre de la ciudad
         *
         * @return  String nom_ciudad
         */ 
        public function getNom_ciudad()
        {
                return $this->nom_ciudad;
        }

        /**
         * Cambia el nombre de la ciudad
         *
         * @param  String  $nom_ciudad 
         */ 
        public function setNom_ciudad($nom_ciudad)
        {
                $this->nom_ciudad = $nom_ciudad;
        }
    }
?> 