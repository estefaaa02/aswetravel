<?php


	/** 
     * Se incluye el archivo Tarjeta.php  
    */
	require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Tarjeta.php');

    /**
     * Representa el DAO de la clase Tarjeta
     */
    class TarjetaDAO {
        
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
		 * Constructor de un nuevo DAO de tarjeta
		 */
		public function __construct($con) {
			$this->con = $con;
			mysqli_set_charset($this->con, "utf8");
		}

        //----------------------------------------------------------------
        //Métodos
        //----------------------------------------------------------------

        /**
         * Crea una nueva tarjeta en la base de datos
         *
         * @param Tarjeta $nuevaTarjeta
         */
        public function crearTarjeta($nuevaTarjeta) {
            $key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
            echo $key."<br>";
            $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
            echo $nonce."<br>";
            $ciphertext = sodium_crypto_secretbox($nuevaTarjeta->getNumero_tarjeta().'', $nonce, $key);
            echo $ciphertext."<br>";
            $encoded = base64_encode($key . $nonce . $ciphertext);
            $sql = "INSERT INTO TARJETA VALUES (0,'".$encoded."',".$nuevaTarjeta->getCvv_tarjeta().
            ",'".$nuevaTarjeta->getNom_titular_tarjeta()."')";
            mysqli_query($this->con, $sql);
        }

        /**
         * Obtiene una tarjeta de la base de datos a partir de su código
         *
         * @param int $cod_tarjeta
         * @return Tarjeta tarjeta
         */
        public function consultarTarjeta($cod_tarjeta) {
            $sql = "SELECT * FROM TARJETA WHERE cod_tarjeta = $cod_tarjeta";

            if(!$result = mysqli_query($this->con, $sql)) die();
			$row = mysqli_fetch_array($result);

            $decoded = base64_decode($row[1]);
            $key = substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
            $nonce = substr($decoded, SODIUM_CRYPTO_SECRETBOX_KEYBYTES, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
            $ciphertext = substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
            $plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);

            $tarjeta = new Tarjeta($row[0], $plaintext, $row[2], $row[3]);
			return $tarjeta;
        }

        /**
         * Obtiene una tarjeta de la base de datos a partir de su titular
         *
         * @param String $nom_titular_tarjeta
         * @return $tarjeta
         */
        public function consultarTarjetaPorNum($nom_titular_tarjeta) {
            $sql = "SELECT * FROM TARJETA WHERE nom_titular_tarjeta = '$nom_titular_tarjeta' ORDER BY cod_tarjeta DESC LIMIT 1";

            if(!$result = mysqli_query($this->con, $sql)) die();
			$row = mysqli_fetch_array($result);

            $decoded = base64_decode($row[1]);
            $key = substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
            $nonce = substr($decoded, SODIUM_CRYPTO_SECRETBOX_KEYBYTES, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
            $ciphertext = substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
            $plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);

            $tarjeta = new Tarjeta($row[0], $plaintext, $row[2], $row[3]);
			return $tarjeta;
        }

    }
?>