<?php

    /**
     * Representa la clase de la entidad Asiento
     */
    class Asiento {
        //---------------------------------------------------
        //Atributos
        //---------------------------------------------------

        /**
         * Representa el código del asiento en la base de datos
         *
         * @var int
         */
        private $cod_asiento;

        /**
         * Representa el nombre del asiento
         *
         * @var String
         */
        private $nom_asiento;

        /**
         * Representa la categoria del asiento. [Economía, Negocios, Primera Clase]
         *
         * @var CategoriaAsiento
         */
        private $categoria_asiento;

        //------------------------------------------------------------------------
        //Constructor
        //------------------------------------------------------------------------

        /**
         * Constructor de un nuevo asiento
         *
         * @param int              $cod_asiento
         * @param String           $nom_asiento
         * @param CategoriaAsiento $categoria_asiento
         */
        public function __construct($cod_asiento, $nom_asiento, $categoria_asiento) {
            $this->cod_asiento = $cod_asiento;
            $this->nom_asiento = $nom_asiento;
            $this->categoria_asiento = $categoria_asiento;
        }

        //----------------------------------------------------------------------
        //Métodos
        //----------------------------------------------------------------------

        /**
         * Retorna el código del asiento en la base de datos
         *
         * @return  int cod_asiento
         */ 
        public function getCod_asiento()
        {
                return $this->cod_asiento;
        }

        /**
         * Cambia el código del asiento en la base de datos
         *
         * @param  int  $cod_asiento  
         */ 
        public function setCod_asiento($cod_asiento)
        {
                $this->cod_asiento = $cod_asiento;
        }

        /**
         * Cambia el nombre del asiento
         *
         * @return  String nom_asiento
         */ 
        public function getNom_asiento()
        {
                return $this->nom_asiento;
        }

        /**
         * Cambia el nombre del asiento
         *
         * @param  String  $nom_asiento 
         */ 
        public function setNom_asiento($nom_asiento)
        {
                $this->nom_asiento = $nom_asiento;
        }

        /**
         * Retorna la categoria del asiento. [Economía, Negocios, Primera Clase]
         *
         * @return  CategoriaAsiento categoria_asiento
         */ 
        public function getCategoria_asiento()
        {
                return $this->categoria_asiento;
        }

        /**
         * Cambia la categoria del asiento. [Economía, Negocios, Primera Clase]
         *
         * @param  CategoriaAsiento  $categoria_asiento  
         */ 
        public function setCategoria_asiento($categoria_asiento)
        {
                $this->categoria_asiento = $categoria_asiento;
        }
    }
?>