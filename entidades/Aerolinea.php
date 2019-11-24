<?php
    /**
     * Representa la entidad Aerolinea
     */
    class Aerolinea {
        //------------------------------------------------
        //Atributos
        //------------------------------------------------

        /**
         * Representa el código de la aerolínea en la base de datos
         *
         * @var int
         */
        private $cod_aerolinea;

        /**
         * Representa el nombre de la aerolínea
         *
         * @var String
         */
        private $nom_aerolinea;

        //------------------------------------------------
        //Constructor
        //------------------------------------------------

        /**
         * Constructor de una nueva Aerolínea
         *
         * @param int    $cod_aerolinea
         * @param String $nom_aerolinea
         */
        public function __construct($cod_aerolinea, $nom_aerolinea){
            $this->cod_aerolinea = $cod_aerolinea;
            $this->nom_aerolinea = $nom_aerolinea;
        }

        /**
         * Retorna el código de la aerolínea en la base de datos
         *
         * @return  int cod_aerolinea
         */ 
        public function getCod_aerolinea()
        {
                return $this->cod_aerolinea;
        }

        /**
         * Cambia el código de la aerolínea en la base de datos
         *
         * @param  int  $cod_aerolinea  
         */ 
        public function setCod_aerolinea($cod_aerolinea)
        {
                $this->cod_aerolinea = $cod_aerolinea;
        }

        /**
         * Cambia el nombre de la aerolínea
         *
         * @return  String nom_aerolinea
         */ 
        public function getNom_aerolinea()
        {
                return $this->nom_aerolinea;
        }

        /**
         * Cambia el nombre de la aerolínea
         *
         * @param  String  $nom_aerolinea  
         */ 
        public function setNom_aerolinea($nom_aerolinea)
        {
                $this->nom_aerolinea = $nom_aerolinea;
        }
    }
?>