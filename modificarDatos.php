<?php

    session_start();

    require_once($_SERVER["DOCUMENT_ROOT"] .'/util/Conexion.php');
    $conexion = new Conexion();
    $con = $conexion->conectarBD();

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/CargoDAO.php');
    $cargoDAO = new CargoDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Cargo.php');

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/UsuarioDAO.php');
    $usuarioDAO = new UsuarioDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Usuario.php');

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/TarjetaDAO.php');
    $tarjetaDAO = new TarjetaDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Tarjeta.php');


    if($_POST['nombre'] == null)
    {
        $nombreCliente = $_POST['nom'];
    }
    else
    {
        $nombreCliente = $_POST['nombre'];
    }

    if($_POST['cargo'] == null)
    {
        $cargoCliente = $_POST['car'];
    }
    else
    {
        $cargoCliente = $_POST['cargo'];
    }

    if($_POST['correo'] == null)
    {
        $correoCliente = $_POST['cor'];
    }
    else
    {
        $correoCliente = $_POST['correo'];
    }

    $usuario = $usuarioDAO->consultarUsuarioCod($_SESSION['codigo_usuario']);
    $usuario->setNom_usuario($nombreCliente);
    $usuario->setCorreo_usuario($correoCliente);

    $cargo = $cargoDAO->consultarCargo($cargoCliente);
    $usuario->setCargo($cargo);

    $usuarioDAO->modificarUsuario($usuario);

    $conexion->desconectarBD($con);
    unset($conexion);
?>

<meta http-equiv="refresh" content="10; url=https://aswetravel.webcindario.com/misDatos.php" >
