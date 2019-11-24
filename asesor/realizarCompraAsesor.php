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

    $asientos = array();

    if(isset($_POST['envio']))
    {
        if(!empty($_POST['asiento']))
        {
            foreach($_POST['asiento'] as $asiento)
            {
                
                $a = $asientoDAO->consultarAsiento($asiento);
                echo $a;
                $asientos[] = $a;
            }
        }
    }


    $cargoCliente = isset($_POST['cargo']);
    $correoCliente = $_POST['correo'];
    $precioVuelo = $_POST['precio'];
    $aerolineaVuelo = $_POST['aerolinea'];

    $fechaLlegada = $_POST['fechaLlegada'];
    $fechaSalida = $_POST['fechaSalida'];
    $datetime1 = date_create($fechaLlegada);
    $datetime2 = date_create($fechaSalida);
    $interval = date_diff($datetime1, $datetime2);
    $duraciónViaje = $interval->format('%a días %H:%I horas');

    $fechaCompra = new DateTime('now');

    $ciudadSalida = $_POST['ciudadSalida'];
    $ciudadLlegada = $_POST['ciudadLlegada'];

    $codVueloIda = $_POST['vueloIda'];
    $codVueloVuelta = $_POST['vueloVuelta'];
    $vueloIda = $vueloDAO->consultarVuelo($codVueloIda);
    $vueloVuelta = $vueloDAO->consultarVuelo($codVueloVuelta);
    $vuelos = array();
    $vuelos[0] = $vueloIda;
    $vuelos[1] = $vueloVuelta;
    
    $codTarjeta = $_POST['tar'];
    $titularTarjeta = $_POST['titular'];
    $numeroTarjeta = $_POST['numero'];
    $cvvtarjeta = $_POST['cvv'];

    $tarjeta = $tarjetaDAO->consultarTarjeta($codTarjeta);
    $tarjeta->setNom_titular_tarjeta($titularTarjeta);
    $tarjeta->setNumero_tarjeta($numeroTarjeta);
    $tarjeta->setCvv_tarjeta($cvvtarjeta);

    
    $usuario = $usuarioDAO->consultarUsuarioCod($_SESSION['codigo_usuario']);

    $usuario->setTarjeta($tarjeta);

    $nuevoViaje = new Viaje(0,"C",$precioVuelo,$duraciónViaje,$usuario,null,$fechaCompra,$vuelos,$asientos);

    $conexion->desconectarBD($con);
    unset($conexion);
?>

<meta http-equiv="refresh" content="10; url=https://aswetravel.webcindario.com/index.php">
