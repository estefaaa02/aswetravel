<?php

    /**
     * Representa la clase de la entidad TipoUsuario
     */
    class TipoUsuario {

        //---------------------------------------
        //Atributos
        //---------------------------------------

        /**
         * Representa el código del tipo de usuario en la base de datos
         *
         * @var int
         */
        private $cod_t_usuario;

        /**
         * Representa el nombre del tipo de usuario
         *
         * @var String
         */
        private $nom_t_usuario;

        //------------------------------------
        //Constructor
        //------------------------------------

        /**
         * Constructor de un nuevo tipo de usuario
         *
         * @param int    $cod_t_usuario
         * @param String $nom_t_usuario
         */
        public function __construct($cod_t_usuario, $nom_t_usuario) {
            $this->cod_t_usuario = $cod_t_usuario;
            $this->nom_t_usuario = $nom_t_usuario;
        }

        //-----------------------------------
        //Métodos
        //-----------------------------------

        /**
         * Retorna el valor del código del tipo de usuario
         *
         * @return int cod_t_usuario
         */
        public function getCod_t_usuario()
        {
                return $this->cod_t_usuario;
        }

        /**
         * Cambia el valor del código del tipo de usuario en la base de datos
         *
         * @param  int  $cod_t_usuario 
         */ 
        public function setCod_t_usuario($cod_t_usuario)
        {
                $this->cod_t_usuario = $cod_t_usuario;
        }

        /**
         * Retorna el valor del nombre del tipo de usuario
         *
         * @return String nom_t_usuario
         */ 
        public function getNom_t_usuario()
        {
                return $this->nom_t_usuario;
        }

        /**
         * Cambia el valor del nombre del tipo de usuario
         *
         * @param  String  $nom_t_usuario 
         */ 
        public function setNom_t_usuario($nom_t_usuario)
        {
                $this->nom_t_usuario = $nom_t_usuario;
        }
    }
?>