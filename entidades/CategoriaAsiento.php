<?php

    /**
     * Representa la clase de la entidad Categoria Asiento
     */
    class CategoriaAsiento {

        //--------------------------------------------------------------
        //Atributos
        //--------------------------------------------------------------

        /**
         * Representa el código de la categoría del asiento en la base de datos
         *
         * @var int
         */
        private $cod_categoria_asiento;

        /**
         * Representa el nombre de la categoría del asiento
         *
         * @var String
         */
        private $nom_categoria_asiento;

        //-------------------------------------------------------------
        //Constructor
        //-------------------------------------------------------------

        /**
         * Constructor de una nueva categoría
         *
         * @param int    $cod_categoria_asiento
         * @param String $nom_categoria_asiento
         */
        public function __construct($cod_categoria_asiento, $nom_categoria_asiento) {
            $this->cod_categoria_asiento = $cod_categoria_asiento;
            $this->nom_categoria_asiento = $nom_categoria_asiento;
        }

        /**
         * Retorna el código de la categoría del asiento en la base de datos
         *
         * @return  int cod_categoria_asiento
         */ 
        public function getCod_categoria_asiento()
        {
                return $this->cod_categoria_asiento;
        }

        /**
         * Cambia el código de la categoría del asiento en la base de datos
         *
         * @param  int  $cod_categoria_asiento  
         */ 
        public function setCod_categoria_asiento($cod_categoria_asiento)
        {
                $this->cod_categoria_asiento = $cod_categoria_asiento;
        }

        /**
         * Retorna el nombre de la categoría del asiento
         *
         * @return  String nom_categoria_asiento
         */ 
        public function getNom_categoria_asiento()
        {
                return $this->nom_categoria_asiento;
        }

        /**
         * Cambia el nombre de la categoría del asiento
         *
         * @param  String  $nom_categoria_asiento  
         */ 
        public function setNom_categoria_asiento($nom_categoria_asiento)
        {
                $this->nom_categoria_asiento = $nom_categoria_asiento;
        }
    }
?>