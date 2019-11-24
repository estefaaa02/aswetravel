<?php
    /**
     * Representa la clase de la entidad Auditoría
     */
    class Auditoria {

        //--------------------------------------------------------
        //Atributos
        //--------------------------------------------------------

        /**
         * Representa el código de la auditoría en la base de datos
         *
         * @var int
         */
        private $cod_auditoria;

        /**
         * Representa el código del usuario que realizó la acción
         *
         * @var int
         */
        private $cod_usuario;
        
        /**
         * Representa la dirección IP del usuario que realizó la acción
         *
         * @var String
         */
        private $direccion_ip;

        /**
         * Representa el nombre de la tabla que fue afectada por la acción realizada
         *
         * @var String
         */
        private $nom_tabla;

        /**
         * Representa el código dentro de la tabla que fue afectada por la acción
         *
         * @var int
         */
        private $cod_tabla;

        /**
         * Representa la fecha en la cual se realizó la acción
         *
         * @var Date
         */
        private $fecha;

        /**
         * Representa la acción realizada por el usuario
         *
         * @var char
         */
        private $accion;

        //------------------------------------------------------------
        //Constructor
        //------------------------------------------------------------

        public function __construct($cod_auditoria, $cod_usuario, $direccion_ip, $nom_tabla, $cod_tabla, $fecha, $accion) {
            $this->cod_auditoria = $cod_auditoria;
            $this->cod_usuario = $cod_usuario;
            $this->direccion_ip = $direccion_ip;
            $this->nom_tabla = $nom_tabla;
            $this->cod_tabla = $cod_tabla;
            $this->fecha = $fecha;
            $this->accion = $accion;
        }

        /**
         * Retorna el código de la auditoría en la base de datos
         *
         * @return  int cod_auditoria
         */ 
        public function getCod_auditoria()
        {
                return $this->cod_auditoria;
        }

        /**
         * Cambia el código de la auditoría en la base de datos
         *
         * @param  int  $cod_auditoria  
         */ 
        public function setCod_auditoria($cod_auditoria)
        {
                $this->cod_auditoria = $cod_auditoria;
        }

        /**
         * Retorna el código del usuario que realizó la acción
         *
         * @return  int cod_usuario
         */ 
        public function getCod_usuario()
        {
                return $this->cod_usuario;
        }

        /**
         * Cambia el código del usuario que realizó la acción
         *
         * @param  int  $cod_usuario  
         */ 
        public function setCod_usuario($cod_usuario)
        {
                $this->cod_usuario = $cod_usuario;
        }

        /**
         * Retorna el nombre de la tabla que fue afectada por la acción realizada
         *
         * @return  String nom_tabla
         */ 
        public function getNom_tabla()
        {
                return $this->nom_tabla;
        }

        /**
         * Cambia el nombre de la tabla que fue afectada por la acción realizada
         *
         * @param  String  $nom_tabla  
         */ 
        public function setNom_tabla($nom_tabla)
        {
                $this->nom_tabla = $nom_tabla;
        }

        /**
         * Retorna el código dentro de la tabla que fue afectada por la acción
         *
         * @return  int cod_tabla
         */ 
        public function getCod_tabla()
        {
                return $this->cod_tabla;
        }

        /**
         * Cambia el código dentro de la tabla que fue afectada por la acción
         *
         * @param  int  $cod_tabla  
         */ 
        public function setCod_tabla($cod_tabla)
        {
                $this->cod_tabla = $cod_tabla;
        }

        /**
         * Retorna la fecha en la cual se realizó la acción
         *
         * @return  Date fecha
         */ 
        public function getFecha()
        {
                return $this->fecha;
        }

        /**
         * Cambia la fecha en la cual se realizó la acción
         *
         * @param  Date  $fecha 
         */ 
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;
        }

        /**
         * Retorna la acción realizada por el usuario
         *
         * @return  char accion
         */ 
        public function getAccion()
        {
                return $this->accion;
        }

        /**
         * Cambia la acción realizada por el usuario
         *
         * @param  char  $accion 
         */ 
        public function setAccion($accion)
        {
                $this->accion = $accion;
        }
    }
?>