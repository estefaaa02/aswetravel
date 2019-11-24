<?php
    /**
     * Representa la clase de la entidad Pregunta
     */
    class Pregunta {

        //---------------------------------------------
        //Atributos
        //---------------------------------------------

        /**
         * Representa el código de la pregunta en la base de datos
         *
         * @var int
         */
        private $cod_pregunta;

        /**
         * Representa el nombre de la pregunta
         *
         * @var String
         */
        private $nom_pregunta;

        //----------------------------------------------
        //Constructor
        //----------------------------------------------

        /**
         * Constructor de una nueva pregunta
         *
         * @param int    $cod_pregunta
         * @param String $nom_pregunta
         */
        public function __construct($cod_pregunta, $nom_pregunta) {
            $this->cod_pregunta = $cod_pregunta;
            $this->nom_pregunta = $nom_pregunta;
        }

        /**
         * Retorna el código de la pregunta en la base de datos
         *
         * @return  int cod_pregunta
         */ 
        public function getCod_pregunta()
        {
                return $this->cod_pregunta;
        }

        /**
         * Cambia el código de la pregunta en la base de datos
         *
         * @param  int  $cod_pregunta 
         */ 
        public function setCod_pregunta($cod_pregunta)
        {
                $this->cod_pregunta = $cod_pregunta;
        }

        /**
         * Retorna el nombre de la pregunta
         *
         * @return  String nom_pregunta
         */ 
        public function getNom_pregunta()
        {
                return $this->nom_pregunta;
        }

        /**
         * Cambia el nombre de la pregunta
         *
         * @param  String  $nom_pregunta 
         */ 
        public function setNom_pregunta($nom_pregunta)
        {
                $this->nom_pregunta = $nom_pregunta;
        }
    }
?>