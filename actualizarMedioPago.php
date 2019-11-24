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

    $usuario = $usuarioDAO->consultarUsuarioCod($_SESSION['codigo_usuario']);
    
    $titularTarjeta = $_POST['titular'];
    $numeroTarjeta = $_POST['numero'];
    $cvvtarjeta = $_POST['cvv'];

    $tarjeta = $usuario->getTarjeta();
    $tarjeta->setNom_titular_tarjeta($titularTarjeta);
    $tarjeta->setNumero_tarjeta($numeroTarjeta);
    $tarjeta->setCvv_tarjeta($cvvtarjeta);

    $usuario->setTarjeta($tarjeta);

    $usuarioDAO->modificarUsuario($usuario);

    $conexion->desconectarBD($con);
    unset($conexion);
?>

<meta http-equiv="refresh" content="10; url=https://aswetravel.webcindario.com/misDatos.php">
