<?php

    session_start();

    require_once($_SERVER["DOCUMENT_ROOT"] .'/util/Conexion.php');
    $conexion = new Conexion();
    $con = $conexion->conectarBD();

    require_once($_SERVER["DOCUMENT_ROOT"].'/daos/UsuarioDAO.php');
    $usuarioDAO = new UsuarioDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"].'/entidades/Usuario.php');

    require_once($_SERVER["DOCUMENT_ROOT"].'/daos/TarjetaDAO.php');
    $tarjetaDAO = new TarjetaDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"].'/entidades/Tarjeta.php');

    $titularTarjeta = $_POST['titular'];
    $numeroTarjeta = $_POST['numero'];
    $cvvtarjeta = $_POST['cvv'];

    $t = new Tarjeta(0,$numeroTarjeta,$cvvtarjeta,$titularTarjeta);

    $tarjetaDAO->crearTarjeta($t);
    $tarjeta = $tarjetaDAO->consultarTarjetaPorNum($titularTarjeta);

    $usuario = $usuarioDAO->consultarUsuarioCod($_SESSION['codigo_usuario']);

    $usuario->setTarjeta($tarjeta);

    $usuarioDAO->modificarUsuario($usuario);

    $conexion->desconectarBD($con);
    unset($conexion);
?>

<meta http-equiv="refresh" content="10; url=https://aswetravel.webcindario.com/misDatos.php">
