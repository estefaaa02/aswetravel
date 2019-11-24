<?php 
    session_start();
    require_once('daos/UsuarioDAO.php');
  
    require_once('entidades/Usuario.php');

    require_once('util/Conexion.php');

    $conexion = new Conexion();
    $con = $conexion->conectarBD();

    $usu = new UsuarioDAO($con);
       $server = "aswetravel.mysql.database.azure.com";
        $user = "smartbytes@aswetravel";
       $pass = "Travel123";
       $bd = "aswetravel";
     $port = "3306";
     $conexion2 = mysqli_connect($server, $user, $pass,$bd,$port) 
     or die("Ha sucedido un error inexperado en la conexion de la base de datos");


    
    $correo=$_POST['correo'];
    $contrasena=$_POST['contrasena'];

    if($usu->verificarUsuario($contrasena, $correo) == true) {
        $usuario = $usu->consultarUsuarioCorreo($correo);
        $_SESSION['codigo_usuario'] = $usuario->getCod_usuario();
        $_SESSION['correo'] = $usuario->getCorreo_usuario();
        $_SESSION['nombre'] = $usuario->getNom_usuario();
        $_SESSION['tipo_usuario'] = $usuario->getTipo_usuario()->getNom_t_usuario();
        $cargo = $usuario->getCargo()->getNom_Cargo();

        if($_SESSION['tipo_usuario'] == 'Cliente' or $_SESSION['tipo_usuario'] == 'Asesor')
        {

             $result=$conexion2->query("INSERT INTO AUDITORIA VALUES(0,session_user(),".$cargo.",".$_SESSION['codigo_usuario'].",'Ingreso en el sistema',now())");
            header('Location: index.php');
              
            
     

        }
        else if($_SESSION['tipo_usuario'] == 'Administrador')
        {
          $result=$conexion2->query("INSERT INTO AUDITORIA VALUES(0,session_user(),'Administrador,8,'Ingreso en el sistema',now())");
         ?>
            <meta http-equiv="refresh" content="0; url=/administrador/Administrador.php" />
            <?php
           
        }
    } else {
        $_SESSION['errorLogin'] = true;
        header('Location: index.php');
    }
    
     $conexion->desconectarBD($con);
     unset($conexion);
?>
