<?php
    session_start();

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/UsuarioDAO.php');
    $usuarioDAO = new UsuarioDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Usuario.php');

    $usuario = $usuarioDAO->consultarUsuarioCod($_SESSION['codigo_usuario']);

    $mail = new PHPMailer();
    $mail->From     = "aswetravelteam@gmail.com";
    $mail->FromName = "As We Travel";
    $mail->AddAddress($correo);
    $mail->WordWrap = 50;
    $mail->IsHTML(true);    
    $mail->Subject  =  "As We Travel - Cambio de contraseña."; // Asunto del mensaje.
    $mail->Body     =  "Hola ".$usuario->getNom_usuario().", <br> 
    <br> <br>Para cambiar tu contraseña ingresa al siguiente enlace: <a href='cambiarContraseña.php'> ." ;
    $mail->SMTPDebug = 2;
    $mail->IsSMTP();
    $mail->Host ="ssl://smtp.gmail.com:465"; 
    $mail->SMTPAuth = true;
    $mail->Username = 'aswetravelteam@gmail.com';  // Correo Electrónico
    $mail->Password = 'Travel123';
    $mail->Send();
?>

<meta http-equiv="refresh" content="10; url=https://aswetravel.webcindario.com/misDatos.php">