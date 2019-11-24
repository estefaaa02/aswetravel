<?php
session_start();
    require_once("daos/CargoDAO.php");
    require_once("entidades/Cargo.php");
    require_once("daos/UsuarioDAO.php");
    require_once("entidades/Usuario.php");
    require_once("daos/PreguntaDAO.php");
    require_once("entidades/Pregunta.php");
    require_once("daos/TarjetaDAO.php");
    require_once("entidades/Tarjeta.php");
    require_once("entidades/TipoUsuario.php");
    require_once('util/Conexion.php');
    require_once("mailer/class.phpmailer.php");

    $conexion = new Conexion();
    $con = $conexion->conectarBD();

        $nombre = $_POST['nombre'];
        $codCargo = $_POST['cargo'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $codPregunta = $_POST['pregunta'];
        $respuesta = $_POST['respuesta'];
        $tipoUsuario = new TipoUsuario(2, 'Cliente');

        $cargoDAO = new CargoDAO($con);
        $cargo = $cargoDAO->consultarCargo($codCargo);

        $preguntaDAO = new PreguntaDAO($con);
        $pregunta = $preguntaDAO->consultarPregunta($codPregunta);

        if(isset($_POST['tarjeta'])) {
            $numeroTarjeta = $_POST['numero'];
            $titular = $_POST['titular'];
            $cvv = $_POST['cvv'];

            $nuevaTarjeta = new Tarjeta(0, $numeroTarjeta, $cvv, $titular);

            $tarjetaDAO = new TarjetaDAO($con);
            $tarjetaDAO->crearTarjeta($nuevaTarjeta);

            $tarjeta = $tarjetaDAO->consultarTarjetaPorNum($titular);
        } else {
            $tarjeta = null;
        }
        $usuarioDAO = new UsuarioDAO($con);
        $usuario = $usuarioDAO->consultarUsuarioCorreo($correo);

        if($usuario != null) {
            $_SESSION['correoUsado'] = true;
            header('Location: registro.php');
        } else {
            $nuevoUsuario = new Usuario(0, $nombre, $correo, $contrasena, $tarjeta, $tipoUsuario, $pregunta, $respuesta, 0, $cargo, 'A');
            $usuarioDAO->crearUsuario($nuevoUsuario);
            $mail = new PHPMailer();
            $mail->From     = "aswetravelteam@gmail.com";
            $mail->FromName = "As We Travel";
            $mail->AddAddress($correo);
            $mail->WordWrap = 50;
            $mail->IsHTML(true);    
            $mail->Subject  =  "Bienvenid@ a As We Travel"; // Asunto del mensaje.
            $mail->Body     =  "Hola ".$nombre.", <br>Bienvenid@ a As We Travel, donde podrás comprar y reservar vuelos a tus destinos favoritos. Haz click <a href='https://aswetravel.webcindario.com/index.php'>aquí</a> para ".
            "que inicies sesión y comiences tu experiencia con nosotros.<br>¡Gracias por elegirnos!";
            $mail->SMTPDebug = 2;
            $mail->IsSMTP();
            $mail->Host ="ssl://smtp.gmail.com:465"; 
            $mail->SMTPAuth = true;
            $mail->Username = 'aswetravelteam@gmail.com';  // Correo Electrónico
            $mail->Password = 'Travel123';
            $mail->Send();
            header('Location: index.php');
        }

        $conexion->desconectarBD($con);
        unset($conexion);
?>