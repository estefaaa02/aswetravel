<?php

    session_start();
    require_once($_SERVER["DOCUMENT_ROOT"] .'/util/Conexion.php');
    $conexion = new Conexion();
    $con = $conexion->conectarBD();

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/CargoDAO.php');
    $cargoDAO = new CargoDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/VueloDAO.php');
    $vueloDAO = new VueloDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Vuelo.php');

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/ViajeDAO.php');
    $viajeDAO = new ViajeDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Viaje.php');

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/CategoriaAsientoDAO.php');
    $categoriaDAO = new CategoriaAsientoDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/CategoriaAsiento.php');

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/AsientoDAO.php');
    $asientoDAO = new AsientoDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Asiento.php');

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/AerolineaDAO.php');
    $aerolineaDAO = new AerolineaDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Aerolinea.php');

    require_once($_SERVER["DOCUMENT_ROOT"].'/daos/CiudadDAO.php');
    $ciudadDAO = new CiudadDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"].'/entidades/Ciudad.php');

    require_once($_SERVER["DOCUMENT_ROOT"].'/daos/UsuarioDAO.php');
    $usuarioDAO = new UsuarioDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"].'/entidades/Usuario.php');

    require_once($_SERVER["DOCUMENT_ROOT"].'/daos/TarjetaDAO.php');
    $tarjetaDAO = new TarjetaDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"].'/entidades/Tarjeta.php');

    require_once($_SERVER["DOCUMENT_ROOT"].'/mailer/class.phpmailer.php');

    $asientos = array();

    
        if(!empty($_POST['asiento']))
        {
            foreach($_POST['asiento'] as $asiento)
            {
                
                $a = $asientoDAO->consultarAsiento($asiento);
                $asientos[] = $a;
            }
        }

    $fechaCompra = new DateTime('now');
    $fechaReserva = new DateTime("0000-00-00 00:00:00");

    $codVueloIda = $_POST['vueloIda'];
    $codVueloVuelta = $_POST['vueloVuelta'];
    $vueloIda = $vueloDAO->consultarVuelo($codVueloIda);
    $vueloVuelta = $vueloDAO->consultarVuelo($codVueloVuelta);
    $vuelos = array();
    $vuelos[0] = $vueloIda;
    $vuelos[1] = $vueloVuelta;

    $fechaSalidaIda = $vueloIda->getFecha_salida();
    $fechaLlegadaVuelta = $vueloVuelta->getFecha_llegada();
    $datetime1 = date_create($fechaLlegadaVuelta);
    $datetime2 = date_create($fechaSalidaIda);
    $interval = date_diff($datetime1, $datetime2);
    $duraciónViaje = $interval->format('%a días %H:%I horas');
    
    $codTarjeta = $_POST['tar'];
    $titularTarjeta = $_POST['titular'];
    $numeroTarjeta = $_POST['numero'];
    $cvvtarjeta = $_POST['cvv'];

    if($codTarjeta != null)
    {
        $tarjeta = $tarjetaDAO->consultarTarjeta($codTarjeta);
        $tarjeta->setNom_titular_tarjeta($titularTarjeta);
        $tarjeta->setNumero_tarjeta($numeroTarjeta);
        $tarjeta->setCvv_tarjeta($cvvtarjeta);
    }else
    {
        $tarjeta = new Tarjeta(0,$numeroTarjeta,$cvvtarjeta,$titularTarjeta);
    }
    
    $usuario = $usuarioDAO->consultarUsuarioCod($_SESSION['codigo_usuario']);

    $usuario->setTarjeta($tarjeta);

    $usuarioDAO->modificarUsuario($usuario);

    $nuevoViaje = new Viaje(0,"C",$precioVuelo,$duraciónViaje,$usuario,$fechaReserva,$fechaCompra,$vuelos,$asientos);

    $viajeDAO->crearViaje($nuevoViaje);

    $precioIda = $vueloIda->getPrecio_vuelo(); 
    $precioVuelta = $vueloVuelta->getPrecio_vuelo();
    $precio = $precioIda + $precioVuelo;

            $mail = new PHPMailer();
            $mail->From     = "aswetravelteam@gmail.com";
            $mail->FromName = "As We Travel";
            $mail->AddAddress($usuario->getCorreo_usuario());
            $mail->WordWrap = 50;
            $mail->IsHTML(true);    
            $mail->Subject  =  "As We Travel - Compra de tiquetes."; // Asunto del mensaje.
            $mail->Body     =  "Hola ".$usuario->getNom_usuario().", <br>Tu compra ha sido exitosa. <br> Aqui están los datos de tu tiquete. No olvides que debes llegar dos horas antes al aeropuerto. 
            <br> <br>Vuelo de ida <br> <br> CIUDAD DE SALIDA: ".$vueloIda->getCiudad_origen()->getNom_ciudad()."<br> FECHA Y HORA DE SALIDA: ".$vueloIda->getFecha_salida().". <br> CIUDAD DE DESTINO: ".$vueloIda->getCiudad_destino()->getNom_ciudad().". <br> FECHA Y HORA DE LLEGADA: ".$vueloIda->getFecha_llegada().". 
            <br> <br>Vuelo de vuelta <br> <br> CIUDAD DE SALIDA: ".$vueloVuelta->getCiudad_origen()->getNom_ciudad().". <br> FECHA Y HORA DE SALIDA: ".$vueloVuelta->getFecha_salida().". <br> CIUDAD DE DESTINO: ".$vueloVuelta->getCiudad_destino()->getNom_ciudad().". <br> FECHA Y HORA DE LLEGADA: "-$vueloVuelta->getFecha_llegada().".
            <br> <br>DURACIÓN TOTAL DE VIAJE: ".$duraciónViaje." . <br>PRECIO DE TIQUETE: ".$precio.".";
            $mail->SMTPDebug = 2;
            $mail->IsSMTP();
            $mail->Host ="ssl://smtp.gmail.com:465"; 
            $mail->SMTPAuth = true;
            $mail->Username = 'aswetravelteam@gmail.com';  // Correo Electrónico
            $mail->Password = 'Travel123';
            $mail->Send();

    $conexion->desconectarBD($con);
    unset($conexion);
?>

<meta http-equiv="refresh" content="10; url=https://aswetravel.webcindario.com/index.php">
