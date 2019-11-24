<?php
	/**
	 * Clase que realiza la conexión a la base de datos
	 */
	class Conexion {

		/**
		 * Conecta con la base de datos
		 * @return Object $conexion Devuelve un objeto para conectar con la base de datos en caso de éxito y false en caso de error
		 */
		public function conectarBD(){
			$server = "aswetravel.mysql.database.azure.com";
			$user = "smartbytes@aswetravel";
			$pass = "Travel123";
			$bd = "aswetravel";
			$port = "3306";
			$conexion = mysqli_connect($server, $user, $pass,$bd,$port) 
			        or die("Ha sucedido un error inexperado en la conexion de la base de datos");

			    return $conexion;
		} 

		/**
		 * Cierra la conexión a la base de datos
		 * @param  Object $conexion Conexión a la base de datos
		 * @return boolean $cerrar Devuelve true en caso de éxito y false en caso de error
		 */
		public function desconectarBD($conexion){

			  $cerrar = mysqli_close($conexion) 
			        or die("Ha sucedido un error inexperado en la desconexion de la base de datos");

			   return $cerrar;
		}
	}
?>