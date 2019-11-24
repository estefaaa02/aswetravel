<!doctype html>
<html lang="en">

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
?>
<script type="text/javascript">
function habilitarDatos(valor)
{
    if(valor==true)
    {
        document.getElementById("nombre").disabled=false;
        document.getElementById("cargo").disabled=false;
        document.getElementById("correo").disabled=false;
    }else if(valor==false)
    {
        document.getElementById("nombre").disabled=true;
        document.getElementById("cargo").disabled=true;
        document.getElementById("correo").disabled=true;
    }
}

function habilitar(valor)
{
    if(valor==true)
    {
        document.getElementById("titular").disabled=false;
        document.getElementById("numero").disabled=false;
        document.getElementById("cvv").disabled=false;
    }else if(valor==false)
    {
        document.getElementById("titular").disabled=true;
        document.getElementById("numero").disabled=true;
        document.getElementById("cvv").disabled=true;
    }
}
</script>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/logo3r.png" type="image/png">
    <title>As We Travel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="vendors/popup/magnific-popup.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="https://kit.fontawesome.com/e600d1947b.js" crossorigin="anonymous"></script>
</head>

<body>

<?php
    $usuario = $usuarioDAO->consultarUsuarioCod($_SESSION['codigo_usuario']);
    $tarjeta = $usuario->getTarjeta();
?>

    <!--================Header Menu Area =================-->
    <header class="header_area">
            <div class="main_menu">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <a class="navbar-brand logo_h" href="index.php"><img src="img/logo3r.png" alt=""></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                            <ul class="nav navbar-nav menu_nav ml-auto">
                                <li class="nav-item submenu dropdown active">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false"><?php echo $usuario->getNom_usuario(); ?></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="#">Compras y reservas</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Historial de compras</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Historial de reservas</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item active"><a class="nav-link" href="#">Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
    <!--================Header Menu Area =================-->

    
    <!--================ Área de formulario consulta de vuelos =================-->

    <!--================Home Blog Area =================-->
    <section class="blog_area single-post-area p_120">
            
                <div class="container">
                    <div class="section-top-border">
                        <div class="row">
    
                            <!--  Formulario infromación vuelo y selección de asientos    -->
    
                            <div class="col-lg-8 col-md-8">
                                <div class="comment-form">
                                    <form id="world" name="world" method="post" action="modificarDatos.php">
                                        <h1>Mi información</h1>
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <h4>Cambiar datos</h4>
                                            <div class="confirm-switch" id="switch" >
                                                <input type="checkbox"  name="tarjeta" id="confirm-switch" onchange="habilitarDatos(this.checked)">
                                                <label for="confirm-switch"></label>
                                            </div>
                                        </div>

                                        <div class="switch-wrap d-flex justify-content-between">
                                            <center>
                                                <div class="form-group col-lg-8 col-md-0 name">
                                                    <section class="sample-text-area">
                                                        <p class="col-md-10 mt-sm-20 "> <b>Nombre</b> </p>
                                                    </section>
                                                </div>
                                            </center>
                                            <div class="form-group col-lg-10 col-md-2 email">
                                                <input type="hidden" name="nom" value=<?php echo $usuario->getNom_usuario(); ?> >
                                                <input type="name" disabled="false" id="nombre" name="nombre" class="form-control" 
                                                value=<?php echo $usuario->getNom_usuario(); ?>
                                                placeholder=<?php echo $usuario->getNom_usuario(); ?>
                                                onfocus="this.placeholder = 'Campo requerido'"
                                                onblur="this.placeholder = 'Ingrese su nombre'" >
                                            </div>
                                        </div>
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <center>
                                                <div class="form-group col-lg-8 col-md-0 name">
                                                    <section class="sample-text-area">
                                                        <p class="col-md-10 mt-sm-20 "> <b>Cargo</b> </p>
                                                    </section>
                                                </div>
                                            </center>
                                            <div class="form-group col-lg-10 col-md-0 name">
                                            <input type="hidden" name="car" value=<?php echo $usuario->getCargo()->getCod_cargo(); ?> >
                                            <select class="custom-select form-control" name="cargo" id="cargo" disabled="false">
                                                <?php
                                                    $listaCargos = $cargoDAO->obtenerCargos();
                                                    foreach($listaCargos as $listaCargo)
                                                    {
                                                ?>
                                                    <option value=<?php echo $listaCargo->getCod_cargo(); ?>> <?php echo $listaCargo->getNom_cargo(); ?> </option>
                                                <?php
                                                    } 
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <center>
                                                <div class="form-group col-lg-8 col-md-0 name">
                                                    <section class="sample-text-area">
                                                        <p class="col-md-10 mt-sm-20 "> <b>Correo</b> </p>
                                                    </section>
                                                </div>
                                            </center>
                                            <div class="form-group col-lg-10 col-md-0 email">
                                            <input type="hidden" name="cor" value=<?php echo $usuario->getCorreo_usuario(); ?> >
                                                <input type="email" disabled="false" name="correo" id="correo" class="form-control"
                                                value=<?php echo $usuario->getCorreo_usuario(); ?>
                                                placeholder=<?php echo $usuario->getCorreo_usuario(); ?>
                                                onfocus="this.placeholder = 'Campo requerido'"
                                                onblur="this.placeholder = 'Ingrese su correo'" >
                                            </div>
                                        </div>
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <center>
                                                <div class="form-group col-lg-10 col-md-0 name">
                                                    <section class="sample-text-area">
                                                        <p class="col-md-10 mt-sm-20 "> <b>Contraseña</b> </p>
                                                    </section>
                                                </div>
                                            </center>
                                            <div class="button-group-area mt-10">
                                                    <a href="correoCambiarContraseña.php" name="contraseña" class="genric-btn warning-border circle">Cambiar contraseña</a>
                                                </div>
                                        </div>

                                    <div class="br"></div>
                                    
                                    <div class="switch-wrap d-flex justify-content-between">
                                        <div class="button-group-area mt-10">
                                            <a class="genric-btn warning-border circle" href="index.php" >Inicio</a>
                                        </div>
                                        <div class="button-group-area mt-10">
                                            <button type="submit" id='modificar' class="genric-btn danger circle" aria-label> Modificar </button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 ">
                            <div class="blog_right_sidebar">
                                

                                <?php

                                    if($tarjeta != null)
                                    {
                                ?>
                                <form method="post" action="actualizarMedioPago.php" >
                                    <div class="switch-wrap d-flex justify-content-between">
                                        <p>Cambiar datos de tarjeta</p>
                                        <div class="confirm-switch" id="switch" >
                                            <input type="checkbox"  name="tarjeta" id="confirm-switch2" onchange="habilitar(this.checked)" >
                                            <label for="confirm-switch2"></label>
                                        </div>
                                    </div>

                                    <div class="br"></div>

                                    <aside name="todo" class="single_sidebar_widget author_widget">
                                        <h4 class="mb-20 title_color">Titular</h4>
                                        <input type="name" disabled="false" name="titular" class="form-control" id="titular" name="titular" value="<?php echo $tarjeta->getNom_titular_tarjeta(); ?>" 
                                            placeholder="<?php echo $tarjeta->getNom_titular_tarjeta(); ?>"
                                            onfocus="this.placeholder = 'Campo requerido'"
                                            onblur="this.placeholder = 'Ingrese el nombre del titular'" required="true">
                                        <h4 class="mb-20 title_color">Número</h4>
                                        <input type="number" disabled="false" name="numero" class="form-control" name="numero" id="numero" value="<?php echo $tarjeta->getNumero_tarjeta(); ?>"
                                        placeholder="<?php echo $tarjeta->getNumero_tarjeta(); ?>"
                                        onblur="
                                                // save input string and strip out non-numbers
                                                cc_number_saved = this.value;
                                                this.value = this.value.replace(/[^\d]/g, '');
                                                if(!validarTarjeta(this.value)) {
                                                    alert('Tarjeta inválida');
                                                    this.value = '';
                                                }
                                                " onfocus="
                                                // restore saved string
                                                if(this.value != cc_number_saved) this.value = cc_number_saved;
                                                " required="true">
                                        <h4 class="mb-20 title_color">Cvv</h4>
                                        <input type="number" disabled="false" name="cvv" class="form-control" id="cvv" name="cvv" value="<?php echo $tarjeta->getCvv_tarjeta(); ?>" 
                                            placeholder="<?php echo $tarjeta->getCvv_tarjeta(); ?>"
                                            onfocus="this.placeholder = 'Campo requerido'"
                                            onblur="this.placeholder = 'Ingrese el CVV de la tarjeta'">
                                    </aside>

                                    <div class="switch-wrap d-flex justify-content-between">
                                    <div class="button-group-area mt-10">
                                            <button type="submit" id='modificar' class="genric-btn danger circle" aria-label> Actualizar </button>
                                        </div>
                                    </div>

                                </form>
                                <?php
                                    }
                                    else if($tarjeta == null)
                                    {
                                ?>
                                <form method="post" action="ingresarMedioPago.php" >
                                    <div class="switch-wrap d-flex justify-content-between">
                                        <p>Ingresar datos de tarjeta</p>
                                    </div>

                                    <div class="br"></div>

                                    <aside name="todo" class="single_sidebar_widget author_widget">
                                        <h4 class="mb-20 title_color">Titular</h4>
                                        <input type="name" name="titular" class="form-control" id="titular" name="titular"
                                            placeholder="Ingrese el nombre del titular"
                                            onfocus="this.placeholder = 'Campo requerido'"
                                            onblur="this.placeholder = 'Ingrese el nombre del titular'" required="true">
                                        <h4 class="mb-20 title_color">Número</h4>
                                        <input type="number" name="numero" class="form-control" name="numero" id="numero"
                                        placeholder="Ingrese el número de cuenta"
                                        onblur="
                                                // save input string and strip out non-numbers
                                                cc_number_saved = this.value;
                                                this.value = this.value.replace(/[^\d]/g, '');
                                                if(!validarTarjeta(this.value)) {
                                                    alert('Tarjeta inválida');
                                                    this.value = '';
                                                }
                                                " onfocus="
                                                // restore saved string
                                                if(this.value != cc_number_saved) this.value = cc_number_saved;
                                                " required="true">
                                        <h4 class="mb-20 title_color">Cvv</h4>
                                        <input type="number" name="cvv" class="form-control" id="cvv" name="cvv"
                                            placeholder="Ingrese el CVV de la tarjeta"
                                            onfocus="this.placeholder = 'Campo requerido'"
                                            onblur="this.placeholder = 'Ingrese el CVV de la tarjeta'">
                                    </aside>
                                    <div class="switch-wrap d-flex justify-content-between">
                                    <div class="button-group-area mt-10">
                                            <button type="submit" id='modificar' class="genric-btn danger circle" aria-label> Registrar </button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                    }
                                ?>
                            </div>

                        </div>
                                        </div>
            
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    <!--================End Home Blog Area =================-->







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stellar.js"></script>
    <script src="vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/isotope/isotope.pkgd.min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="vendors/popup/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendors/counter-up/jquery.counterup.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/theme.js"></script>

    <script>
        function validarTarjeta(input) {
    // Accept only digits, dashes or spaces
        var sum = 0;
        var numdigits = input.length;
        var parity = numdigits % 2;
        for(var i=0; i < numdigits; i++) {
            var digit = parseInt(input.charAt(i))
            if(i % 2 == parity) digit *= 2;
            if(digit > 9) digit -= 9;
            sum += digit;
    }
    return (sum % 10) == 0;
    }
    </script>

</body>

</html>