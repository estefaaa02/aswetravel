<?php
session_start();
require_once("daos/CiudadDAO.php");
require_once("entidades/Ciudad.php");
require_once("daos/CategoriaAsientoDAO.php");
require_once("entidades/CategoriaAsiento.php");
require_once("daos/VueloDAO.php");
require_once("entidades/Vuelo.php");
require_once("daos/AerolineaDAO.php");
require_once("entidades/Aerolinea.php");
require_once("util/Conexion.php");

$conexion = new Conexion();
$con = $conexion->conectarBD();
$ciudadDAO = new CiudadDAO($con);
$categoriaAsientoDAO = new CategoriaAsientoDAO($con);
$vueloDAO = new VueloDAO($con);
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

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
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="vendors/popup/magnific-popup.css">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
       <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stellar.js"></script>
    <script src="vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/isotope/isotope.pkgd.min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="vendors/popup/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendors/counter-up/jquery.counterup.js"></script>
    <script src="js/mail-script.js"></script>

    <script src="https://kit.fontawesome.com/e600d1947b.js" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified CSS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
    
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>



</head>

<body>

    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.html"><img src="img/logo3r.png" alt=""></a>
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
                            <div class="row align-items-end">
                                
                                <?php
                                    if(isset($_SESSION['codigo_usuario'])) {
                                        if($_SESSION['tipo_usuario'] == "Cliente") {
                                            ?>
                                                <ul class="nav navbar-nav menu_nav ml-auto">
                                                    <li class="nav-item submenu dropdown active">
                                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                                            aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['nombre']; ?></a>
                                                        <ul class="dropdown-menu">
                                                            <li class="nav-item"><a class="nav-link" href="misDatos.php">Mi información</a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#">Compras y reservas</a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#">Historial de compras</a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#">Historial de reservas</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-item active"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>
                                                </ul>
                                            <?php
                                        } else if($_SESSION['tipo_usuario'] == "Administrador") {?>
                                            <ul class="nav navbar-nav menu_nav ml-auto">
                                                    <li class="nav-item submenu dropdown active">
                                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                                            aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['nombre']; ?></a>
                                                        <ul class="dropdown-menu">
                                                            <li class="nav-item"><a class="nav-link" href="administrador/Administrador.php">Gestión Administrador</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-item active"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>
                                                </ul>
                                        <?php } else if ($_SESSION['tipo_usuario'] == "Asesor") {?>
                                                <ul class="nav navbar-nav menu_nav ml-auto">
                                                    <li class="nav-item submenu dropdown active">
                                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                                            aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['nombre']; ?></a>
                                                    </li>
                                                    <li class="nav-item active"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>
                                                </ul>
                                       <?php }
                                    } else {
                                        ?>
                                            <li class="nav-item active"><a data-toggle="modal" data-target="#modalForm"
                                            class="nav-link" href="#">Iniciar sesión</a></li>
                                            <li class="nav-item active"><a class="nav-link" href="registro.php">Registrarse</a></li>
                                        <?php
                                    }
                                ?>
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>
 
        </div>
    </header>
    <!--================Header Menu Area =================-->

    <!--================ Área de formulario consulta de vuelos =================-->
    <section class="home_banner_area">
        <div class="banner_inner">
            <div class="container banner_content">
                <form method="post">
                    <div style="height: 20px;"></div>
                    <div class="form-row">
                        <div class=" col-auto">
                            <label>Ciudad Origen</label>
                            <select  name="ciudadOrigen" class="selectpicker" data-live-search="true" required>
                            <?php
                                $ciudades = $ciudadDAO->obtenerCiudades();

                                foreach($ciudades as $ciudad){
                            ?>
                            <option value=<?php echo $ciudad->getCod_ciudad(); ?>><?php echo $ciudad->getNom_ciudad(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-auto">
                            <div style="height: 20px;"></div>
                            <label>Ciudad Destino</label>
                            <select  name="ciudadDestino" class="selectpicker" data-live-search="true"  required>
                                <?php
                                $ciudades = $ciudadDAO->obtenerCiudades();

                                foreach($ciudades as $ciudad){
                            ?>
                            <option value="<?php echo $ciudad->getCod_ciudad(); ?>"><?php echo $ciudad->getNom_ciudad(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <script>
                        $('select').selectpicker(); 
                    </script>
                    <div style="height: 15px;"></div>
                    <div class="form-row">
                        <div class="col-auto">
                            <label>Fecha Salida</label>
                            <div class='input-group date' id='fechaSalida'>
                                <input type='text' name="fechaSalida" class="form-control" />
                                <span class="input-group-addon" style="font-size: 1.2rem">
                                    <i class="fas fa-calendar fa-2x"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <label>Fecha Llegada</label>
                            <div class='input-group date' id='fechaLlegada'>
                                <input type='text' class="form-control" name="fechaLlegada"/>
                                <span class="input-group-addon" style="font-size: 1.2rem">
                                    <i class="fas fa-calendar fa-2x"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                        <script type="text/javascript">
                            $('#fechaSalida').datetimepicker({
                                // Formats
                                // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
                                format: 'DD-MM-YYYY',

                                // Your Icons
                                // as Bootstrap 4 is not using Glyphicons anymore
                                icons: {
                                    time: 'fa fa-clock-o',
                                    date: 'fa fa-calendar',
                                    up: 'fa fa-chevron-up',
                                    down: 'fa fa-chevron-down',
                                    previous: 'fa fa-chevron-left',
                                    next: 'fa fa-chevron-right',
                                    today: 'fa fa-check',
                                    clear: 'fa fa-trash',
                                    close: 'fa fa-times'
                                }
                            });
                            $('#fechaLlegada').datetimepicker({
                                // Formats
                                // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
                                format: 'DD-MM-YYYY',
                                useCurrent: false,

                                // Your Icons
                                // as Bootstrap 4 is not using Glyphicons anymore
                                icons: {
                                    time: 'fa fa-clock-o',
                                    date: 'fa fa-calendar',
                                    up: 'fa fa-chevron-up',
                                    down: 'fa fa-chevron-down',
                                    previous: 'fa fa-chevron-left',
                                    next: 'fa fa-chevron-right',
                                    today: 'fa fa-check',
                                    clear: 'fa fa-trash',
                                    close: 'fa fa-times'
                                }
                            });

                            $("#fechaSalida").on("dp.change", function (e) {
                                $('#fechaLlegada').data("DateTimePicker").minDate(e.date);
                            });
                            $("#fechaLlegada").on("dp.change", function (e) {
                                $('#fechaSalida').data("DateTimePicker").maxDate(e.date);
                            });
                    </script>
                    <div style="height: 15px;"></div>
                    <div class="form-row">
                        <label>Pasajeros</label>
                    </div>
                    <div class="form-row">
                        <div class="col-auto">
                            <select class="custom-select form-control" name="adultos" required>
                                    <option value="0" selected>Adultos (+12 años)</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                        </div>
                        <div class="col-auto">
                            <select class="custom-select form-control" name="ninos">
                                    <option value="0" selected>Niños (menos de 12 años)</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                        </div>
                    </div>
                    <div style="height: 15px;"></div>
                    <div class="form-row">
                        <div class="col-auto">
                            <div style="height: 32px;"></div>
                            <select class="custom-select form-control" name="infantes">
                                    <option value="0" selected>Infantes (menos de 2 años)</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                        </div>
                        <div class="col-auto">
                            <div class="form-row">
                                <label>Categoría Asiento</label>
                            </div>
                            <div class="form-row">
                                <select class="custom-select form-control" name="categoria">
                                    <?php
                                        
                                        $categorias = $categoriaAsientoDAO->obtenerCategoriasAsiento();

                                        foreach($categorias as $categoria){
                                    ?>
                                    <option value=<?php echo $categoria->getCod_categoria_asiento(); ?>><?php echo $categoria->getNom_categoria_asiento(); ?></option>
                                        <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div style="height: 20px;"></div>
                    <div class="form-row justify-content-center">
                        <input name="consultaVuelos" type="submit" class="main_btn" value="Buscar Vuelos">
                    </div>
                </form>
            </div>
        </div>
        
    </section>
    <!--================ Área de formulario consulta de vuelos =================-->

    <!--================Home Blog Area =================-->
        <section class="home_blog_inner"> 
    <?php
        if(isset($_POST['consultaVuelos']) == true) {
            $ciudadOrigen = $_POST['ciudadOrigen'];
            $ciudadDestino = $_POST['ciudadDestino'];
            $fechaSalida = $_POST['fechaSalida'];
            $fechaLlegada = $_POST['fechaLlegada'];
            $cantAdultos = $_POST['adultos'];
            $cantNinos = $_POST['ninos'];
            $cantInfantes = $_POST['infantes'];
            
            $categoria = $_POST['categoria'];

            $pasajeros = $cantAdultos + $cantInfantes + $cantNinos;
            $precio_categoria = $categoriaAsientoDAO->consultarCategoriaAsiento($categoria)->getPrecio_extra_categoria();

            $f = strtotime($fechaSalida); 
            $fecha1 = date('Y-m-d', $f);

             $f = strtotime($fechaLlegada); 
            $fecha2 = date('Y-m-d', $f);

            
            $filtro = "cod_ciudad_origen = $ciudadOrigen AND cod_ciudad_destino = $ciudadDestino AND fecha_salida 
            BETWEEN '$fecha1 00:00:00' AND '$fecha1 23:59:59'";
            $vuelosSalida = $vueloDAO->obtenerVuelosFiltrados($filtro);

            $filtro = "cod_ciudad_origen = $ciudadDestino AND cod_ciudad_destino = $ciudadOrigen AND fecha_salida 
            BETWEEN '$fecha2 00:00:00' AND '$fecha2 23:59:59'";
            $vuelosLlegada = $vueloDAO->obtenerVuelosFiltrados($filtro);

            foreach($vuelosSalida as $vueloSalida) {
                foreach($vuelosLlegada as $vueloLlegada){
                    $precioVuelo = ($vueloLlegada->getPrecio_vuelo() + $vueloSalida->getPrecio_vuelo() + $precio_categoria) * $pasajeros;
    ?>
           
        <div class="container banner_content">
            <div class="row justify-content-center">
                <div class="col-3">
                    <h5><?php 
                       echo $vueloSalida->getAerolinea()->getNom_aerolinea();
                    ?></h5>
                </div>
                <div class="col-2">
                    <div class="row">
                        <h4><?php
                           echo $vueloSalida->getFecha_salida();
                        ?></h4>
                    </div>
                    <div class="row">
                        <p><?php
                            echo $vueloSalida->getCiudad_origen()->getNom_ciudad();
                        ?></p>
                    </div>
                </div>
                <div class="col-2">
                    <span class="fas fa-plane-departure fa-lg"></span>
                </div>
                <div class="col-2">
                    <div class="row">
                        <h4><?php 
                           echo $vueloSalida->getFecha_llegada();
                        ?></h4>
                    </div>
                    <div class="row">
                        <p><?php
                           echo $vueloSalida->getCiudad_destino()->getNom_ciudad();
                         ?></p>
                    </div>
                </div>
                <div class="col-2">
                    <div style="height: 20px;"></div>
                  <h3>Precio: <?php echo $precioVuelo; ?></h3>

                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-3">
                    <h5><?php 
                       echo $vueloLlegada->getAerolinea()->getNom_aerolinea();
                    ?></h5>
                </div>
                <div class="col-2">
                    <div class="row">
                        <h4><?php
                       echo $vueloLlegada->getFecha_salida();
                        ?></h4>
                    </div>
                    <div class="row">
                        <p><?php
                       echo $vueloLlegada->getCiudad_origen()->getNom_ciudad();
                        ?></p>
                    </div>
                </div>
                <div class="col-2">
                    <i class="fas fa-plane-arrival fa-lg"></i>
                </div>
                <div class="col-2">
                    <div class="row" >
                        <h4><?php
                       echo $vueloLlegada->getFecha_llegada();
                        ?></h4>
                    </div>
                    <div class="row">
                        <p><?php
                       echo $vueloLlegada->getCiudad_destino()->getNom_ciudad();
                        ?></p>
                    </div>
                </div>
                <div class="col-2" >
                    <div class="row">
                        <?php
                            if(isset($_SESSION['codigo_usuario'])) {
                                if($_SESSION['tipo_usuario'] == "Cliente"){
                                ?>
                                <form method="post" action="cliente/reservaCliente.php">
                                    <input type="hidden" name="vueloIda" value="<?php echo $vueloSalida->getCod_vuelo();?>">
                                    <input type="hidden" name="vueloVuelta" value="<?php echo $vueloLlegada->getCod_vuelo();?>">
                                    <input type="hidden" name="categoria" value="<?php echo $categoria;?>">
                                    <input type="hidden" name="numero_asientos" value="<?php echo $pasajeros;?>">
                                    <input type="hidden" name="precioVuelo" value="<?php echo $precioVuelo;?>">
                                    <input type='submit' class='consulta_btn' name="reservar" value="Reservar"></input>
                                </form>
                                <?php
                                }
                            }
                        ?>
                    </div>
                    <div style="height: 30px;"></div>
                    <div class="row">
                        <?php
                            if(isset($_SESSION['codigo_usuario'])) {
                                if($_SESSION['tipo_usuario'] == "Cliente"){
                                ?>
                                <form method="post" action="cliente/compraCliente.php">
                                    <input type="hidden" name="vueloIda" value="<?php echo $vueloSalida->getCod_vuelo();?>">
                                    <input type="hidden" name="vueloVuelta" value="<?php echo $vueloLlegada->getCod_vuelo();?>">
                                    <input type="hidden" name="categoria" value="<?php echo $categoria;?>">
                                    <input type="hidden" name="numero_asientos" value="<?php echo $pasajeros;?>">
                                    <input type="hidden" name="precioVuelo" value="<?php echo $precioVuelo;?>">
                                    <input type='submit' class='consulta_btn' name="comprar" value="Comprar"></input>
                                </form>
                                <?php
                                } else if($_SESSION['tipo_usuario'] == "Asesor") {?>
                                    <form method="post" action="asesor/compraAsesor.php">
                                    <input type="hidden" name="vueloIda" value="<?php echo $vueloSalida->getCod_vuelo();?>">
                                    <input type="hidden" name="vueloVuelta" value="<?php echo $vueloLlegada->getCod_vuelo();?>">
                                    <input type="hidden" name="categoria" value="<?php echo $categoria;?>">
                                    <input type="hidden" name="numero_asientos" value="<?php echo $pasajeros;?>">
                                    <input type="hidden" name="precioVuelo" value="<?php echo $precioVuelo;?>">
                                    <input type='submit' class='consulta_btn' name="comprar">Comprar</input>
                                </form>
                                <?php }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
                <?php }}
                } else {
                    $cantVuelosIda = $vueloDAO->obtenerCantVuelos();
                    for($i = 0; $i < 10; $i++) {
                        $vueloSalida = $vueloDAO->consultarVuelo($i + 1);
                        $filtro = $filtro = "cod_ciudad_origen = ".$vueloSalida->getCiudad_destino()->getCod_ciudad()." AND cod_ciudad_destino = ".$vueloSalida->getCiudad_origen()->getCod_ciudad()." AND fecha_llegada 
                        > '".$vueloSalida->getFecha_salida()."' LIMIT 2";
                        $vuelosVuelta = $vueloDAO->obtenerVuelosFiltrados($filtro);
                        foreach($vuelosVuelta as $vueloLlegada) {
                            $categorias = $categoriaAsientoDAO->obtenerCategoriasAsiento();
                            foreach($categorias as $categoria) {
                                $precioVuelo = ($vueloLlegada->getPrecio_vuelo() + $vueloSalida->getPrecio_vuelo() + $categoria->getPrecio_extra_categoria());
                            ?>  
        <div style="height: 10px"></div>  
        <div class="container banner_content" style="background: #e3e3f5; border-radius: 7px;">
        <div style="height: 5px"></div>
            <div class="row justify-content-center">
                <div class="col-3">
                    <h5><?php 
                       echo $vueloSalida->getAerolinea()->getNom_aerolinea();
                    ?></h5>
                </div>
                <div class="col-2">
                    <div class="row">
                        <h4><?php
                           echo $vueloSalida->getFecha_salida();
                        ?></h4>
                    </div>
                    <div class="row">
                        <p><?php
                            echo $vueloSalida->getCiudad_origen()->getNom_ciudad();
                        ?></p>
                    </div>
                </div>
                <div class="col-2">
                    <span class="fas fa-plane-departure fa-lg"></span>
                </div>
                <div class="col-2">
                    <div class="row">
                        <h4><?php 
                           echo $vueloSalida->getFecha_llegada();
                        ?></h4>
                    </div>
                    <div class="row">
                        <p><?php
                           echo $vueloSalida->getCiudad_destino()->getNom_ciudad();
                         ?></p>
                    </div>
                </div>
                <div class="col-2">
                    <div style="height: 20px;"></div>
                    <div class="row">
                        <h3>Precio: <?php echo $precioVuelo; ?></h3>
                    </div>
                    <div class="row">
                        <h4>Categoria: <?php echo $categoria->getNom_categoria_asiento(); ?></h4>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-3">
                    <h5><?php 
                       echo $vueloLlegada->getAerolinea()->getNom_aerolinea();
                    ?></h5>
                </div>
                <div class="col-2">
                    <div class="row">
                        <h4><?php
                       echo $vueloLlegada->getFecha_salida();
                        ?></h4>
                    </div>
                    <div class="row">
                        <p><?php
                       echo $vueloLlegada->getCiudad_origen()->getNom_ciudad();
                        ?></p>
                    </div>
                </div>
                <div class="col-2">
                    <i class="fas fa-plane-arrival fa-lg"></i>
                </div>
                <div class="col-2">
                    <div class="row" >
                        <h4><?php
                       echo $vueloLlegada->getFecha_llegada();
                        ?></h4>
                    </div>
                    <div class="row">
                        <p><?php
                       echo $vueloLlegada->getCiudad_destino()->getNom_ciudad();
                        ?></p>
                    </div>
                </div>
                <div class="col-2" >
                    <div class="row">
                        <?php
                            if(isset($_SESSION['codigo_usuario'])) {
                                if($_SESSION['tipo_usuario'] == "Cliente"){
                                ?>
                                <form method="post" action="cliente/reservaCliente.php">
                                    <input type="hidden" name="vueloIda" value="<?php echo $vueloSalida->getCod_vuelo();?>">
                                    <input type="hidden" name="vueloVuelta" value="<?php echo $vueloLlegada->getCod_vuelo();?>">
                                    <input type="hidden" name="categoria" value="<?php echo $categoria->getCod_categoria_asiento();?>">
                                    <input type="hidden" name="numero_asientos" value="1">
                                    <input type="hidden" name="precioVuelo" value="<?php echo $precioVuelo;?>">
                                    <input type='submit' class='consulta_btn' name="reservar" value="Reservar"></input>
                                </form>
                                <?php
                                }
                            }
                        ?>
                    </div>
                    <div style="height: 30px;"></div>
                    <div class="row">
                        <?php
                            if(isset($_SESSION['codigo_usuario'])) {
                                if($_SESSION['tipo_usuario'] == "Cliente"){
                                ?>
                                <form method="post" action="cliente/compraCliente.php">
                                    <input type="hidden" name="vueloIda" value="<?php echo $vueloSalida->getCod_vuelo();?>">
                                    <input type="hidden" name="vueloVuelta" value="<?php echo $vueloLlegada->getCod_vuelo();?>">
                                    <input type="hidden" name="categoria" value="<?php echo $categoria->getCod_categoria_asiento();?>">
                                    <input type="hidden" name="numero_asientos" value="1">
                                    <input type="hidden" name="precioVuelo" value="<?php echo $precioVuelo;?>">
                                    <input type='submit' class='consulta_btn' name="comprar" value="Comprar"></input>
                                </form>
                                <?php
                                } else if($_SESSION['tipo_usuario'] == "Asesor") {?>
                                    <form method="post" action="asesor/compraAsesor.php">
                                    <input type="hidden" name="vueloIda" value="<?php echo $vueloSalida->getCod_vuelo();?>">
                                    <input type="hidden" name="vueloVuelta" value="<?php echo $vueloLlegada->getCod_vuelo();?>">
                                    <input type="hidden" name="categoria" value="<?php echo $categoria->getCod_categoria_asiento();?>">
                                    <input type="hidden" name="numero_asientos" value="1">
                                    <input type="hidden" name="precioVuelo" value="<?php echo $precioVuelo;?>">
                                    <input type='submit' class='consulta_btn' name="comprar">Comprar</input>
                                </form>
                                <?php }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
                        <?php }}
                    }
                }
                ?>
    </section>
    <!--================End Home Blog Area =================-->




    <!-- Modal -->
    <div class="modal fade" id="modalForm" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form method="post" action="validarLogin.php">
                        <?php
                        if(isset($_SESSION['errorLogin'])) {
                                echo "<div class='alert alert-danger ' role='alert'>
                            <center>  <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            <strong>ERROR!</strong>El usuario o contraseña son incorrectos</center>
                            </div>";
                            }

                        ?>

                        <section class="blog_area single-post-area p_0">
                            <div class="comment-form">
                                <h1>Inicio de sesión</h1>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <center>
                                        <div class="form-group col-lg-8 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-10 mt-sm-20 "> <b>Correo</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                </div>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <div class="form-group col-lg-10 col-md-2 email">
                                        <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingrese su correo electrónico" required="true">
                                    </div>
                                </div>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <center>
                                        <div class="form-group col-lg-8 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-10 mt-sm-20 "> <b>Contraseña</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                </div>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <div class="form-group col-lg-10 col-md-0 email">
                                        <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña" required="true">
                                    </div>
                                </div>

                                <div class="switch-wrap d-flex justify-content-between">
                                    <div class="button-group-area mt-20">
                                        <input type="submit" class="genric-btn warning-border circle" name="Ingresar">
                                    </div>
                                    <div class="button-group-area mt-15">
                                        <a href="#">Olvide mi contraseña</a>
                                    </div>
                                </div>

                            </div>

                    </form>
                    </section>
                </div>

            </div>
        </div>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 

    <?php
        if(isset($_SESSION['errorLogin'])){
            ?>
                <script>
                    $(document).ready(function(){
                        $("#modalForm").modal("show");
                        $("#modalForm").addClass("in");
                    });
                </script>
            <?php
            unset($_SESSION['errorLogin']);
        }
    ?>

</body>

</html>

<?php

    $conexion->desconectarBD($con);
    unset($conexion);
?>