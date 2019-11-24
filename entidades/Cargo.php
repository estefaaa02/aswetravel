<?php

    /**
     * Representa la clase de la entidad Cargo
     */
    class Cargo {

        //--------------------------------------------------
        //Atributos
        //---------------------------------------------------

        /**
         * Representa el código del cargo en la base de datos
         *
         * @var int
         */
        private $cod_cargo;

        /**
         * Representa el nombre del cargo
         *
         * @var String
         */
        private $nom_cargo;

        //-----------------------------------------------------------
        //Constructor
        //-----------------------------------------------------------

        /**
         * Constructor de un nuevo cargo
         *
         * @param int    $cod_cargo
         * @param String $nom_cargo
         */
        public function __construct($cod_cargo, $nom_cargo) {
            $this->cod_cargo = $cod_cargo;
            $this->nom_cargo = $nom_cargo;
        }

        /**
         * Retorna el código del cargo en la base de datos
         *
         * @return  int cod_cargo
         */ 
        public function getCod_cargo()
        {
                return $this->cod_cargo;
        }

        /**
         * Cambia el código del cargo en la base de datos
         *
         * @param  int  $cod_cargo  
         */ 
        public function setCod_cargo($cod_cargo)
        {
                $this->cod_cargo = $cod_cargo;

                return $this;
        }

        /**
         * Retorna el nombre del cargo
         *
         * @return  String nom_cargo
         */ 
        public function getNom_cargo()
        {
                return $this->nom_cargo;
        }

        /**
         * Cambia el nombre del cargo
         *
         * @param  String  $nom_cargo 
         */ 
        public function setNom_cargo($nom_cargo)
        {
                $this->nom_cargo = $nom_cargo;
        }
    }
?>