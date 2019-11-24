<?php



	/** 

     * Se incluye el archivo Asiento.php  

    */

	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Asiento.php');



    /** 

     * Se incluye el archivo CategoriaAsientoDAO.php  

    */

	require_once('CategoriaAsientoDAO.php');



    /** 

     * Se incluye el archivo CategoriaAsiento.php  

    */

	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/CategoriaAsiento.php');



    /**

     * Representa el DAO de la clase Asiento

     */

    class AsientoDAO {

        //------------------------------------------------------------

		//Atributos

		//-------------------------------------------------------------



        /**

         * Representa la conexion a la base de datos

         *

         * @var Object

         */

		private $con;



		//---------------------------------------------------------------

		//Constructor

		//---------------------------------------------------------------



		/**

		 * Constructor de un nuevo DAO de Asiento

		 */

		public function __construct($con) {

			$this->con = $con;

			mysqli_set_charset($this->con, "utf8");

		}



        //----------------------------------------------------------------

        //Métodos

        //----------------------------------------------------------------



        /**

         * Obtiene un asiento de la base de datos a partir de su código

         *

         * @param int $cod_asiento

         * @return Asiento asiento

         */

        public function consultarAsiento($cod_asiento) {

            $sql = "SELECT * FROM ASIENTO WHERE cod_asiento = $cod_asiento";



            if(!$result = mysqli_query($this->con, $sql)) die();

			$row = mysqli_fetch_array($result);



            $categoriaAsientoDAO = new CategoriaAsientoDAO($this->con);

            $categoriaAsiento = $categoriaAsientoDAO->consultarCategoriaAsiento($row[2]);



            $asiento = new Asiento($row[0], $row[1], $categoriaAsiento);

			return $asiento;

        }



        /**

         * Obtiene los asientos de la base de datos

         *

         * @return Asiento[] asientos

         */

        public function obtenerAsientos() {

            $sql = "SELECT * FROM ASIENTO";

			if(!$result = mysqli_query($this->con, $sql)) die();

			$asientos = array();

			while ($row = mysqli_fetch_array($result)) {

				$categoriaAsientoDAO = new CategoriaAsientoDAO($this->con);

                $categoriaAsiento = $categoriaAsientoDAO->consultarCategoriaAsiento($row[2]);



                $asientos[] = new Asiento($row[0], $row[1], $categoriaAsiento);

			}

			return $asientos;

        }

        /**
         * Obtener asiento por categoria
         *
         * @param int $cod_categoria
         * @return Asiento[] asientos
         */
        public function obtenerAsientosPorCategoria($cod_categoria)
        {
            $sql = "SELECT * FROM ASIENTO WHERE cod_categoria_asiento = $cod_categoria";

            if(!$result = mysqli_query($this->con, $sql)) die();

            $asientos = array();

            while($row = mysqli_fetch_array($result))
            {
                $categoriaAsientoDAO = new CategoriaAsientoDAO($this->con);

                $categoriaAsiento = $categoriaAsientoDAO->consultarCategoriaAsiento($row[2]);

                $asientos[] = new Asiento($row[0], $row[1], $categoriaAsiento);
            }

            return $asientos;
        }


        /**

         * Obtiene los asientos por viaje de la base de datos

         *

         * @param int $cod_viaje

         * @return Asiento[] asientos

         */

        public function obtenerAsientosPorViaje($cod_viaje) {

            $sql = "SELECT * FROM ASIGNACION WHERE cod_viaje = $cod_viaje";

			if(!$result = mysqli_query($this->con, $sql)) die();

			$asientos = array();

			while ($row = mysqli_fetch_array($result)) {



                $sql = "SELECT * FROM ASIENTO WHERE cod_asiento = ".$row[1];



                if(!$result = mysqli_query($this->con, $sql)) die();

                while ($row2 = mysqli_fetch_array($result)) {



                    $categoriaAsientoDAO = new CategoriaAsientoDAO($this->con);

                    $categoriaAsiento = $categoriaAsientoDAO->consultarCategoriaAsiento($row2[2]);



                    $asientos[] = new Asiento($row2[0], $row2[1], $categoriaAsiento);

                }

			}

			return $asientos;

        }



        /**

         * Obtiene los asientos ocupados por vuelo de la base de datos

         *

         * @param int $cod_vuelo

         * @return Asiento[] asientos

         */

        public function obtenerAsientosOcupadosPorVuelo($cod_vuelo) {


            $sql = "SELECT * FROM VIAJE_VUELO WHERE cod_vuelo = $cod_vuelo";

            if(!$result = mysqli_query($this->con, $sql)) die();

            $asientos = array();

                while ($row = mysqli_fetch_array($result)) {

    
                    $sql = "SELECT * FROM ASIGNACION WHERE cod_viaje = ". $row[0];
    
                    if(!$result = mysqli_query($this->con, $sql)) die();
    
                    while ($row2 = mysqli_fetch_array($result)) {
    
                        $sql = "SELECT * FROM ASIENTO WHERE cod_asiento = ".$row2[1];
    
    
    
                        if(!$result = mysqli_query($this->con, $sql)) die();
    
                        while ($row3 = mysqli_fetch_array($result)) {
    
                            $categoriaAsientoDAO = new CategoriaAsientoDAO($this->con);
    
                            $categoriaAsiento = $categoriaAsientoDAO->consultarCategoriaAsiento($row3[2]);
    
    
    
                            $asientos[] = new Asiento($row3[0], $row3[1], $categoriaAsiento);
    
                        }
    
                    }
    
                }

			return $asientos;

        }



    }

?>